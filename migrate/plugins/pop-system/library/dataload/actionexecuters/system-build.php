<?php
use PoP\Translation\Facades\TranslationAPIFacade;

class GD_DataLoad_ActionExecuter_SystemBuild extends AbstractSystemComponentMutationResolverBridge
{
    public function getMutationResolverClass(): string
    {
        return GD_SystemBuild::class;
    }
    /**
     * @param mixed $result_id Maybe an int, maybe a string
     */
    public function getSuccessString($result_id): ?string
    {
        return TranslationAPIFacade::getInstance()->__('System action "build" executed successfully.', 'pop-system');;
    }
}

