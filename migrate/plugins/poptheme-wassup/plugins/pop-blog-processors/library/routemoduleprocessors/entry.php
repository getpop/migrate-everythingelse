<?php

use PoP\Routing\RouteNatures;
use PoPSchema\CustomPosts\Routing\RouteNatures as CustomPostRouteNatures;
use PoPSchema\Users\Routing\RouteNatures as UserRouteNatures;
use PoPSchema\Tags\Routing\RouteNatures as TagRouteNatures;
use PoP\RESTAPI\DataStructureFormatters\RESTDataStructureFormatter;
use PoP\ComponentModel\State\ApplicationState;

class PoPTheme_Wassup_Blog_Module_EntryRouteModuleProcessor extends \PoP\ModuleRouting\AbstractEntryRouteModuleProcessor
{
    // public function getModulesVarsPropertiesByNature()
    // {
    //     $ret = array();

    //     // API
    //     if (!\PoP\API\Environment::disableAPI()) {
    //         // Home
    //         $ret[RouteNatures::HOME][] = [
    //             'module' => [PoP_Blog_Module_Processor_FieldDataloads::class, PoP_Blog_Module_Processor_FieldDataloads::MODULE_DATALOAD_RELATIONALFIELDS_CUSTOMPOSTLIST],
    //             'conditions' => [
    //                 'scheme' => POP_SCHEME_API,
    //             ],
    //         ];
    //     }

    //     return $ret;
    // }

    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        // API
        if (!\PoP\API\Environment::disableAPI()) {

            $vars = ApplicationState::getVars();

            // Page
            $routemodules = array(
                POP_BLOG_ROUTE_CONTENT => [PoP_Blog_Module_Processor_FieldDataloads::class, PoP_Blog_Module_Processor_FieldDataloads::MODULE_DATALOAD_RELATIONALFIELDS_CUSTOMPOSTLIST],
            );
            foreach ($routemodules as $route => $module) {
                $ret[RouteNatures::STANDARD][$route][] = [
                    'module' => $module,
                    'conditions' => [
                        'scheme' => POP_SCHEME_API,
                    ],
                ];
            }

            // REST API Page
            $routemodules = array(
                POP_BLOG_ROUTE_CONTENT => [PoP_Blog_Module_Processor_FieldDataloads::class, PoP_Blog_Module_Processor_FieldDataloads::MODULE_DATALOAD_RELATIONALFIELDS_CUSTOMPOSTLIST],
            );
            foreach ($routemodules as $route => $module) {
                $ret[RouteNatures::STANDARD][$route][] = [
                    'module' => $module,
                    'conditions' => [
                        'scheme' => POP_SCHEME_API,
                        'datastructure' => RESTDataStructureFormatter::getName(),
                    ],
                ];
            }

            // Author
            $routemodules = array(
                POP_BLOG_ROUTE_CONTENT => [PoP_Blog_Module_Processor_FieldDataloads::class, PoP_Blog_Module_Processor_FieldDataloads::MODULE_DATALOAD_RELATIONALFIELDS_AUTHORCONTENTLIST],
            );
            foreach ($routemodules as $route => $module) {
                $ret[UserRouteNatures::USER][$route][] = [
                    'module' => $module,
                    'conditions' => [
                        'scheme' => POP_SCHEME_API,
                    ],
                ];
            }

            // Tag
            $routemodules = array(
                POP_BLOG_ROUTE_CONTENT => [PoP_Blog_Module_Processor_FieldDataloads::class, PoP_Blog_Module_Processor_FieldDataloads::MODULE_DATALOAD_RELATIONALFIELDS_TAGCONTENTLIST],
            );
            foreach ($routemodules as $route => $module) {
                $ret[TagRouteNatures::TAG][$route][] = [
                    'module' => $module,
                    'conditions' => [
                        'scheme' => POP_SCHEME_API,
                    ],
                ];
            }

            // Single
            $routemodules = array(
                POP_ROUTE_AUTHORS => [PoP_Blog_Module_Processor_FieldDataloads::class, PoP_Blog_Module_Processor_FieldDataloads::MODULE_DATALOAD_RELATIONALFIELDS_SINGLEAUTHORLIST],
            );
            foreach ($routemodules as $route => $module) {
                $ret[CustomPostRouteNatures::CUSTOMPOST][$route][] = [
                    'module' => $module,
                    'conditions' => [
                        'scheme' => POP_SCHEME_API,
                    ],
                ];
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
    new PoPTheme_Wassup_Blog_Module_EntryRouteModuleProcessor()
	);
}, 200);
