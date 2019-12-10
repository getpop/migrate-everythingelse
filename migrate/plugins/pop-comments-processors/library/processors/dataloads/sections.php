<?php
use PoP\Engine\ModuleProcessors\DBObjectIDsFromURLParamModuleProcessorTrait;
use PoP\Comments\TypeDataResolvers\CommentTypeDataResolver;

class PoP_Comments_Module_Processor_CommentsDataloads extends PoP_Module_Processor_DataloadsBase
{
    use DBObjectIDsFromURLParamModuleProcessorTrait;
    
    public const MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA = 'dataload-dataquery-comments-updatedata';
    public const MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS = 'dataload-dataquery-comments-requestlayouts';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA],
            [self::class, self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS],
        );
    }

    public function getRelevantRoute(array $module, array &$props): ?string
    {
        $routes = array(
            self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS => POP_COMMENTS_ROUTE_LOADERS_COMMENTS_LAYOUTS,
            self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA => POP_COMMENTS_ROUTE_LOADERS_COMMENTS_FIELDS,
        );
        return $routes[$module[1]] ?? parent::getRelevantRoute($module, $props);
    }

    protected function getInnerSubmodules(array $module): array
    {
        if ($inner_module = $this->getInnerSubmodule($module)) {
            $ret[] = $inner_module;
        }

        return $ret;
    }

    public function getInnerSubmodule(array $module)
    {
        $inner_modules = array(
            self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA => [PoP_Comments_Module_Processor_CommentsContents::class, PoP_Comments_Module_Processor_CommentsContents::MODULE_CONTENT_DATAQUERY_COMMENTS_UPDATEDATA],
            self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS => [PoP_Comments_Module_Processor_CommentsContents::class, PoP_Comments_Module_Processor_CommentsContents::MODULE_CONTENT_DATAQUERY_COMMENTS_REQUESTLAYOUTS],
        );

        return $inner_modules[$module[1]];
    }

    public function getFormat(array $module): ?string
    {
        $updatedatas = array(
            [self::class, self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA],
        );
        $requestlayouts = array(
            [self::class, self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS],
        );

        if (in_array($module, $updatedatas)) {
            $format = POP_FORMAT_FIELDS;
        } elseif (in_array($module, $requestlayouts)) {
            $format = POP_FORMAT_LAYOUTS;
        }

        return $format ?? parent::getFormat($module);
    }

    public function getDBObjectIDOrIDs(array $module, array &$props, &$data_properties)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA:
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS:
                return $this->getDBObjectIDsFromURLParam($module, $props, $data_properties);
        }
        return parent::getDBObjectIDOrIDs($module, $props, $data_properties);
    }

    protected function getDBObjectIDsParamName(array $module, array &$props, &$data_properties)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA:
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS:
                return POP_INPUTNAME_COMMENTID;
        }
        return null;
    }

    public function getTypeDataResolverClass(array $module): ?string
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA:
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS:
                return CommentTypeDataResolver::class;
        }

        return parent::getTypeDataResolverClass($module);
    }

    public function initModelProps(array $module, array &$props)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_UPDATEDATA:
            case self::MODULE_DATALOAD_DATAQUERY_COMMENTS_REQUESTLAYOUTS:
                // These blocks must be hidden, so that the feedbackmessage from blocks in the operational are pulled all the way up.
                // If these are hidden, these feedbackmessages are pulled down and out of screen
                $this->appendProp($module, $props, 'class', 'hidden');
                break;
        }
        
        parent::initModelProps($module, $props);
    }
}


