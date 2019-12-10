<?php

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Posts\Routing\RouteNatures as PostRouteNatures;
use PoP\QueriedObject\ModuleProcessors\QueriedDBObjectModuleProcessorTrait;
use PoP\Posts\TypeDataResolvers\ConvertiblePostTypeDataResolver;

class UserStance_Module_Processor_CustomSidebarDataloads extends PoP_Module_Processor_DataloadsBase
{
    use QueriedDBObjectModuleProcessorTrait;
    
    public const MODULE_DATALOAD_SINGLE_STANCE_SIDEBAR = 'dataload-single-stance-sidebar';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_DATALOAD_SINGLE_STANCE_SIDEBAR],
        );
    }

    protected function getInnerSubmodules(array $module): array
    {
        $ret = parent::getInnerSubmodules($module);

        $orientation = HooksAPIFacade::getInstance()->applyFilters(POP_HOOK_BLOCKSIDEBARS_ORIENTATION, 'vertical');
        $vertical = ($orientation == 'vertical');

        $inners = array(
            self::MODULE_DATALOAD_SINGLE_STANCE_SIDEBAR => $vertical ? 
                [UserStance_Module_Processor_CustomVerticalSingleSidebars::class, UserStance_Module_Processor_CustomVerticalSingleSidebars::MODULE_VERTICALSIDEBAR_SINGLE_STANCE] : 
                [UserStance_Module_Processor_CustomPostLayoutSidebars::class, UserStance_Module_Processor_CustomPostLayoutSidebars::MODULE_LAYOUT_POSTSIDEBAR_HORIZONTAL_STANCE],
        );
        if ($inner = $inners[$module[1]]) {
            $ret[] = $inner;
        }
    
        return $ret;
    }
    
    // public function getNature(array $module)
    // {
    //     switch ($module[1]) {
    //         case self::MODULE_DATALOAD_SINGLE_STANCE_SIDEBAR:
    //             return PostRouteNatures::POST;
    //     }
        
    //     return parent::getNature($module);
    // }

    public function getDBObjectIDOrIDs(array $module, array &$props, &$data_properties)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_SINGLE_STANCE_SIDEBAR:
                return $this->getQueriedDBObjectID($module, $props, $data_properties);
        }
        
        return parent::getDBObjectIDOrIDs($module, $props, $data_properties);
    }

    public function getTypeDataResolverClass(array $module): ?string
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_SINGLE_STANCE_SIDEBAR:
                return ConvertiblePostTypeDataResolver::class;
        }
        
        return parent::getTypeDataResolverClass($module);
    }
}


