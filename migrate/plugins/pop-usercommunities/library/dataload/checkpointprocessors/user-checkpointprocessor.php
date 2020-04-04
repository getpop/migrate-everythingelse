<?php

use PoP\ComponentModel\State\ApplicationState;

class PoP_UserCommunities_Dataload_UserCheckpointProcessor extends \PoP\ComponentModel\CheckpointProcessorBase
{
    public const CHECKPOINT_LOGGEDINUSER_ISCOMMUNITY = 'checkpoint-loggedinuser-iscommunity';
    public const CHECKPOINT_EDITINGCOMMUNITYMEMBER = 'checkpoint-editingcommunitymember';
    public const CHECKPOINT_EDITMEMBERSHIPNONCE = 'checkpoint-editmembershipnonce';

    public function getCheckpointsToProcess()
    {
        return array(
            [self::class, self::CHECKPOINT_LOGGEDINUSER_ISCOMMUNITY],
            [self::class, self::CHECKPOINT_EDITINGCOMMUNITYMEMBER],
            [self::class, self::CHECKPOINT_EDITMEMBERSHIPNONCE],
        );
    }

    public function process(array $checkpoint)
    {
        $vars = ApplicationState::getVars();
        $current_user_id = $vars['global-userstate']['current-user-id'];
        switch ($checkpoint[1]) {
            case self::CHECKPOINT_LOGGEDINUSER_ISCOMMUNITY:
                if (!gdUreIsCommunity($current_user_id)) {
                    return new \PoP\ComponentModel\Error('profilenotcommunity');
                }
                break;

            case self::CHECKPOINT_EDITINGCOMMUNITYMEMBER:
                // Validate the user being edited is member of the community
                $vars = ApplicationState::getVars();
                $user_id = $_REQUEST[POP_INPUTNAME_USERID];
                $community = $current_user_id;
                $status = \PoP\UserMeta\Utils::getUserMeta($user_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERSTATUS);
                $community_status = gdUreFindCommunityMetavalues($community, $status);

                if (empty($community_status)) {
                    return new \PoP\ComponentModel\Error('editingnotcommunitymember');
                }
                break;

            case self::CHECKPOINT_EDITMEMBERSHIPNONCE:
                $user_id = $_REQUEST[POP_INPUTNAME_USERID];
                $nonce = $_REQUEST[POP_INPUTNAME_NONCE];
                if (!gdVerifyNonce($nonce, GD_NONCE_EDITMEMBERSHIPURL, $user_id)) {
                    return new \PoP\ComponentModel\Error('nonceinvalid');
                }
                break;
        }
    
        return parent::process($checkpoint);
    }
}

