<?php
use PoP\ComponentModel\ModuleProcessors\DataloadingConstants;
use PoP\Application\QueryInputOutputHandlers\ListQueryInputOutputHandler;
use PoP\LooseContracts\Facades\NameResolverFacade;

class GD_DataLoad_QueryInputOutputHandler_CommentList extends ListQueryInputOutputHandler
{
    public function prepareQueryArgs(&$query_args)
    {
        parent::prepareQueryArgs($query_args);

        if (!isset($query_args[GD_URLPARAM_COMMENTPOSTID])) {
            $vars = \PoP\ComponentModel\Engine_Vars::getVars();

            // By default, select the global $post ID;
            $query_args[GD_URLPARAM_COMMENTPOSTID] = $vars['routing-state']['queried-object-id'];
        }

        // // Limit: by default, show all comments
        // $query_args[GD_URLPARAM_LIMIT] = $query_args[GD_URLPARAM_LIMIT] ?? '';

        // The Order must always be date > ASC so the jQuery works in inserting sub-comments in already-created parent comments
        $query_args['order'] =  'ASC';
        $query_args['orderby'] = NameResolverFacade::getInstance()->getName('popcms:dbcolumn:orderby:comments:date');
    }

    // function getUniquetodomainQuerystate($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbobjectids) {
    
    //     $ret = parent::getUniquetodomainQuerystate($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbobjectids);

    //     $query_args = $data_properties[ParamConstants::QUERYARGS];

    //     // Add the post_id, so we know what post to fetch comments from when filtering
    //     $ret[ParamConstants::PARAMS][GD_URLPARAM_COMMENTPOSTID] = $query_args[GD_URLPARAM_COMMENTPOSTID];

    //     return $ret;
    // }

    public function getQueryParams($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbObjectIDOrIDs): array
    {
        $ret = parent::getQueryParams($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbObjectIDOrIDs);

        $query_args = $data_properties[DataloadingConstants::QUERYARGS];

        // Add the post_id, so we know what post to fetch comments from when filtering
        $ret[GD_URLPARAM_COMMENTPOSTID] = $query_args[GD_URLPARAM_COMMENTPOSTID];

        return $ret;
    }

    // function getDatafeedback($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbobjectids) {
    
    //     $ret = parent::getDatafeedback($data_properties, $dataaccess_checkpoint_validation, $actionexecution_checkpoint_validation, $executed, $dbobjectids);

    //     $query_args = $data_properties[ParamConstants::QUERYARGS];

    //     // Add the post_id, so we know what post to fetch comments from when filtering
    //     $ret[ParamConstants::PARAMS][GD_URLPARAM_COMMENTPOSTID] = $query_args[GD_URLPARAM_COMMENTPOSTID];

    //     return $ret;
    // }
}

/**
 * Initialize
 */
new GD_DataLoad_QueryInputOutputHandler_CommentList();