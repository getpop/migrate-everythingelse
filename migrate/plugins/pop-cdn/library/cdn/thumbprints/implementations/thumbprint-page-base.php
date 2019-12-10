<?php
use PoP\LooseContracts\Facades\NameResolverFacade;

class PoP_CDN_Thumbprint_PageBase extends PoP_CDN_ThumbprintBase
{
    public function getQuery()
    {
        return array(
            'limit' => 1,
            'orderby' => NameResolverFacade::getInstance()->getName('popcms:dbcolumn:orderby:posts:modified'),
            'order' => 'DESC',
            'page-status' => POP_PAGESTATUS_PUBLISHED,
        );
    }

    public function executeQuery($query, array $options = [])
    {
        $cmspagesapi = \PoP\Pages\FunctionAPIFactory::getInstance();
        $options['return-type'] = POP_RETURNTYPE_IDS;
        return $cmspagesapi->getPages($query, $options);
    }
    
    public function getTimestamp($page_id)
    {
        // Doing it the manual way
        $cmspagesapi = \PoP\Pages\FunctionAPIFactory::getInstance();
        $cmspagesresolver = \PoP\Pages\ObjectPropertyResolverFactory::getInstance();
        $page = $cmspagesapi->getPage($page_id);
        return mysql2date('U', $cmspagesresolver->getPageModified($page));
    }
}