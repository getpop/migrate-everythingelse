<?php
use PoP\Users\TypeResolvers\UserTypeResolver;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\Schema\TypeCastingHelpers;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\FieldResolvers\EnumTypeSchemaDefinitionResolverTrait;

class GD_UserCommunities_DataLoad_FieldResolver_Users extends AbstractDBDataFieldResolver
{
    use EnumTypeSchemaDefinitionResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(UserTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'memberstatus',
            'memberprivileges',
            'membertags',
            'isCommunity',
            'communities',
            'activeCommunities',
            'hasActiveCommunities',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'memberstatus' => SchemaDefinition::TYPE_ENUM,
            'memberprivileges' => SchemaDefinition::TYPE_ENUM,
            'membertags' => SchemaDefinition::TYPE_ENUM,
            'isCommunity' => SchemaDefinition::TYPE_BOOL,
            'communities' => TypeCastingHelpers::makeArray(SchemaDefinition::TYPE_ID),
            'activeCommunities' => TypeCastingHelpers::makeArray(SchemaDefinition::TYPE_ID),
            'hasActiveCommunities' => SchemaDefinition::TYPE_BOOL,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'memberstatus' => $translationAPI->__('', ''),
            'memberprivileges' => $translationAPI->__('', ''),
            'membertags' => $translationAPI->__('', ''),
            'isCommunity' => $translationAPI->__('', ''),
            'communities' => $translationAPI->__('', ''),
            'activeCommunities' => $translationAPI->__('', ''),
            'hasActiveCommunities' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    protected function getSchemaDefinitionEnumValues(TypeResolverInterface $typeResolver, string $fieldName): ?array
    {
        switch ($fieldName) {
            case 'memberstatus':
            case 'memberprivileges':
            case 'membertags':
                $input_classes = [
                    'memberstatus' => GD_URE_FormInput_MultiMemberStatus::class,
                    'memberprivileges' => GD_URE_FormInput_FilterMemberPrivileges::class,
                    'membertags' => GD_URE_FormInput_FilterMemberTags::class,
                ];
                $class = $input_classes[$fieldName];
                return array_keys((new $class())->getAllValues());
        }
        return null;
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $user = $resultItem;

        switch ($fieldName) {
            case 'memberstatus':
                // All status for all communities
                $status = \PoP\UserMeta\Utils::getUserMeta($typeResolver->getID($user), GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERSTATUS);

                // Filter status for only this community: the logged in user
                return gdUreCommunityMembershipstatusFilterbycurrentcommunity($status);

            case 'memberprivileges':
                // All privileges for all communities
                $privileges = \PoP\UserMeta\Utils::getUserMeta($typeResolver->getID($user), GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERPRIVILEGES);

                // Filter privileges for only this community: the logged in user
                return gdUreCommunityMembershipstatusFilterbycurrentcommunity($privileges);

            case 'membertags':
                // All privileges for all communities
                $tags = \PoP\UserMeta\Utils::getUserMeta($typeResolver->getID($user), GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERTAGS);

                // Filter privileges for only this community: the logged in user
                return gdUreCommunityMembershipstatusFilterbycurrentcommunity($tags);

            case 'isCommunity':
                return gdUreIsCommunity($typeResolver->getID($user)) ? true : null;

            case 'communities':
                // Return only the communities where the user's been accepted as a member
                return gdUreGetCommunities($typeResolver->getID($user));

            case 'activeCommunities':
                // Return only the communities where the user's been accepted as a member
                return gdUreGetCommunitiesStatusActive($typeResolver->getID($user));

            case 'hasActiveCommunities':
                $communities = $typeResolver->resolveValue($resultItem, 'activeCommunities', $variables, $expressions, $options);
                return !empty($communities);
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }

    public function resolveFieldTypeResolverClass(TypeResolverInterface $typeResolver, string $fieldName, array $fieldArgs = []): ?string
    {
        switch ($fieldName) {
            case 'communities':
            case 'activeCommunities':
                return UserTypeResolver::class;
        }

        return parent::resolveFieldTypeResolverClass($typeResolver, $fieldName, $fieldArgs);
    }
}

// Static Initialization: Attach
GD_UserCommunities_DataLoad_FieldResolver_Users::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS);
