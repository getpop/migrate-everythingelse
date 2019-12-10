<?php
use PoP\Hooks\Facades\HooksAPIFacade;
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


// By not expending from class AAL_Hook_Base, this code is de-attached from AAL
class PoP_UserStance_Notifications_Hook_Posts /* extends AAL_Hook_Base*/
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addAction(
            'GD_CreateUpdate_Stance:createadditionals',
            array($this, 'createdStance')
        );
        HooksAPIFacade::getInstance()->addAction(
            'GD_CreateUpdate_Stance:updateadditionals',
            array($this, 'updatedStance'),
            10,
            3
        );
    }

    public function createdStance($post_id)
    {
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        if ($cmspostsapi->getPostStatus($post_id) == POP_POSTSTATUS_PUBLISHED) {
            $referenced_post_id = \PoP\PostMeta\Utils::getPostMeta($post_id, GD_METAKEY_POST_STANCETARGET, true);
            $this->referencedPost($post_id, $referenced_post_id);
        }
    }

    public function updatedStance($post_id, $form_data, $log)
    {
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        if ($cmspostsapi->getPostStatus($post_id) == POP_POSTSTATUS_PUBLISHED) {
            // If doing a create (changed "draft" to "publish"), then add all references
            if ($log['previous-status'] != POP_POSTSTATUS_PUBLISHED) {
                $referenced_post_id = \PoP\PostMeta\Utils::getPostMeta($post_id, GD_METAKEY_POST_STANCETARGET, true);
                $this->referencedPost($post_id, $referenced_post_id);
            }
        }
    }

    protected function referencedPost($post_id, $referenced_post_id)
    {
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $cmspostsresolver = \PoP\Posts\ObjectPropertyResolverFactory::getInstance();
        $post = $cmspostsapi->getPost($post_id);
        PoP_Notifications_Utils::insertLog(
            array(
                'user_id' => $cmspostsresolver->getPostAuthor($post),
                'action' => AAL_POP_ACTION_POST_CREATEDSTANCE,
                'object_type' => 'Post',
                'object_subtype' => $cmspostsapi->getPostType($referenced_post_id),
                'object_id' => $referenced_post_id,
                'object_name' => $cmspostsapi->getTitle($referenced_post_id),
            )
        );
    }
}