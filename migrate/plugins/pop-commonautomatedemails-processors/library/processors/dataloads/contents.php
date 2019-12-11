<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Engine\ModuleProcessors\DBObjectIDFromURLParamModuleProcessorTrait;
use PoP\Posts\TypeResolvers\PostConvertibleTypeResolver;

class PoPTheme_Wassup_AE_Module_Processor_ContentDataloads extends PoP_Module_Processor_DataloadsBase
{
    use DBObjectIDFromURLParamModuleProcessorTrait;

    public const MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST = 'dataload-automatedemails-singlepost';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST],
        );
    }

    public function getRelevantRoute(array $module, array &$props): ?string
    {
        $routes = array(
            self::MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST => POP_COMMONAUTOMATEDEMAILS_ROUTE_SINGLEPOST_SPECIAL,
        );
        return $routes[$module[1]] ?? parent::getRelevantRoute($module, $props);
    }

    protected function getInnerSubmodules(array $module): array
    {
        $ret = parent::getInnerSubmodules($module);

        switch ($module[1]) {
            case self::MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST:
                // Add the Sidebar on the top
                $pid = $_REQUEST[POP_INPUTNAME_POSTID];
                if ($layout = HooksAPIFacade::getInstance()->applyFilters(
                    'PoPTheme_Wassup_AE_Module_Processor_ContentDataloads:singlepost:sidebar',
                    [PoPTheme_Wassup_AE_Module_Processor_CustomPostLayoutSidebars::class, PoPTheme_Wassup_AE_Module_Processor_CustomPostLayoutSidebars::MODULE_LAYOUT_AUTOMATEDEMAILS_POSTSIDEBARCOMPACT_HORIZONTAL_POST],
                    $pid
                )
                ) {
                    $ret[] = $layout;
                }

                $ret[] = [PoP_Module_Processor_Contents::class, PoP_Module_Processor_Contents::MODULE_CONTENT_SINGLE];
                break;
        }

        return $ret;
    }

    public function getDBObjectIDOrIDs(array $module, array &$props, &$data_properties)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST:
                return $this->getDBObjectIDFromURLParam($module, $props, $data_properties);
        }
        return parent::getDBObjectIDOrIDs($module, $props, $data_properties);
    }

    protected function getDBObjectIDParamName(array $module, array &$props, &$data_properties)
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST:
                return POP_INPUTNAME_POSTID;
        }
        return null;
    }

    public function getTypeResolverClass(array $module): ?string
    {
        switch ($module[1]) {
            case self::MODULE_DATALOAD_AUTOMATEDEMAILS_SINGLEPOST:
                // Decide on the typeResolver based on the post_type of the single element
                return PostConvertibleTypeResolver::class;
        }

        return parent::getTypeResolverClass($module);
    }
}



