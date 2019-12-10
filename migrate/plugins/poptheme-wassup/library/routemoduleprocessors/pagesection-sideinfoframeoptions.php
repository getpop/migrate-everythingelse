<?php

class PoP_Module_SideInfoFrameOptionsPageSectionRouteModuleProcessor extends PoP_Module_SideInfoFrameOptionsPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsProperties()
    {
        $ret = array();

        // Default
        $ret[] = [
        	'module' => [GD_Wassup_Module_Processor_AnchorControls::class, GD_Wassup_Module_Processor_AnchorControls::MODULE_ANCHORCONTROL_TOGGLESIDEINFOXS_BACK],
        ];

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() { 
	\PoP\ModuleRouting\Facades\RouteModuleProcessorManagerFacade::getInstance()->add(
		new PoP_Module_SideInfoFrameOptionsPageSectionRouteModuleProcessor()
	);
}, 200);