<?php
use PoP\Hooks\Facades\HooksAPIFacade;

/**
 * Return the author of the post (to be overriden by Co-Authors plus)
 */
function gdGetPostauthors($post_id)
{
    $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
    $cmspostsresolver = \PoP\Posts\ObjectPropertyResolverFactory::getInstance();
    $post = $cmspostsapi->getPost($post_id);
    return HooksAPIFacade::getInstance()->applyFilters(
    	'gdGetPostauthors', 
    	array($cmspostsresolver->getPostAuthor($post)), 
    	$post_id
    );
}

function getAuthorProfileUrl($author)
{
    $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
    $url = $cmsusersapi->getUserURL($author);
    return \PoP\ComponentModel\Utils::addRoute($url, POP_ROUTE_DESCRIPTION);
}

/**
 * Change Author permalink from 'author' to 'u'
 */
HooksAPIFacade::getInstance()->addFilter('author-base', function($authorBase) {
	return 'u';
});