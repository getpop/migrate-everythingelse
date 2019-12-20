<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Events\FacadesEventTypeAPIFacade;

//-------------------------------------------------------------------------------------
// Load Plugin-specific Libraries
//-------------------------------------------------------------------------------------

// Add the Events and Locations for the resourceLoader single path configuration
HooksAPIFacade::getInstance()->addFilter('PoP_ResourceLoader_FileReproduction_Config:configuration:category-paths', 'emPopResourceloaderSinglePaths');
function emPopResourceloaderSinglePaths($paths)
{
    $eventTypeAPI = EventTypeAPIFacade::getInstance();
    $paths[] = $eventTypeAPI->getEventPostTypeSlug().'/';
    return $paths;
}
