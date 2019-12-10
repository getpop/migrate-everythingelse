<?php
use PoP\ComponentModel\Utils;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\Schema\SchemaDefinition;
use PoP\ComponentModel\FieldResolvers\AbstractDBDataFieldResolver;
use PoP\ComponentModel\TypeResolvers\TypeResolverInterface;
use PoP\ComponentModel\Schema\TypeCastingHelpers;
use PoP\Notifications\TypeResolvers\NotificationTypeResolver;

class URE_AAL_PoP_DataLoad_FieldResolver_Notifications extends AbstractDBDataFieldResolver
{
    public static function getClassesToAttachTo(): array
    {
        return array(NotificationTypeResolver::class);
    }

    public static function getFieldNamesToResolve(): array
    {
        return [
            'edit-user-membership-url',
            'community-members-url',
            'memberstatus',
            'memberstatus-byname',
            'memberprivileges',
            'memberprivileges-byname',
            'membertags',
            'membertags-byname',
            'icon',
            'url',
            'message',
        ];
    }

    public function getSchemaFieldType(TypeResolverInterface $typeResolver, string $fieldName): ?string
    {
        $types = [
            'edit-user-membership-url' => SchemaDefinition::TYPE_URL,
            'community-members-url' => SchemaDefinition::TYPE_URL,
            'memberstatus' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ENUM),
            'memberstatus-byname' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_STRING),
            'memberprivileges' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ENUM),
            'memberprivileges-byname' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_STRING),
            'membertags' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_ENUM),
            'membertags-byname' => TypeCastingHelpers::combineTypes(SchemaDefinition::TYPE_ARRAY, SchemaDefinition::TYPE_STRING),
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
            'edit-user-membership-url' => $translationAPI->__('', ''),
            'community-members-url' => $translationAPI->__('', ''),
            'memberstatus' => $translationAPI->__('', ''),
            'memberstatus-byname' => $translationAPI->__('', ''),
            'memberprivileges' => $translationAPI->__('', ''),
            'memberprivileges-byname' => $translationAPI->__('', ''),
            'membertags' => $translationAPI->__('', ''),
            'membertags-byname' => $translationAPI->__('', ''),
            'icon' => $translationAPI->__('', ''),
            'url' => $translationAPI->__('', ''),
            'message' => $translationAPI->__('', ''),
        ];
        return $descriptions[$fieldName] ?? parent::getSchemaFieldDescription($typeResolver, $fieldName);
    }

    protected function addSchemaDefinitionForField(array &$schemaDefinition, string $fieldName)
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
                $schemaDefinition[SchemaDefinition::ARGNAME_ENUMVALUES] = array_keys((new $class())->getAllValues());
                break;
        }
    }

    public function resolveCanProcessResultItem(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = []): bool
    {
        if (in_array($fieldName, [
            'icon',
            'url',
            'message',
        ])) {
            $notification = $resultItem;
            return $notification->object_type == 'User' && in_array(
                $notification->action,
                [
                    URE_AAL_POP_ACTION_USER_JOINEDCOMMUNITY,
                    URE_AAL_POP_ACTION_USER_UPDATEDUSERMEMBERSHIP,
                    URE_AAL_POP_ACTION_USER_UPDATEDCOMMUNITIES,
                ]
            );
        }
        return true;
    }

    public function resolveValue(TypeResolverInterface $typeResolver, $resultItem, string $fieldName, array $fieldArgs = [], ?array $variables = null, ?array $expressions = null, array $options = [])
    {
        $notification = $resultItem;
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmsengineapi = \PoP\Engine\FunctionAPIFactory::getInstance();
        switch ($fieldName) {
            case 'edit-user-membership-url':
                return gdUreEditMembershipUrl($notification->user_id);

            case 'community-members-url':
                return \PoP\ComponentModel\Utils::addRoute($cmsusersapi->getUserURL($notification->object_id), POP_USERCOMMUNITIES_ROUTE_MEMBERS);

         // ----------------------------------------
         // All fields below were copied from plugins/user-role-editor-popprocessors/pop-library/dataload/fieldresolvers/typeResolver-users-hook.php,
         // where they are applied on users, while here below they are applied on notifications
         // ----------------------------------------
            case 'memberstatus':
                // object_id is the user whose membership was updated
                $status = \PoP\UserMeta\Utils::getUserMeta($notification->object_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERSTATUS);

                // Filter status for the community: user_id
                return gdUreCommunityMembershipstatusFilterbycommunity($status, $notification->user_id);

            case 'memberstatus-byname':
                $selected = $typeResolver->resolveValue($notification, 'memberstatus', $variables, $expressions, $options);
                $params = array(
                    'selected' => $selected
                );
                $status = new GD_URE_FormInput_MultiMemberStatus($params);
                return $status->getSelectedValue();

            case 'memberprivileges':
                $privileges = \PoP\UserMeta\Utils::getUserMeta($notification->object_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERPRIVILEGES);

                // Filter status for the community: user_id
                return gdUreCommunityMembershipstatusFilterbycommunity($privileges, $notification->user_id);

            case 'memberprivileges-byname':
                $selected = $typeResolver->resolveValue($notification, 'memberprivileges', $variables, $expressions, $options);
                $params = array(
                    'selected' => $selected
                );
                $privileges = new GD_URE_FormInput_FilterMemberPrivileges($params);
                return $privileges->getSelectedValue();

            case 'membertags':
                $tags = \PoP\UserMeta\Utils::getUserMeta($notification->object_id, GD_URE_METAKEY_PROFILE_COMMUNITIES_MEMBERTAGS);

                // Filter status for the community: user_id
                return gdUreCommunityMembershipstatusFilterbycommunity($tags, $notification->user_id);

            case 'membertags-byname':
                $selected = $typeResolver->resolveValue($notification, 'membertags', $variables, $expressions, $options);
                $params = array(
                    'selected' => $selected
                );
                $tags = new GD_URE_FormInput_FilterMemberTags($params);
                return $tags->getSelectedValue();
         // ----------------------------------------

            case 'icon':
                switch ($notification->action) {
                    case URE_AAL_POP_ACTION_USER_JOINEDCOMMUNITY:
                        return getRouteIcon(POP_USERCOMMUNITIES_ROUTE_INVITENEWMEMBERS, false);

                    case URE_AAL_POP_ACTION_USER_UPDATEDUSERMEMBERSHIP:
                        return getRouteIcon(POP_USERCOMMUNITIES_ROUTE_EDITMEMBERSHIP, false);

                    case URE_AAL_POP_ACTION_USER_UPDATEDCOMMUNITIES:
                        return getRouteIcon(POP_USERCOMMUNITIES_ROUTE_MYCOMMUNITIES, false);
                }
                return null;
            
            case 'url':
                switch ($notification->action) {
                    case URE_AAL_POP_ACTION_USER_JOINEDCOMMUNITY:
                    case URE_AAL_POP_ACTION_USER_UPDATEDUSERMEMBERSHIP:
                    case URE_AAL_POP_ACTION_USER_UPDATEDCOMMUNITIES:
                        // Joined Community: link to the profile of the user joining
                        // Updated User Membership: link to the profile of the community
                        return $cmsusersapi->getUserURL($notification->user_id);
                }
                return null;

            case 'message':
                switch ($notification->action) {
                    case URE_AAL_POP_ACTION_USER_JOINEDCOMMUNITY:
                        return sprintf(
                            TranslationAPIFacade::getInstance()->__('<strong>%s</strong> has joined <strong>%s</strong>', 'ure-pop'),
                            $cmsusersapi->getUserDisplayName($notification->user_id),
                            $cmsusersapi->getUserDisplayName($notification->object_id)
                        );
                
                    case URE_AAL_POP_ACTION_USER_UPDATEDUSERMEMBERSHIP:
                        // Change the message depending if the logged in user is the object of this action
                        $recipient = ($vars['global-userstate']['current-user-id'] == $notification->object_id) ? TranslationAPIFacade::getInstance()->__('your', 'ure-pop') : sprintf('<strong>%s</strong>’s', $cmsengineapi->getUserDisplayName($notification->object_id));
                        return sprintf(
                            TranslationAPIFacade::getInstance()->__('<strong>%s</strong> has updated %s membership settings:', 'ure-pop'),
                            $cmsusersapi->getUserDisplayName($notification->user_id),
                            $recipient
                        );

                    case URE_AAL_POP_ACTION_USER_UPDATEDCOMMUNITIES:
                        $messages = array(
                            URE_AAL_POP_ACTION_USER_UPDATEDCOMMUNITIES => TranslationAPIFacade::getInstance()->__('<strong>%s</strong> updated the communities', 'ure-pop'),
                        );
                        return sprintf(
                            $messages[$notification->action],
                            $cmsusersapi->getUserDisplayName($notification->user_id)
                        );
                }
                return null;
        }

        return parent::resolveValue($typeResolver, $resultItem, $fieldName, $fieldArgs, $variables, $expressions, $options);
    }
}
    
// Static Initialization: Attach
URE_AAL_PoP_DataLoad_FieldResolver_Notifications::attach(\PoP\ComponentModel\AttachableExtensions\AttachableExtensionGroups::FIELDRESOLVERS, 20);