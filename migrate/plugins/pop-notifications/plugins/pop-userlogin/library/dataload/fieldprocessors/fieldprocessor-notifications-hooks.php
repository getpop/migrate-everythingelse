<?php
use PoP\ComponentModel\Utils;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\Notifications\TypeResolvers\NotificationTypeResolver;

class PoP_Notifications_UserLogin_DataLoad_FieldResolver_Notifications extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(NotificationTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
			'icon',
            'url',
            'message',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
			'icon' => SchemaDefinition::TYPE_STRING,
            'url' => SchemaDefinition::TYPE_URL,
            'message' => SchemaDefinition::TYPE_STRING,
        ];
        return $types[$fieldName] ?? parent::getSchemaFieldType($typeResolver, $fieldName);
    }

    public function getSchemaFieldDescription(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $translationAPI = TranslationAPIFacade::getInstance();
        $descriptions = [
			'icon' => $translationAPI->__('', ''),
            'url' => $translationAPI->__('', ''),
            'message' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    public function resolveCanProcessResultItem(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = []): bool
    {
        $notification = $resultItem;
        return $notification->object_type == 'User' && in_array(
            $notification->action,
            [
                AAL_POP_ACTION_USER_LOGGEDIN,
                AAL_POP_ACTION_USER_LOGGEDOUT,
            ]
        );
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $notification = $resultItem;
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        switch ($fieldName) {
            case 'icon':
                $routes = array(
                    AAL_POP_ACTION_USER_LOGGEDIN => POP_USERLOGIN_ROUTE_LOGIN,
                    AAL_POP_ACTION_USER_LOGGEDOUT => POP_USERLOGIN_ROUTE_LOGOUT,
                );
                return getRouteIcon($routes[$notification->action], false);

            case 'url':
                return $cmsusersapi->getUserURL($notification->user_id);

            case 'message':
                $messages = array(
                    AAL_POP_ACTION_USER_LOGGEDIN => TranslationAPIFacade::getInstance()->__('<strong>%s</strong> logged in', 'pop-notifications'),
                    AAL_POP_ACTION_USER_LOGGEDOUT => TranslationAPIFacade::getInstance()->__('<strong>%s</strong> logged out', 'pop-notifications'),
                );
                return sprintf(
                    $messages[$notification->action],
                    $cmsusersapi->getUserDisplayName($notification->user_id)
                );
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
    
// Static Initialization: Attach
PoP_Notifications_UserLogin_DataLoad_FieldResolver_Notifications::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS, 20);