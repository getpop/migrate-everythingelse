<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;

class GD_FollowUser extends GD_FollowUnfollowUser
{
    protected function validate(&$errors, $form_data)
    {
        parent::validate($errors, $form_data);

        if (!$errors) {
            $vars = \PoP\ComponentModel\Engine_Vars::getVars();
            $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
            $user_id = $vars['global-userstate']['current-user-id'];
            $target_id = $form_data['target_id'];

            if ($user_id == $target_id) {
                $errors[] = TranslationAPIFacade::getInstance()->__('You can\'t follow yourself!', 'pop-coreprocessors');
            } else {
                // Check that the logged in user does not currently follow that user
                $value = \PoP\UserMeta\Utils::getUserMeta($user_id, GD_METAKEY_PROFILE_FOLLOWSUSERS);
                if (in_array($target_id, $value)) {
                    $errors[] = sprintf(
                        TranslationAPIFacade::getInstance()->__('You are already following <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
                        $cmsusersapi->getUserDisplayName($target_id)
                    );
                }
            }
        }
    }

    /**
     * Function to override
     */
    protected function additionals($target_id, $form_data)
    {
        parent::additionals($target_id, $form_data);
        HooksAPIFacade::getInstance()->doAction('gd_followuser', $target_id, $form_data);
    }

    // protected function updateValue($value, $form_data) {

    //     // Add the user to follow to the list
    //     $target_id = $form_data['target_id'];
    //     $value[] = $target_id;
    // }

    protected function update($form_data)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $user_id = $vars['global-userstate']['current-user-id'];
        $target_id = $form_data['target_id'];

        // Comment Leo 02/10/2015: added redundant values, so that we can query for both "Who are my followers" and "Who I am following"
        // and make both searchable and with pagination
        // Update values
        \PoP\UserMeta\Utils::addUserMeta($user_id, GD_METAKEY_PROFILE_FOLLOWSUSERS, $target_id);
        \PoP\UserMeta\Utils::addUserMeta($target_id, GD_METAKEY_PROFILE_FOLLOWEDBY, $user_id);

        // Update the counter
        $count = \PoP\UserMeta\Utils::getUserMeta($target_id, GD_METAKEY_PROFILE_FOLLOWERSCOUNT, true);
        $count = $count ? $count : 0;
        \PoP\UserMeta\Utils::updateUserMeta($target_id, GD_METAKEY_PROFILE_FOLLOWERSCOUNT, ($count + 1), true);

        return parent::update($form_data);
    }
}
