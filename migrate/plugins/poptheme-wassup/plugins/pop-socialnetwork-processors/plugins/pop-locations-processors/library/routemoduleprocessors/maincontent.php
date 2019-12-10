<?php

use PoP\Posts\Routing\RouteNatures as PostRouteNatures;
use PoP\Users\Routing\RouteNatures as UserRouteNatures;
use PoP\Taxonomies\Routing\RouteNatures as TaxonomyRouteNatures;

class Wassup_EM_SocialNetwork_Module_MainContentRouteModuleProcessor extends \PoP\Application\AbstractMainContentRouteModuleProcessor
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $default_format_authorusers = PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_AUTHORUSERS);
        $routemodules_map = array(
            POP_SOCIALNETWORK_ROUTE_FOLLOWERS => [PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::class, PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::MODULE_BLOCK_AUTHORFOLLOWERS_SCROLLMAP],
            POP_SOCIALNETWORK_ROUTE_FOLLOWINGUSERS => [PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::class, PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::MODULE_BLOCK_AUTHORFOLLOWINGUSERS_SCROLLMAP],
        );
        foreach ($routemodules_map as $route => $module) {
            $ret[UserRouteNatures::USER][$route][] = [
                'module' => $module,
                'conditions' => [
                    'format' => POP_FORMAT_MAP,
                ],
            ];
            if ($default_format_authorusers == POP_FORMAT_MAP) {
                $ret[UserRouteNatures::USER][$route][] = ['module' => $module];
            }
        }

        // Single route modules
        $default_format_singleusers = PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_SINGLEUSERS);
        $routemodules_map = array(
            POP_SOCIALNETWORK_ROUTE_RECOMMENDEDBY => [PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::class, PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::MODULE_BLOCK_SINGLERECOMMENDEDBY_SCROLLMAP],
            POP_SOCIALNETWORK_ROUTE_UPVOTEDBY => [PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::class, PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::MODULE_BLOCK_SINGLEUPVOTEDBY_SCROLLMAP],
            POP_SOCIALNETWORK_ROUTE_DOWNVOTEDBY => [PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::class, PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::MODULE_BLOCK_SINGLEDOWNVOTEDBY_SCROLLMAP],
        );
        foreach ($routemodules_map as $route => $module) {
            $ret[PostRouteNatures::POST][$route][] = [
                'module' => $module,
                'conditions' => [
                    'format' => POP_FORMAT_MAP,
                ],
            ];
            if ($default_format_singleusers == POP_FORMAT_MAP) {
                $ret[PostRouteNatures::POST][$route][] = ['module' => $module];
            }
        }

        // Tag route modules
        $default_format_tagusers = PoP_Application_Utils::getDefaultformatByScreen(POP_SCREEN_TAGUSERS);
        $routemodules_map = array(
            POP_SOCIALNETWORK_ROUTE_SUBSCRIBERS => [PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::class, PoP_Locations_SocialNetwork_Module_Processor_CustomScrollMapSectionBlocks::MODULE_BLOCK_TAGSUBSCRIBERS_SCROLLMAP],
        );
        foreach ($routemodules_map as $route => $module) {
            $ret[TaxonomyRouteNatures::TAG][$route][] = [
                'module' => $module,
                'conditions' => [
                    'format' => POP_FORMAT_MAP,
                ],
            ];
            if ($default_format_tagusers == POP_FORMAT_MAP) {
                $ret[TaxonomyRouteNatures::TAG][$route][] = ['module' => $module];
            }
        }

        return $ret;
    }
}

/**
 * Initialization
 */
add_action('init', function() { 
	\PoP\ModuleRouting\Facades\RouteModuleProcessorManagerFacade::getInstance()->add(
		new Wassup_EM_SocialNetwork_Module_MainContentRouteModuleProcessor()
	);
}, 200);