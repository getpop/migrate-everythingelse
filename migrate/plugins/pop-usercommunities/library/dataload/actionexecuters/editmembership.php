<?php
use PoP\ComponentModel\MutationResolvers\AbstractComponentMutationResolverBridge;

class GD_DataLoad_ActionExecuter_EditMembership extends AbstractComponentMutationResolverBridge
{
    public function getMutationResolverClass(): string
    {
        return GD_EditMembership::class;
    }
}

