<?php
use PoP\ComponentModel\QueryInputOutputHandlers\ActionExecutionQueryInputOutputHandler;

class GD_DataLoad_QueryInputOutputHandler_EditPost extends ActionExecutionQueryInputOutputHandler
{
    public function getQueryParams($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbObjectIDOrIDs): array
    {
        $ret = parent::getQueryParams($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbObjectIDOrIDs);

        $ret[POP_INPUTNAME_POSTID] = $_REQUEST[POP_INPUTNAME_POSTID] ?? null;

        // If the user is sending the '_wpnonce', because has sent a POST editing a post, then use that one, and make the nonce validation with it
        // The nonce must be passed already in the link, otherwise it will not work
        $ret[POP_INPUTNAME_NONCE] = $_REQUEST[POP_INPUTNAME_NONCE] ?? '';

        return $ret;
    }

    // function getSharedbydomainsQuerystate($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbobjectids) {

    //     $ret = parent::getSharedbydomainsQuerystate($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbobjectids);

    //     $pid = $_REQUEST[POP_INPUTNAME_POSTID];
    //     $ret[ParamConstants::PARAMS][POP_INPUTNAME_POSTID] = $pid;

    //     // If the user is sending the '_wpnonce', because has sent a POST editing a post, then use that one, and make the nonce validation with it
    //     // The nonce must be passed already in the link, otherwise it will not work
    //     $ret[ParamConstants::PARAMS][POP_INPUTNAME_NONCE] = $_REQUEST[POP_INPUTNAME_NONCE] ?? '';

    //     return $ret;
    // }
}

/**
 * Initialize
 */
new GD_DataLoad_QueryInputOutputHandler_EditPost();
