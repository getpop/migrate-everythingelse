<?php
use PoP\LooseContracts\Facades\NameResolverFacade;

define('POP_CDN_THUMBPRINT_COMMENT', 'comment');

class PoP_CDN_Thumbprint_Comment extends PoP_CDN_ThumbprintBase
{
    public function getName()
    {
        return POP_CDN_THUMBPRINT_COMMENT;
    }

    public function getQuery()
    {
        return array(
            // 'fields' => 'ids',
            'limit' => 1,
            'status' => POP_COMMENTSTATUS_APPROVED,
            // 'type' => 'comment', // Only comments, no trackbacks or pingbacks
            'order' =>  'DESC',
            'orderby' => NameResolverFacade::getInstance()->getName('popcms:dbcolumn:orderby:comments:date'),
        );
    }

    public function executeQuery($query, array $options = [])
    {
        $cmscommentsapi = \PoP\Comments\FunctionAPIFactory::getInstance();
        $options['return-type'] = POP_RETURNTYPE_IDS;
        return $cmscommentsapi->getComments($query, $options);
    }
    
    public function getTimestamp($comment_id)
    {
        return get_comment_date('U', $comment_id);
    }
}
    
/**
 * Initialize
 */
new PoP_CDN_Thumbprint_Comment();