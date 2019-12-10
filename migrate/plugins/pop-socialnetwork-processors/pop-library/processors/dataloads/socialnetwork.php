<?php
use PoP\ComponentModel\ModuleProcessors\DataloadingConstants;
use PoP\UserState\CheckpointSets\UserStateCheckpointSets;
use PoP\Posts\TypeDataResolvers\PostTypeDataResolver;
use PoP\Taxonomies\TypeDataResolvers\TagTypeDataResolver;
use PoP\Users\TypeDataResolvers\UserTypeDataResolver;

class PoP_Module_Processor_FunctionsDataloads extends PoP_Module_Processor_DataloadsBase
{
    public const MODULE_DATALOAD_FOLLOWSUSERS = 'dataload-followsusers';
    public const MODULE_DATALOAD_RECOMMENDSPOSTS = 'dataload-recommendsposts';
    public const MODULE_DATALOAD_SUBSCRIBESTOTAGS = 'dataload-subscribestotags';
    public const MODULE_DATALOAD_UPVOTESPOSTS = 'dataload-upvotesposts';
    public const MODULE_DATALOAD_DOWNVOTESPOSTS = 'dataload-downvotesposts';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_DATALOAD_FOLLOWSUSERS],
            [self::class, self::MODULE_DATALOAD_RECOMMENDSPOSTS],
            [self::class, self::MODULE_DATALOAD_SUBSCRIBESTOTAGS],
            [self::class, self::MODULE_DATALOAD_UPVOTESPOSTS],
            [self::class, self::MODULE_DATALOAD_DOWNVOTESPOSTS],
        );
    }

    // function getDataaccessCheckpointConfiguration(array $module, array &$props) {
    public function getDataaccessCheckpoints(array $module, array &$props): array
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_FOLLOWSUSERS:
            case self::MODULE_DATALOAD_RECOMMENDSPOSTS:
            case self::MODULE_DATALOAD_SUBSCRIBESTOTAGS:
            case self::MODULE_DATALOAD_UPVOTESPOSTS:
            case self::MODULE_DATALOAD_DOWNVOTESPOSTS:
                return $this->maybeOverrideCheckpoints(UserStateCheckpointSets::LOGGEDIN_DATAFROMSERVER);//PoP_UserLogin_SettingsProcessor_CheckpointHelper::getCheckpointConfiguration(UserStateCheckpointSets::LOGGEDIN_DATAFROMSERVER);
        }
        
        // return parent::getDataaccessCheckpointConfiguration($module, $props);
        return parent::getDataaccessCheckpoints($module, $props);
    }

    protected function addHeaddatasetmoduleDataProperties(&$ret, array $module, array &$props)
    {
        parent::addHeaddatasetmoduleDataProperties($ret, $module, $props);

        switch ($module[1]) {
            case self::MODULE_DATALOAD_FOLLOWSUSERS:
            case self::MODULE_DATALOAD_RECOMMENDSPOSTS:
            case self::MODULE_DATALOAD_SUBSCRIBESTOTAGS:
            case self::MODULE_DATALOAD_UPVOTESPOSTS:
            case self::MODULE_DATALOAD_DOWNVOTESPOSTS:
                // If the user is not logged in, then do not load the data
                $vars = \PoP\ComponentModel\Engine_Vars::getVars();
                if (!PoP_UserState_Utils::currentRouteRequiresUserState() || !$vars['global-userstate']['is-user-logged-in']) {
                    $ret[DataloadingConstants::SKIPDATALOAD] = true;
                }
                break;
        }
    }

    public function getImmutableHeaddatasetmoduleDataProperties(array $module, array &$props): array
    {
        $ret = parent::getImmutableHeaddatasetmoduleDataProperties($module, $props);
    
        switch ($module[1]) {
            case self::MODULE_DATALOAD_FOLLOWSUSERS:
            case self::MODULE_DATALOAD_RECOMMENDSPOSTS:
            case self::MODULE_DATALOAD_UPVOTESPOSTS:
            case self::MODULE_DATALOAD_DOWNVOTESPOSTS:
            case self::MODULE_DATALOAD_SUBSCRIBESTOTAGS:
                // Bring all of them and then don't bring anymore
                $ret[GD_DATALOAD_QUERYHANDLERPROPERTY_LIST_STOPFETCHING] = true;
                $ret[DataloadingConstants::QUERYARGS]['limit'] = -1;
                break;
        }
        
        return $ret;
    }

    protected function getInnerSubmodules(array $module): array
    {
        $ret = parent::getInnerSubmodules($module);

        $layouts = array(
            self::MODULE_DATALOAD_FOLLOWSUSERS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::MODULE_CONTENT_FOLLOWSUSERS],
            self::MODULE_DATALOAD_RECOMMENDSPOSTS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::MODULE_CONTENT_RECOMMENDSPOSTS],
            self::MODULE_DATALOAD_SUBSCRIBESTOTAGS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::MODULE_CONTENT_SUBSCRIBESTOTAGS],
            self::MODULE_DATALOAD_UPVOTESPOSTS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::MODULE_CONTENT_UPVOTESPOSTS],
            self::MODULE_DATALOAD_DOWNVOTESPOSTS => [PoP_Module_Processor_FunctionsContents::class, PoP_Module_Processor_FunctionsContents::MODULE_CONTENT_DOWNVOTESPOSTS],
        );
        if ($layout = $layouts[$module[1]]) {
            $ret[] = $layout;
        }
    
        return $ret;
    }

    public function getDBObjectIDOrIDs(array $module, array &$props, &$data_properties)
    {
        // All of these modules require the user to be logged in
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        if (!$vars['global-userstate']['is-user-logged-in']) {
            return [];
        }

        $metaKeys = [
            self::MODULE_DATALOAD_FOLLOWSUSERS => GD_METAKEY_PROFILE_FOLLOWSUSERS,
            self::MODULE_DATALOAD_RECOMMENDSPOSTS => GD_METAKEY_PROFILE_RECOMMENDSPOSTS,
            self::MODULE_DATALOAD_SUBSCRIBESTOTAGS => GD_METAKEY_PROFILE_SUBSCRIBESTOTAGS,
            self::MODULE_DATALOAD_UPVOTESPOSTS => GD_METAKEY_PROFILE_UPVOTESPOSTS,
            self::MODULE_DATALOAD_DOWNVOTESPOSTS => GD_METAKEY_PROFILE_DOWNVOTESPOSTS,
        ];

        if ($metaKey = $metaKeys[$module[1]]) {
            $userID = $vars['global-userstate']['current-user-id'];
            return \PoP\UserMeta\Utils::getUserMeta($userID, $metaKey) ?? [];
        }
        
        return parent::getDBObjectIDOrIDs($module, $props, $data_properties);
    }

    public function getTypeDataResolverClass(array $module): ?string
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_FOLLOWSUSERS:
                return UserTypeDataResolver::class;

            case self::MODULE_DATALOAD_UPVOTESPOSTS:
            case self::MODULE_DATALOAD_RECOMMENDSPOSTS:
            case self::MODULE_DATALOAD_DOWNVOTESPOSTS:
                return PostTypeDataResolver::class;

            case self::MODULE_DATALOAD_SUBSCRIBESTOTAGS:
                return TagTypeDataResolver::class;
        }
        
        return parent::getTypeDataResolverClass($module);
    }
    
    public function initModelProps(array $module, array &$props)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_FOLLOWSUSERS:
            case self::MODULE_DATALOAD_RECOMMENDSPOSTS:
            case self::MODULE_DATALOAD_UPVOTESPOSTS:
            case self::MODULE_DATALOAD_DOWNVOTESPOSTS:
            case self::MODULE_DATALOAD_SUBSCRIBESTOTAGS:
                $this->appendProp($module, $props, 'class', 'hidden');
                break;
        }
        
        parent::initModelProps($module, $props);
    }
}


