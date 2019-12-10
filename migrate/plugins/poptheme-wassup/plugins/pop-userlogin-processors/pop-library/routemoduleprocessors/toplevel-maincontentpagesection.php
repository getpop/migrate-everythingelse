<?php

use PoP\Routing\RouteNatures;

class PoPTheme_Wassup_UserLogin_Module_ContentPageSectionTopLevelRouteModuleProcessor extends PoP_Module_ContentPageSectionTopLevelRouteModuleProcessorBase
{
    public function getModulesVarsPropertiesByNatureAndRoute()
    {
        $ret = array();

        $routes = array(
            POP_USERLOGIN_ROUTE_LOGIN,
            POP_USERLOGIN_ROUTE_LOGOUT,
            POP_USERLOGIN_ROUTE_LOSTPWD,
            POP_USERLOGIN_ROUTE_LOSTPWDRESET,
        );
        foreach ($routes as $route) {
            $ret[RouteNatures::STANDARD][$route][] = [
                'module' => [PoP_Module_Processor_Offcanvas::class, PoP_Module_Processor_Offcanvas::MODULE_OFFCANVAS_HOVER],
                'conditions' => [
                    'target' => POP_TARGET_MAIN,
                ],
            ];
        }

        // The routes below open in the Hole
        $routes = array(
            POP_USERLOGIN_ROUTE_LOGGEDINUSERDATA,
        );
        foreach ($routes as $route) {
            $ret[RouteNatures::STANDARD][$route][] = [
                'module' => [PoP_Module_Processor_PageSectionContainers::class, PoP_Module_Processor_PageSectionContainers::MODULE_PAGESECTIONCONTAINER_HOLE],
                'conditions' => [
                    'target' => POP_TARGET_MAIN,
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
		new PoPTheme_Wassup_UserLogin_Module_ContentPageSectionTopLevelRouteModuleProcessor()
	);
}, 200);