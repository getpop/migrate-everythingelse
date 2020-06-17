<?php

use PoP\Routing\RouteNatures;
use PoP\CustomPosts\Routing\RouteNatures as PostRouteNatures;
use PoP\Users\Routing\RouteNatures as UserRouteNatures;
use PoP\Taxonomies\Routing\RouteNatures as TaxonomyRouteNatures;

class PoPTheme_Wassup_LocationPosts_Module_SideInfoContentPageSectionRouteModuleProcessor extends PoP_Module_SideInfoContentPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $modules = array(
            POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS => [PoPSP_URE_EM_Module_Processor_SidebarMultiples::class, PoPSP_URE_EM_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_AUTHORLOCATIONPOSTS_SIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[UserRouteNatures::USER][$route][] = ['module' => $module];
        }

        $modules = array(
            POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS => [PoPSP_URE_EM_Module_Processor_SidebarMultiples::class, PoPSP_URE_EM_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_TAG_LOCATIONPOSTS_SIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[TaxonomyRouteNatures::TAG][$route][] = ['module' => $module];
        }

        $modules = array(
            POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS => [PoPSP_URE_EM_Module_Processor_SidebarMultiples::class, PoPSP_URE_EM_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_TAG_LOCATIONPOSTS_SIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[TaxonomyRouteNatures::TAG][$route][] = ['module' => $module];
        }

        $modules = array(
            POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS => [PoPSP_URE_EM_Module_Processor_SidebarMultiples::class, PoPSP_URE_EM_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SECTION_LOCATIONPOSTS_SIDEBAR],
        );
        foreach ($modules as $route => $module) {
            $ret[RouteNatures::STANDARD][$route][] = ['module' => $module];
        }

        return $ret;
    }

    public function getModulesVarsPropertiesByNature()
    {
        $ret = array();

        $ret[PostRouteNatures::POST][] = [
            'module' => [PoPSP_URE_EM_Module_Processor_SidebarMultiples::class, PoPSP_URE_EM_Module_Processor_SidebarMultiples::MODULE_MULTIPLE_SINGLE_LOCATIONPOST_SIDEBAR],
            'conditions' => [
                'routing-state' => [
                    'queried-object-post-type' => POP_LOCATIONPOSTS_POSTTYPE_LOCATIONPOST,
                ],
            ],
        ];

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() {
	\PoP\ModuleRouting\Facades\RouteModuleProcessorManagerFacade::getInstance()->add(
		new PoPTheme_Wassup_LocationPosts_Module_SideInfoContentPageSectionRouteModuleProcessor()
	);
}, 200);
