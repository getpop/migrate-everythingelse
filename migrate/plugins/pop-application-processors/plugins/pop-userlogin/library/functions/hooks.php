<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Engine\Route\RouteUtils;

class PoP_ApplicationProcessors_UserLogin_Hooks
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addFilter(
            'PoP_MultidomainProcessors_Module_Processor_Dataloads:backgroundurls',
            array($this, 'addBackgroundurls'),
            10,
            2
        );
    }

    public function addBackgroundurls($backgroundurls, $domain)
    {
        
        // Add the loggedinuser-data page for that domain
        $cmsengineapi = \PoP\Engine\FunctionAPIFactory::getInstance();
        $url = RouteUtils::getRouteURL(POP_USERLOGIN_ROUTE_LOGGEDINUSERDATA);        
        $homedomain = $cmsengineapi->getSiteURL();
        if ($domain != $homedomain) {
            $bloginfo_url = $cmsengineapi->getHomeURL();

            // Also send the path along (without language information)
            $path = substr($url, strlen($bloginfo_url));
            $url = $domain.substr($url, strlen($homedomain));

            // Allow to override (eg: for a given domain, the page slug may be different)
            $url = HooksAPIFacade::getInstance()->applyFilters(
                'PoP_ApplicationProcessors_UserLogin_Hooks:backgroundurls:loggedinuser_data',
                $url,
                $domain,
                $path
            );
        }
        $backgroundurls[$url] = array(POP_TARGET_MAIN);
        
        return $backgroundurls;
    }
}
    
/**
 * Initialize
 */
new PoP_ApplicationProcessors_UserLogin_Hooks();