<?php

use PoP\Posts\Routing\RouteNatures as PostRouteNatures;

class PoPTheme_Wassup_Events_AddHighlights_Module_SideInfoContentPageSectionRouteModuleProcessor extends PoP_Module_SideInfoContentPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $pluginapi = PoP_Events_APIFactory::getInstance();

        // Past single event
        $modules = array(
            POP_ADDHIGHLIGHTS_ROUTE_HIGHLIGHTS => [PoP_Events_AddHighlights_Module_Processor_SidebarMultiples::class, PoP_Events_AddHighlights_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SINGLE_PASTEVENT_HIGHLIGHTSSIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[PostRouteNatures::POST][$route][] = [
                'module' => $module,
                'conditions' => [
                    'routing-state' => [
                        'queried-object-post-type' => $pluginapi->getEventPostType(),
                        'queried-object-is-past-event' => true,
                    ],
                ],
            ];
        }

        // Future and current single event
        $modules = array(
            POP_ADDHIGHLIGHTS_ROUTE_HIGHLIGHTS => [PoP_Events_AddHighlights_Module_Processor_SidebarMultiples::class, PoP_Events_AddHighlights_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SINGLE_EVENT_HIGHLIGHTSSIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[PostRouteNatures::POST][$route][] = [
                'module' => $module,
                'conditions' => [
                    'routing-state' => [
                        'queried-object-post-type' => $pluginapi->getEventPostType(),
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
		new PoPTheme_Wassup_Events_AddHighlights_Module_SideInfoContentPageSectionRouteModuleProcessor()
	);
}, 200);