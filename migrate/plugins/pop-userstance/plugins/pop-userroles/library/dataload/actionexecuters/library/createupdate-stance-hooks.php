<?php
use PoP\Hooks\Facades\HooksAPIFacade;

class UserStance_DataLoad_CreateUpdateStanceHooks
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addFilter(
            'GD_CreateUpdate_Stance:createadditionals',
            array($this, 'createadditionals')
        );
    }

    public function createadditionals($post_id)
    {
        
        // Redundancy on who has created the Stance: an individual or an organization
        // This way we can show the slider in the Homepage "Latest thoughts about TPP" and split them into "By people" / "By organizations"
        // This works because the Stance has only 1 author
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        \PoP\PostMeta\Utils::addPostMeta($post_id, GD_URE_METAKEY_POST_AUTHORROLE, gdUreGetuserrole($vars['global-userstate']['current-user-id']), true);
    }
}
    
/**
 * Initialize
 */
new UserStance_DataLoad_CreateUpdateStanceHooks();