<?php

use PoP\Posts\Facades\PostTypeAPIFacade;
use PoP\Users\TypeResolvers\UserTypeResolver;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\Schema\TypeCastingHelpers;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\Content\FieldInterfaces\ContentEntityFieldInterfaceResolver;

class GD_ContentCreation_DataLoad_FieldResolver_Posts extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(
            ContentEntityFieldInterfaceResolver::class,
        );
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'titleEdit',
            'contentEditor',
            'contentEdit',
            'editURL',
            'deleteURL',
            'coauthors',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
            'titleEdit' => SchemaDefinition::TYPE_STRING,
            'contentEditor' => SchemaDefinition::TYPE_STRING,
            'contentEdit' => SchemaDefinition::TYPE_STRING,
            'editURL' => SchemaDefinition::TYPE_URL,
            'deleteURL' => SchemaDefinition::TYPE_URL,
            'coauthors' => TypeCastingHelpers::makeArray(SchemaDefinition::TYPE_ID),
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
            'titleEdit' => $translationAPI->__('', ''),
            'contentEditor' => $translationAPI->__('', ''),
            'contentEdit' => $translationAPI->__('', ''),
            'editURL' => $translationAPI->__('', ''),
            'deleteURL' => $translationAPI->__('', ''),
            'coauthors' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $postTypeAPI = PostTypeAPIFacade::getInstance();
        $cmseditpostsapi = \PoP\EditPosts\FunctionAPIFactory::getInstance();
        $post = $resultItem;
        switch ($fieldName) {

            case 'titleEdit':
                if (gdCurrentUserCanEdit($typeResolver->getID($post))) {
                    return $postTypeAPI->getTitle($post);
                }
                return '';

            case 'contentEditor':
                if (gdCurrentUserCanEdit($typeResolver->getID($post))) {
                   return $cmseditpostsapi->getPostEditorContent($typeResolver->getID($post));
                }
                return '';

            case 'contentEdit':
                if (gdCurrentUserCanEdit($typeResolver->getID($post))) {
                    return $postTypeAPI->getContent($post);
                }
                return '';

            case 'editURL':
                return urldecode($cmseditpostsapi->getEditPostLink($typeResolver->getID($post)));

            case 'deleteURL':
                return $cmseditpostsapi->getDeletePostLink($typeResolver->getID($post));

            case 'coauthors':
                $authors = $typeResolver->resolveValue($resultItem, FieldQueryInterpreterFacade::getInstance()->getField('authors', $fieldArgs), $variables, $expressions, $options);

                // This function only makes sense when the user is logged in
                $vars = \PoP\ComponentModel\Engine_Vars::getVars();
                if ($vars['global-userstate']['is-user-logged-in']) {
                    $pos = array_search($vars['global-userstate']['current-user-id'], $authors);
                    if ($pos !== false) {
                        array_splice($authors, $pos, 1);
                    }
                }
                return $authors;
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }

    public function resolveFieldTypeResolverClass(TypeResolverInterface $typeResolver, string $fieldName, array $fieldArgs = []): ?string
    {
        switch ($fieldName) {
            case 'coauthors':
                return UserTypeResolver::class;
        }

        return parent::resolveFieldTypeResolverClass($typeResolver, $fieldName, $fieldArgs);
    }
}

// Static Initialization: Attach
GD_ContentCreation_DataLoad_FieldResolver_Posts::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS);
