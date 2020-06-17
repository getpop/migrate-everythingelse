<?php

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\CustomPosts\Facades\CustomPostTypeAPIFacade;

HooksAPIFacade::getInstance()->addFilter('popcms:post:title', 'maybeGetTitleAsBasicContent', 10, 2);
function maybeGetTitleAsBasicContent($title, $post_id = null)
{
    $post_types = HooksAPIFacade::getInstance()->applyFilters(
        'get_title_as_basic_content:post_types',
        array()
    );
    $customPostTypeAPI = CustomPostTypeAPIFacade::getInstance();
    if (in_array($customPostTypeAPI->getCustomPostType($post_id), $post_types)) {
        return limitString($customPostTypeAPI->getPlainTextContent($post_id), 100);
    }

    return $title;
}
