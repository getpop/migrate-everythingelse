<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;

/**
 * Data Load Library
 * Documentation:
 * Nonce and user_id taken from the REQUEST so that it gets the value when the user is not logged in and then logs in and refreshes the block.
 * Otherwise, these 2 values are never printed, since checkpoint will stop the execution
 */
class GD_EditMembership
{
    public function execute(&$errors, &$data_properties)
    {
        $form_data = $this->getFormData($data_properties);

        $this->validate($errors, $form_data);
        if ($errors) {
            return;
        }

        return $this->update($errors, $form_data);
    }

    protected function getFormData(&$data_properties)
    {
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();

        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $community = $vars['global-userstate']['is-user-logged-in'] ? $vars['global-userstate']['current-user-id'] : '';
        $privileges = $moduleprocessor_manager->getProcessor([GD_URE_Module_Processor_ProfileMultiSelectFormInputs::class, GD_URE_Module_Processor_ProfileMultiSelectFormInputs::MODULE_URE_FORMINPUT_MEMBERPRIVILEGES])->getValue([GD_URE_Module_Processor_ProfileMultiSelectFormInputs::class, GD_URE_Module_Processor_ProfileMultiSelectFormInputs::MODULE_URE_FORMINPUT_MEMBERPRIVILEGES]);
        $tags = $moduleprocessor_manager->getProcessor([GD_URE_Module_Processor_ProfileMultiSelectFormInputs::class, GD_URE_Module_Processor_ProfileMultiSelectFormInputs::MODULE_URE_FORMINPUT_MEMBERTAGS])->getValue([GD_URE_Module_Processor_ProfileMultiSelectFormInputs::class, GD_URE_Module_Processor_ProfileMultiSelectFormInputs::MODULE_URE_FORMINPUT_MEMBERTAGS]);
        $form_data = array(
            'community' => $community,
            'user_id' => $_REQUEST[POP_INPUTNAME_USERID],
            // 'nonce' => $_REQUEST[POP_INPUTNAME_NONCE],
            'status' => trim($moduleprocessor_manager->getProcessor([GD_URE_Module_Processor_SelectFormInputs::class, GD_URE_Module_Processor_SelectFormInputs::MODULE_URE_FORMINPUT_MEMBERSTATUS])->getValue([GD_URE_Module_Processor_SelectFormInputs::class, GD_URE_Module_Processor_SelectFormInputs::MODULE_URE_FORMINPUT_MEMBERSTATUS])),
            'privileges' => $privileges ?? array(),
            'tags' => $tags ?? array(),
        );

        return $form_data;
    }

    protected function validate(&$errors, $form_data)
    {
        $user_id = $form_data['user_id'];
        if (!$user_id) {
            $errors[] = TranslationAPIFacade::getInstance()->__('The user is missing', 'ure-pop');
            return;
        }

        // $nonce = $form_data['nonce'];
        // if (!gdVerifyNonce( $nonce, GD_NONCE_EDITMEMBERSHIPURL, $user_id)) {
        //     $errors[] = TranslationAPIFacade::getInstance()->__('Incorrect URL', 'ure-pop');
        //     return;
        // }

        $status = $form_data['status'];
        if (!$status) {
            $errors[] = TranslationAPIFacade::getInstance()->__('The status has not been set', 'ure-pop');
        }
    }

    protected function update(&$errors, $form_data)
    {
        $user_id = $form_data['user_id'];
        $community = $form_data['community'];
        $new_community_status = $form_data['status'];
        $new_community_privileges = $form_data['privileges'];
        $new_community_tags = $form_data['tags'];

        // Get all the current values for that user
        $status = \PoP\UserMeta\Utils::getUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERSTATUS);
        $privileges = \PoP\UserMeta\Utils::getUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERPRIVILEGES);
        $tags = \PoP\UserMeta\Utils::getUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERTAGS);

        // Update these values with the changes for this one community
        // The community will already be there, since it was added when the user updated My Communities.
        // And even if the user selected no privileges or tags, then GD_METAVALUE_NONE will be set, so the db metavalue entry should always exist
        
        // Remove existing ones
        $current_community_status = gdUreFindCommunityMetavalues($community, $status, false);
        $current_community_privileges = gdUreFindCommunityMetavalues($community, $privileges, false);
        $current_community_tags = gdUreFindCommunityMetavalues($community, $tags, false);

        $status = array_diff(
            $status,
            $current_community_status
        );
        $privileges = array_diff(
            $privileges,
            $current_community_privileges
        );
        $tags = array_diff(
            $tags,
            $current_community_tags
        );

        // Add the new ones
        $status[] = gdUreGetCommunityMetavalueCurrentcommunity($new_community_status);
        if (!empty($new_community_privileges)) {
            $privileges = array_merge(
                $privileges,
                array_map('gdUreGetCommunityMetavalueCurrentcommunity', $new_community_privileges)
            );
        } else {
            $privileges[] = gdUreGetCommunityMetavalueCurrentcommunity(GD_METAVALUE_NONE);
        }
        if (!empty($new_community_tags)) {
            $tags = array_merge(
                $tags,
                array_map('gdUreGetCommunityMetavalueCurrentcommunity', $new_community_tags)
            );
        } else {
            $tags[] = gdUreGetCommunityMetavalueCurrentcommunity(GD_METAVALUE_NONE);
        }

        // Update in the DB
        \PoP\UserMeta\Utils::updateUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERSTATUS, $status);
        \PoP\UserMeta\Utils::updateUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERPRIVILEGES, $privileges);
        \PoP\UserMeta\Utils::updateUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERTAGS, $tags);

        // Allow ACF to also save the value in the DB
        HooksAPIFacade::getInstance()->doAction('GD_EditMembership:update', $user_id, $community, $new_community_status, $new_community_privileges, $new_community_tags);

        return true;
    }
}
