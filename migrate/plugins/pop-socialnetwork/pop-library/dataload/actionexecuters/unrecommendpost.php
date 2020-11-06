<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoPSchema\CustomPosts\Facades\CustomPostTypeAPIFacade;

class GD_DataLoad_ActionExecuter_UnrecommendPost extends GD_DataLoad_ActionExecuter_UpdateUserMetaValue_Post
{
    public function getMutationResolverClass(): string
    {
        return GD_UnrecommendPost::class;
    }

    protected function onlyExecuteWhenDoingPost(): bool
    {
        return false;
    }

    /**
     * @param mixed $result_id Maybe an int, maybe a string
     */
    public function getSuccessString($result_id): ?string
    {
        $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
        return sprintf(
            TranslationAPIFacade::getInstance()->__('You have stopped recommending <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
            $customPostTypeAPI->getTitle($result_id)
        );
    }
}

