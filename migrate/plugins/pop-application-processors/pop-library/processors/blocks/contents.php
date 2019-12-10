<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Posts\Routing\RouteNatures as PostRouteNatures;
use PoP\Users\Routing\RouteNatures as UserRouteNatures;
use PoP\Taxonomies\Routing\RouteNatures as TaxonomyRouteNatures;

class PoP_Module_Processor_CustomContentBlocks extends PoP_Module_Processor_BlocksBase
{
    public const MODULE_BLOCK_AUTHOR_CONTENT = 'block-author-content';
    public const MODULE_BLOCK_AUTHOR_SUMMARYCONTENT = 'block-author-summarycontent';
    public const MODULE_BLOCK_TAG_CONTENT = 'block-tag-content';
    public const MODULE_BLOCK_SINGLE_CONTENT = 'block-single-content';
    public const MODULE_BLOCK_PAGE_CONTENT = 'block-pageabout-content';

    public function getModulesToProcess(): array
    {
        return array(
            [self::class, self::MODULE_BLOCK_AUTHOR_CONTENT],
            [self::class, self::MODULE_BLOCK_AUTHOR_SUMMARYCONTENT],
            [self::class, self::MODULE_BLOCK_TAG_CONTENT],
            [self::class, self::MODULE_BLOCK_SINGLE_CONTENT],
            [self::class, self::MODULE_BLOCK_PAGE_CONTENT],
        );
    }

    public function getRelevantRoute(array $module, array &$props): ?string
    {
        // $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $routes = array(
            // The Page Content block uses whichever is the current page
            self::MODULE_BLOCK_PAGE_CONTENT => POP_ROUTE_DESCRIPTION,//$vars['route'],
            self::MODULE_BLOCK_AUTHOR_CONTENT => POP_ROUTE_DESCRIPTION,
            self::MODULE_BLOCK_TAG_CONTENT => POP_ROUTE_DESCRIPTION,
        );
        return $routes[$module[1]] ?? parent::getRelevantRoute($module, $props);
    }

    protected function getDescriptionBottom(array $module, array &$props)
    {
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        switch ($module[1]) {
            case self::MODULE_BLOCK_AUTHOR_SUMMARYCONTENT:
                $vars = \PoP\ComponentModel\Engine_Vars::getVars();
                $author = $vars['routing-state']['queried-object-id'];
                $url = $cmsusersapi->getUserURL($author);
                return sprintf(
                    '<p class="text-center"><a href="%s">%s</a></p>',
                    $url,
                    TranslationAPIFacade::getInstance()->__('Go to Full Profile ', 'poptheme-wassup').'<i class="fa fa-fw fa-arrow-right"></i>'
                );
        }

        return parent::getDescriptionBottom($module, $props);
    }
    
    public function getTitle(array $module, array &$props)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        switch ($module[1]) {
            case self::MODULE_BLOCK_AUTHOR_CONTENT:
            case self::MODULE_BLOCK_AUTHOR_SUMMARYCONTENT:
                $author = $vars['routing-state']['queried-object-id'];
                return $cmsusersapi->getUserDisplayName($author);

            case self::MODULE_BLOCK_SINGLE_CONTENT:
            case self::MODULE_BLOCK_PAGE_CONTENT:
                $post_id = $vars['routing-state']['queried-object-id'];
                return $cmspostsapi->getTitle($post_id);
        }
        
        return parent::getTitle($module, $props);
    }

    protected function getControlgroupTopSubmodule(array $module)
    {
        switch ($module[1]) {
            case self::MODULE_BLOCK_PAGE_CONTENT:
                return [PoP_Module_Processor_CustomControlGroups::class, PoP_Module_Processor_CustomControlGroups::MODULE_CONTROLGROUP_SHARE];
        }

        return parent::getControlgroupTopSubmodule($module);
    }
    
    protected function getInnerSubmodules(array $module): array
    {
        $ret = parent::getInnerSubmodules($module);

        $inners = array(
            self::MODULE_BLOCK_AUTHOR_CONTENT => [PoP_Module_Processor_CustomContentDataloads::class, PoP_Module_Processor_CustomContentDataloads::MODULE_DATALOAD_AUTHOR_CONTENT],
            self::MODULE_BLOCK_AUTHOR_SUMMARYCONTENT => [PoP_Module_Processor_CustomContentDataloads::class, PoP_Module_Processor_CustomContentDataloads::MODULE_DATALOAD_AUTHOR_SUMMARYCONTENT],
            self::MODULE_BLOCK_TAG_CONTENT => [PoP_Module_Processor_CustomContentDataloads::class, PoP_Module_Processor_CustomContentDataloads::MODULE_DATALOAD_TAG_CONTENT],
            self::MODULE_BLOCK_SINGLE_CONTENT => [PoP_Module_Processor_CustomContentDataloads::class, PoP_Module_Processor_CustomContentDataloads::MODULE_DATALOAD_SINGLE_CONTENT],
            self::MODULE_BLOCK_PAGE_CONTENT => [PoP_Module_Processor_CustomContentDataloads::class, PoP_Module_Processor_CustomContentDataloads::MODULE_DATALOAD_PAGE_CONTENT],
        );
        if ($inner = $inners[$module[1]]) {
            $ret[] = $inner;
        }

        return $ret;
    }

    public function initModelProps(array $module, array &$props)
    {
        switch ($module[1]) {
            case self::MODULE_BLOCK_TAG_CONTENT:
                $this->appendProp($module, $props, 'class', 'block-tag-content');
                break;

            case self::MODULE_BLOCK_PAGE_CONTENT:
                $this->appendProp($module, $props, 'class', 'block-singleabout-content');
                $inners = $this->getInnerSubmodules($module);
                foreach ($inners as $inner) {
                    $this->appendProp($inner, $props, 'class', 'col-xs-12');
                }
                break;

            case self::MODULE_BLOCK_SINGLE_CONTENT:
                $this->appendProp($module, $props, 'class', 'block-single-content');
                break;
        }
        
        parent::initModelProps($module, $props);
    }

    public function initRequestProps(array $module, array &$props)
    {
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        switch ($module[1]) {
            case self::MODULE_BLOCK_SINGLE_CONTENT:
                $vars = \PoP\ComponentModel\Engine_Vars::getVars();
                
                // Also append the post_status, so we can hide the bottomsidebar for draft posts
                $post_id = $vars['routing-state']['queried-object-id'];
                $this->appendProp($module, $props, 'runtime-class', $cmspostsapi->getPostType($post_id).'-'.$post_id);
                $this->appendProp($module, $props, 'runtime-class', $cmspostsapi->getPostStatus($post_id));
                break;
        }
        
        parent::initRequestProps($module, $props);
    }

    protected function getBlocksectionsClasses(array $module)
    {
        $ret = parent::getBlocksectionsClasses($module);

        switch ($module[1]) {
            case self::MODULE_BLOCK_PAGE_CONTENT:
                $ret['blocksection-inners'] = 'row row-item';
                break;
        }

        return $ret;
    }

    // function getNature(array $module) {

    //     switch ($module[1]) {

    //         case self::MODULE_BLOCK_AUTHOR_CONTENT:
    //         case self::MODULE_BLOCK_AUTHOR_SUMMARYCONTENT:
                
    //             return UserRouteNatures::USER;

    //         case self::MODULE_BLOCK_TAG_CONTENT:
                
    //             return TaxonomyRouteNatures::TAG;

    //         case self::MODULE_BLOCK_SINGLE_CONTENT:

    //             return PostRouteNatures::POST;
    //     }
        
    //     return parent::getNature($module);
    // }
}


