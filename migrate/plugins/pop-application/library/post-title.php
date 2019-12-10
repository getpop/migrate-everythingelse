<?php
use PoP\Hooks\Facades\HooksAPIFacade;

HooksAPIFacade::getInstance()->addFilter('popcms:post:title', 'maybeGetTitleAsBasicContent', 10, 2);
function maybeGetTitleAsBasicContent($title, $post_id = null)
{
    $post_types = HooksAPIFacade::getInstance()->applyFilters(
        'get_title_as_basic_content:post_types',
        array()
    );
    $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
    if (in_array($cmspostsapi->getPostType($post_id), $post_types)) {
        return limitString($cmspostsapi->getBasicPostContent($post_id), 100);
    }

    return $title;
}