<?php

use PoP\Posts\Routing\RouteNatures as PostRouteNatures;

class PoPTheme_Wassup_LocationPosts_AddHighlights_Module_SideInfoContentPageSectionRouteModuleProcessor extends PoP_Module_SideInfoContentPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $modules = array(
            POP_ADDHIGHLIGHTS_ROUTE_HIGHLIGHTS => [PoP_LocationPosts_AddHighlights_Module_Processor_SidebarMultiples::class, PoP_LocationPosts_AddHighlights_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SINGLE_LOCATIONPOST_HIGHLIGHTSSIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[PostRouteNatures::POST][$route][] = [
                'module' => $module,
                'conditions' => [
                    'routing-state' => [
                        'queried-object-post-type' => POP_LOCATIONPOSTS_POSTTYPE_LOCATIONPOST,
                    ],
                ],
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
		new PoPTheme_Wassup_LocationPosts_AddHighlights_Module_SideInfoContentPageSectionRouteModuleProcessor()
	);
}, 200);