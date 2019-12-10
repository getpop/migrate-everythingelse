<?php
use PoP\Hooks\Facades\HooksAPIFacade;

class PoP_ModuleManager_UserMetaUtils
{
    public static function init()
    {
        HooksAPIFacade::getInstance()->addAction(
            'popcms:shutdown',
            array('PoP_ModuleManager_UserMetaUtils', 'saveUserMeta')
        );
    }

    public static function saveUserMeta()
    {

        // Function used to save information on the user access. In particular, we need the last access time, for the Notifications
        // Can do it only if the page is mutableonrequestdata
        if (PoP_UserState_Utils::currentRouteRequiresUserState()) {
            $vars = \PoP\ComponentModel\Engine_Vars::getVars();
            if ($vars['global-userstate']['is-user-logged-in']) {
                PoP_UserPlatform_UserUtils::saveUserLastAccess($vars['global-userstate']['current-user-id'], POP_CONSTANT_CURRENTTIMESTAMP);
            }
        }
    }
}

/**
 * Initialization
 */
PoP_ModuleManager_UserMetaUtils::init();