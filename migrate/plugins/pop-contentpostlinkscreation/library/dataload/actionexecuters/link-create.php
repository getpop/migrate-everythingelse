<?php
use PoPSchema\CustomPostMutations\MutationResolvers\AbstractCreateUpdateCustomPostMutationResolverBridge;

class GD_DataLoad_ActionExecuter_Create_ContentPostLink extends AbstractCreateUpdateCustomPostMutationResolverBridge
{
    public function getMutationResolverClass(): string
    {
        return GD_Create_PostLink::class;
    }
}
