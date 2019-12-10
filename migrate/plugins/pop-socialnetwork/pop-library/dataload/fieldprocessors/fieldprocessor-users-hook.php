<?php
use PoP\ComponentModel\Utils;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Schema\TypeCastingHelpers;
use PoP\Posts\TypeDataResolvers\ConvertiblePostTypeDataResolver;
use PoP\Users\TypeDataResolvers\UserTypeDataResolver;
use PoP\Users\TypeResolvers\UserTypeResolver;

class GD_SocialNetwork_DataLoad_FieldResolver_Users extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(UserTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'recommendsposts',
            'followers',
            'following',
            'followers-count',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'recommendsposts' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ID),
            'followers' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ID),
            'following' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ID),
            'followers-count' => SchemaDefinition::TYPE_INT,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'recommendsposts' => $translationAPI->__('', ''),
            'followers' => $translationAPI->__('', ''),
            'following' => $translationAPI->__('', ''),
            'followers-count' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $user = $resultItem;
        switch ($fieldName) {
            case 'recommendsposts':
                $query = [];
                PoP_Module_Processor_CustomSectionBlocksUtils::addDataloadqueryargsAuthorrecommendedposts($query, $typeResolver->getId($user));
                return $cmspostsapi->getPosts($query, ['return-type' => POP_RETURNTYPE_IDS]);

            case 'followers':
                $query = [];
                PoP_Module_Processor_CustomSectionBlocksUtils::addDataloadqueryargsAuthorfollowers($query, $typeResolver->getId($user));
                return $cmsusersapi->getUsers($query, ['return-type' => POP_RETURNTYPE_IDS]);

            case 'following':
                $query = [];
                PoP_Module_Processor_CustomSectionBlocksUtils::addDataloadqueryargsAuthorfollowingusers($query, $typeResolver->getId($user));
                return $cmsusersapi->getUsers($query, ['return-type' => POP_RETURNTYPE_IDS]);

            case 'followers-count':
                return \PoP\UserMeta\Utils::getUserMeta($typeResolver->getId($user), GD_METAKEY_PROFILE_FOLLOWERSCOUNT, true);
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }

    public function resolveFieldDefaultTypeDataResolverClass(TypeResolverInterface $typeResolver, string $fieldName, array $fieldArgs = []): ?string
    {
        switch ($fieldName) {
            case 'recommendsposts':
                return ConvertiblePostTypeDataResolver::class;

            case 'followers':
            case 'following':
                return UserTypeDataResolver::class;
        }

        return parent::resolveFieldDefaultTypeDataResolverClass($typeResolver, $fieldName, $fieldArgs);
    }
}
    
// Static Initialization: Attach
GD_SocialNetwork_DataLoad_FieldResolver_Users::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS);