<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Routing\URLParams;

define('GD_URLPARAM_ACTION_PRINT', 'print');

define('GD_URLPARAM_TARGET_PRINT', 'print');
define('GD_URLPARAM_TARGET_SOCIALMEDIA', 'socialmedia');

HooksAPIFacade::getInstance()->addFilter('gd_jquery_constants', 'gdJqueryConstantsUrlparams');
function gdJqueryConstantsUrlparams($jqueryConstants)
{
    $jqueryConstants['UNIQUEID'] = POP_UNIQUEID;

    $jqueryConstants['URLPARAM_TIMESTAMP'] = GD_URLPARAM_TIMESTAMP;
    $jqueryConstants['URLPARAM_ACTIONS'] = GD_URLPARAM_ACTIONS;
    $jqueryConstants['URLPARAM_ACTION_LATEST'] = GD_URLPARAM_ACTION_LOADLATEST;
    $jqueryConstants['URLPARAM_ACTION_PRINT'] = GD_URLPARAM_ACTION_PRINT;
    // $jqueryConstants['URLPARAM_ACTION_LOADLAZY'] = GD_URLPARAM_ACTION_LOADLAZY;

    // $jqueryConstants['URLPARAM_PARENTPAGEID'] = GD_URLPARAM_PARENTPAGEID;
    $jqueryConstants['URLPARAM_TITLE'] = GD_URLPARAM_TITLE;
    $jqueryConstants['URLPARAM_TITLELINK'] = GD_URLPARAM_TITLELINK;
    $jqueryConstants['URLPARAM_URL'] = GD_URLPARAM_URL;
    $jqueryConstants['URLPARAM_ERROR'] = GD_URLPARAM_ERROR;
    $jqueryConstants['URLPARAM_SILENTDOCUMENT'] = GD_URLPARAM_SILENTDOCUMENT;
    $jqueryConstants['URLPARAM_STORELOCAL'] = GD_URLPARAM_STORELOCAL;
    $jqueryConstants['URLPARAM_NONCES'] = GD_URLPARAM_NONCES;

    $jqueryConstants['URLPARAM_BACKGROUNDLOADURLS'] = GD_URLPARAM_BACKGROUNDLOADURLS;
    $jqueryConstants['URLPARAM_INTERCEPTURLS'] = GD_URLPARAM_INTERCEPTURLS;

    $jqueryConstants['URLPARAM_OUTPUT'] = GD_URLPARAM_OUTPUT;
    $jqueryConstants['URLPARAM_OUTPUT_JSON'] = GD_URLPARAM_OUTPUT_JSON;

    $jqueryConstants['URLPARAM_PAGED'] = GD_URLPARAM_PAGENUMBER;
    $jqueryConstants['URLPARAM_OPERATION_APPEND'] = GD_URLPARAM_OPERATION_APPEND;
    $jqueryConstants['URLPARAM_OPERATION_PREPEND'] = GD_URLPARAM_OPERATION_PREPEND;
    $jqueryConstants['URLPARAM_OPERATION_REPLACE'] = GD_URLPARAM_OPERATION_REPLACE;
    $jqueryConstants['URLPARAM_OPERATION_REPLACEINLINE'] = GD_URLPARAM_OPERATION_REPLACEINLINE;

    $jqueryConstants['URLPARAM_FORMAT'] = GD_URLPARAM_FORMAT;
    $jqueryConstants['URLPARAM_ROUTE'] = URLParams::ROUTE;

    $jqueryConstants['URLPARAM_DATAOUTPUTITEMS'] = GD_URLPARAM_DATAOUTPUTITEMS;
    $jqueryConstants['URLPARAM_DATAOUTPUTITEMS_META'] = GD_URLPARAM_DATAOUTPUTITEMS_META;
    $jqueryConstants['URLPARAM_DATAOUTPUTITEMS_MODULESETTINGS'] = GD_URLPARAM_DATAOUTPUTITEMS_MODULESETTINGS;
    $jqueryConstants['URLPARAM_DATAOUTPUTITEMS_MODULEDATA'] = GD_URLPARAM_DATAOUTPUTITEMS_MODULEDATA;
    $jqueryConstants['URLPARAM_DATAOUTPUTITEMS_DATABASES'] = GD_URLPARAM_DATAOUTPUTITEMS_DATABASES;
    $jqueryConstants['URLPARAM_DATAOUTPUTITEMS_SESSION'] = GD_URLPARAM_DATAOUTPUTITEMS_SESSION;

    $jqueryConstants['URLPARAM_TARGET'] = GD_URLPARAM_TARGET;
    $jqueryConstants['URLPARAM_TARGET_MAIN'] = POP_TARGET_MAIN;
    $jqueryConstants['URLPARAM_TARGET_FULL'] = GD_URLPARAM_TARGET_FULL;
    $jqueryConstants['URLPARAM_TARGET_PRINT'] = GD_URLPARAM_TARGET_PRINT;
    $jqueryConstants['URLPARAM_TARGET_SOCIALMEDIA'] = GD_URLPARAM_TARGET_SOCIALMEDIA;

    $jqueryConstants['URLPARAM_STOPFETCHING'] = GD_URLPARAM_STOPFETCHING;

    $jqueryConstants['DONOTRENDER'] = POP_JS_DONOTRENDER;
    $jqueryConstants['ISMULTIPLEOPEN'] = POP_JS_ISMULTIPLEOPEN;

    return $jqueryConstants;
}
