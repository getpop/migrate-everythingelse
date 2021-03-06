<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Engine\Route\RouteUtils;

HooksAPIFacade::getInstance()->addFilter('gd-createupdateutils:edit-url', 'popLocationpostlinkscreationCreateupdateutilsEditUrl', 100, 2);
function popLocationpostlinkscreationCreateupdateutilsEditUrl($url, $post_id)
{
    if (defined('POP_LOCATIONPOSTLINKS_CAT_LOCATIONPOSTLINKS') && POP_LOCATIONPOSTLINKS_CAT_LOCATIONPOSTLINKS && defined('POP_LOCATIONPOSTLINKSCREATION_ROUTE_EDITLOCATIONPOSTLINK') && POP_LOCATIONPOSTLINKSCREATION_ROUTE_EDITLOCATIONPOSTLINK) {
        $categoryapi = \PoPSchema\Categories\FunctionAPIFactory::getInstance();
        if ($categoryapi->hasCategory(POP_LOCATIONPOSTLINKS_CAT_LOCATIONPOSTLINKS, $post_id)) {
            return RouteUtils::getRouteURL(POP_LOCATIONPOSTLINKSCREATION_ROUTE_EDITLOCATIONPOSTLINK);
        }
    }

    return $url;
}
