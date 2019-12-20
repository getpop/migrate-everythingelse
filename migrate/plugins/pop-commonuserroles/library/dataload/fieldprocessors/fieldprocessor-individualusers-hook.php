<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Schema\TypeCastingHelpers;
use PoP\Users\TypeResolvers\UserTypeResolver;

class FieldResolver_IndividualUsers extends AbstractDBDataFieldResolver
{
    use IndividualFieldResolverTrait;

    public static function getClassesToAttachTo(): array
    {
        return array(UserTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'individualinterests',
            'has-individual-details',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'individualinterests' => TypeCastingHelpers::makeArray(SchemaDefinition::TYPE_STRING),
            'has-individual-details' => SchemaDefinition::TYPE_BOOL,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'individualinterests' => $translationAPI->__('', ''),
            'has-individual-details' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $user = $resultItem;
        switch ($fieldName) {
            case 'individualinterests':
                return \PoP\UserMeta\Utils::getUserMeta($typeResolver->getID($user), GD_URE_METAKEY_PROFILE_INDIVIDUALINTERESTS);

            case 'has-individual-details':
                return !empty($typeResolver->resolveValue($user, 'individualinterests', $variables, $expressions, $options));
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}

// Static Initialization: Attach
FieldResolver_IndividualUsers::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS);
