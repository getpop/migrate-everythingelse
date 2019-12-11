<?php
use PoP\Hooks\Facades\HooksAPIFacade;

class PoP_Application_DataloaderHooks
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addFilter(
            'GD_Dataloader_List:query:pagenumber',
            array($this, 'maybeGetLoadinglatestPagenumber')
        );
        HooksAPIFacade::getInstance()->addFilter(
            'GD_Dataloader_List:query:limit',
            array($this, 'maybeGetLoadinglatestLimit')
        );
        HooksAPIFacade::getInstance()->addFilter(
            'PostTypeDataLoader:query:limit',
            array($this, 'maybeGetLoadinglatestLimitForPost')
        );
        HooksAPIFacade::getInstance()->addFilter(
            'PostTypeDataLoader:query',
            array($this, 'maybeAddLoadinglatestTimestamp'),
            10,
            2
        );
    }

    public function maybeGetLoadinglatestPagenumber($pagenumber)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        if ($vars['loading-latest']) {
            return 1;
        }

        return $pagenumber;
    }

    public function maybeGetLoadinglatestLimit($limit)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        if ($vars['loading-latest']) {
            return 0;
        }

        return $limit;
    }

    public function maybeGetLoadinglatestLimitForPost($limit)
    {
        // No-limit for posts is -1, not 0
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        if ($vars['loading-latest']) {
            return -1;
        }

        return $limit;
    }

    public function maybeAddLoadinglatestTimestamp($query, $query_args)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        if ($vars['loading-latest']) {
            // Return the posts created after the given timestamp
            $timestamp = $query_args[GD_URLPARAM_TIMESTAMP];
            // $query['date-query'] = array(
            //     array(
            //         'after' => date('Y-m-d H:i:s', $timestamp),
            //         'inclusive' => false,
            //     )
            // );
            $query['date-from'] = date('Y-m-d H:i:s', $timestamp);
        }

        return $query;
    }
}

/**
 * Initialize
 */
new PoP_Application_DataloaderHooks();
