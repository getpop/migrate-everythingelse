<?php
use PoP\Taxonomies\TypeResolvers\TagTypeResolver;

class PoP_SocialMediaProviders_DataLoad_FunctionalFieldResolver_TagSocialMediaItems extends PoP_SocialMediaProviders_DataLoad_FieldResolver_FunctionalSocialMediaItems
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            TagTypeResolver::class,
        );
    }

    protected function getTitleField()
    {
        return 'name';
    }
}
    
// Static Initialization: Attach
PoP_SocialMediaProviders_DataLoad_FunctionalFieldResolver_TagSocialMediaItems::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS);