<?php

class GD_ContentCreation_Dataload_UserCheckpointProcessor extends \PoP\ComponentModel\CheckpointProcessorBase
{
    public const CHECKPOINT_USERCANEDIT = 'checkpoint-usercanedit';
    public const CHECKPOINT_EDITPOSTNONCE = 'checkpoint-editpostnonce';

    public function getCheckpointsToProcess()
    {
        return array(
            [self::class, self::CHECKPOINT_USERCANEDIT],
            [self::class, self::CHECKPOINT_EDITPOSTNONCE],
        );
    }

    public function process(array $checkpoint)
    {
        switch ($checkpoint[1]) {
            case self::CHECKPOINT_USERCANEDIT:
                // Check if the user can edit the specific post
                $post_id = $_REQUEST[POP_INPUTNAME_POSTID];
                if (!gdCurrentUserCanEdit($post_id)) {
                    return new \PoP\ComponentModel\Error('usercannotedit');
                }
                break;

            case self::CHECKPOINT_EDITPOSTNONCE:
                $post_id = $_REQUEST[POP_INPUTNAME_POSTID];
                $nonce = $_REQUEST[POP_INPUTNAME_NONCE];
                if (!gdVerifyNonce($nonce, GD_NONCE_EDITURL, $post_id)) {
                    return new \PoP\ComponentModel\Error('nonceinvalid');
                }
                break;
        }
    
        return parent::process($checkpoint);
    }
}
