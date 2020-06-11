<?php

use PoP\Content\FieldInterfaces\CustomPostFieldInterfaceResolver;

class PoP_SocialMediaProviders_DataLoad_FunctionalFieldResolver_PostSocialMediaItems extends PoP_SocialMediaProviders_DataLoad_FieldResolver_FunctionalSocialMediaItems
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            CustomPostFieldInterfaceResolver::class,
        );
    }

    protected function getTitleField()
    {
        return 'title';
    }
}

// Static Initialization: Attach
PoP_SocialMediaProviders_DataLoad_FunctionalFieldResolver_PostSocialMediaItems::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS);
