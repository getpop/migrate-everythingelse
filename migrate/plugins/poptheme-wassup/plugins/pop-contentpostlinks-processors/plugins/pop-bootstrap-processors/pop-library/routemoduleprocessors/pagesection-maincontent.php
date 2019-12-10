<?php

use PoP\Routing\RouteNatures;
use PoP\Users\Routing\RouteNatures as UserRouteNatures;
use PoP\Taxonomies\Routing\RouteNatures as TaxonomyRouteNatures;

class PoPTheme_Wassup_CPL_Bootstrap_Module_MainPageSectionRouteModuleProcessor extends PoP_Module_MainPageSectionRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $routemodules = array(
            POP_CONTENTPOSTLINKS_ROUTE_CONTENTPOSTLINKS => [PoP_ContentPostLinks_Module_Processor_SectionTabPanelBlocks::class, PoP_ContentPostLinks_Module_Processor_SectionTabPanelBlocks::MODULE_BLOCK_TABPANEL_LINKS],
        );
        foreach ($routemodules as $route => $module) {
            $ret[RouteNatures::STANDARD][$route][] = [
                'module' => $module,
                'conditions' => [
                    'themestyle' => GD_THEMESTYLE_WASSUP_EXPANSIVE,
                ],
            ];
        }

        $routemodules = array(
            POP_CONTENTPOSTLINKS_ROUTE_CONTENTPOSTLINKS => [PoP_ContentPostLinks_Module_Processor_AuthorSectionTabPanelBlocks::class, PoP_ContentPostLinks_Module_Processor_AuthorSectionTabPanelBlocks::MODULE_BLOCK_TABPANEL_AUTHORLINKS],
        );
        foreach ($routemodules as $route => $module) {
            $ret[UserRouteNatures::USER][$route][] = [
                'module' => $module,
                'conditions' => [
                    'themestyle' => GD_THEMESTYLE_WASSUP_EXPANSIVE,
                ],
            ];
        }

        $routemodules = array(
            POP_CONTENTPOSTLINKS_ROUTE_CONTENTPOSTLINKS => [PoP_ContentPostLinks_Module_Processor_TagSectionTabPanelBlocks::class, PoP_ContentPostLinks_Module_Processor_TagSectionTabPanelBlocks::MODULE_BLOCK_TABPANEL_TAGLINKS],
        );
        foreach ($routemodules as $route => $module) {
            $ret[TaxonomyRouteNatures::TAG][$route][] = [
                'module' => $module,
                'conditions' => [
                    'themestyle' => GD_THEMESTYLE_WASSUP_EXPANSIVE,
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
		new PoPTheme_Wassup_CPL_Bootstrap_Module_MainPageSectionRouteModuleProcessor()
	);
}, 200);