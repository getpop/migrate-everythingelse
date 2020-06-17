<?php

use PoP\CustomPosts\Routing\RouteNatures as PostRouteNatures;
use PoP\ModuleRouting\Facades\RouteModuleProcessorManagerFacade;

class PoP_Module_QuickviewFrameBottomOptionsPageSectionRouteModuleProcessor extends PoP_Module_QuickviewFrameTopOptionsPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNature()
    {
        $ret = array();

        $pop_module_routemoduleprocessor_manager = RouteModuleProcessorManagerFacade::getInstance();

        // Get the value of the SideInfo Content. If it is not the "Close Sideinfo" module, then we need to add support to toggle the SideInfo
        $load_module = true;
        if (PoPThemeWassup_Utils::checkLoadingPagesectionModule()) {
            $load_module = [PoP_Module_Processor_PageSections::class, PoP_Module_Processor_PageSections::MODULE_PAGESECTION_QUICKVIEW] == $pop_module_routemoduleprocessor_manager->getRouteModuleByMostAllmatchingVarsProperties(POP_PAGEMODULEGROUP_TOPLEVEL_CONTENTPAGESECTION);
        }

        if ($load_module) {
            $ret[PostRouteNatures::POST][] = [
                'module' => [PoP_Module_Processor_AnchorControls::class, PoP_Module_Processor_AnchorControls::MODULE_ANCHORCONTROL_CLOSEPAGEBTNBIG]
            ];
        }

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ModuleRouting\Facades\RouteModuleProcessorManagerFacade::getInstance()->add(
		new PoP_Module_QuickviewFrameBottomOptionsPageSectionRouteModuleProcessor()
	);
}, 200);
