<?php

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Routing\Routes as RoutingRoutes;
use PoP\Routing\RouteNatures;
use PoP\Posts\Routing\RouteNatures as PostRouteNatures;
use PoP\Users\Routing\RouteNatures as UserRouteNatures;
use PoP\Taxonomies\Routing\RouteNatures as TaxonomyRouteNatures;

class PoP_Module_SideInfoContentPageSectionRouteModuleProcessor extends PoP_Module_SideInfoContentPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $modules = array(
            POP_ROUTE_AUTHORS => [PoP_Module_Processor_SidebarMultiples::class, PoP_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SINGLE_POST_POSTAUTHORSSIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[PostRouteNatures::POST][$route][] = ['module' => $module];
        }

        $modules = array(
            RoutingRoutes::$MAIN => [PoP_Module_Processor_SidebarMultiples::class, PoP_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_TAG_MAINCONTENT_SIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[TaxonomyRouteNatures::TAG][$route][] = ['module' => $module];
        }

        $modules = array(
            RoutingRoutes::$MAIN => [PoP_Blog_Module_Processor_SidebarMultiples::class, PoP_Blog_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_AUTHORMAINCONTENT_SIDEBAR],
            POP_ROUTE_DESCRIPTION => [PoP_Blog_Module_Processor_SidebarMultiples::class, PoP_Blog_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_AUTHOR_SIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[UserRouteNatures::USER][$route][] = ['module' => $module];
        }

        return $ret;
    }

    public function getModulesVarsPropertiesByNature()
    {
        $ret = array();

        // Default for Single
        $ret[PostRouteNatures::POST][] = [
            'module' => [PoP_Module_Processor_SidebarMultiples::class, PoP_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SINGLE_POST_SIDEBAR]
        ];

        // Default for Author
        $ret[UserRouteNatures::USER][] = [
            'module' => [PoP_Blog_Module_Processor_SidebarMultiples::class, PoP_Blog_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_AUTHOR_SIDEBAR]
        ];

        // Default for Tag
        $ret[TaxonomyRouteNatures::TAG][] = [
            'module' => [PoP_Module_Processor_CustomSidebarDataloads::class, PoP_Module_Processor_CustomSidebarDataloads::MODULE_DATALOAD_TAG_SIDEBAR]
        ];

        // Default for Home
        // Allow GetPoP website to change the sidebar, since it is changing the homeroute
        $home_module = HooksAPIFacade::getInstance()->applyFilters(
            'PoPTheme_Wassup_PageSectionSettingsProcessor:sideinfo_home:blockgroup', 
            [PoP_Module_Processor_SidebarMultiples::class, PoP_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_HOMESECTION_CONTENT_SIDEBAR]
        );
        $ret[RouteNatures::HOME][] = [
            'module' => $home_module,
        ];

        return $ret;
    }

    public function getModulesVarsProperties()
    {
        $ret = array();

        // For the body, instead of adding no SideInfo, add the one that causes the SideInfo to close. This way, if we open a route without Sideinfo (eg: Add Post), from one which does (eg: Posts), then make it close, otherwise the Sideinfo from the 1st route will remain open
        $ret[] = [
            'module' => [PoP_Module_Processor_Codes::class, PoP_Module_Processor_Codes::MODULE_CODE_EMPTYSIDEINFO],
        ];

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() { 
	\PoP\ModuleRouting\Facades\RouteModuleProcessorManagerFacade::getInstance()->add(
		new PoP_Module_SideInfoContentPageSectionRouteModuleProcessor()
	);
}, 200);