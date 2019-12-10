<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;

class GD_SubscribeToTag extends GD_SubscribeToUnsubscribeFromTag
{
    protected function validate(&$errors, $form_data)
    {
        parent::validate($errors, $form_data);

        if (!$errors) {
            $vars = \PoP\ComponentModel\Engine_Vars::getVars();
            $user_id = $vars['global-userstate']['current-user-id'];
            $target_id = $form_data['target_id'];

            // Check that the logged in user has not already subscribed to this tag
            $value = \PoP\UserMeta\Utils::getUserMeta($user_id, GD_METAKEY_PROFILE_SUBSCRIBESTOTAGS);
            if (in_array($target_id, $value)) {
                $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
                $cmstaxonomiesresolver = \PoP\Taxonomies\ObjectPropertyResolverFactory::getInstance();
                $tag = $taxonomyapi->getTag($target_id);
                $errors[] = sprintf(
                    TranslationAPIFacade::getInstance()->__('You have already subscribed to <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
                    $cmstaxonomiesresolver->getTagSymbolName($tag)
                );
            }
        }
    }

    /**
     * Function to override
     */
    protected function additionals($target_id, $form_data)
    {
        parent::additionals($target_id, $form_data);
        HooksAPIFacade::getInstance()->doAction('gd_subscribetotag', $target_id, $form_data);
    }

    protected function update($form_data)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $user_id = $vars['global-userstate']['current-user-id'];
        $target_id = $form_data['target_id'];

        // Update value
        \PoP\UserMeta\Utils::addUserMeta($user_id, GD_METAKEY_PROFILE_SUBSCRIBESTOTAGS, $target_id);
        \PoP\TaxonomyMeta\Utils::addTermMeta($target_id, GD_METAKEY_TERM_SUBSCRIBEDBY, $user_id);

        // Update the counter
        $count = \PoP\TaxonomyMeta\Utils::getTermMeta($target_id, GD_METAKEY_TERM_SUBSCRIBERSCOUNT, true);
        $count = $count ? $count : 0;
        \PoP\TaxonomyMeta\Utils::updateTermMeta($target_id, GD_METAKEY_TERM_SUBSCRIBERSCOUNT, ($count + 1), true);

        return parent::update($form_data);
    }
}
