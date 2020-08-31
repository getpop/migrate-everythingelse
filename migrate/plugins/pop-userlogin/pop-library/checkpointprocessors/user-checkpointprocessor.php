<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\State\ApplicationState;
use PoP\Engine\CheckpointProcessors\AbstractCheckpointProcessor;

class GD_UserLogin_Dataload_UserCheckpointProcessor extends AbstractCheckpointProcessor
{
    public const CHECKPOINT_LOGGEDINUSER_ISADMINISTRATOR = 'checkpoint-loggedinuser-isadministrator';

    public function getCheckpointsToProcess()
    {
        return array(
            [self::class, self::CHECKPOINT_LOGGEDINUSER_ISADMINISTRATOR],
        );
    }

    public function process(array $checkpoint)
    {
        $vars = ApplicationState::getVars();
        $translationAPI = TranslationAPIFacade::getInstance();
        switch ($checkpoint[1]) {
            case self::CHECKPOINT_LOGGEDINUSER_ISADMINISTRATOR:
                $user_id = $vars['global-userstate']['current-user-id'];
                if (!\PoPSchema\UserRoles\Utils::hasRole('administrator', $user_id)) {
                    return new \PoP\ComponentModel\Error('userisnotadmin');
                }
                break;
        }

        return parent::process($checkpoint);
    }
}

