<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Posts\Facades\PostTypeAPIFacade;

// HooksAPIFacade::getInstance()->addFilter('gdPostParentpageid', 'locationpostsPostParentpageid', 10, 2);
// function locationpostsPostParentpageid($pageid, $post_id)
// {
//     if (defined('POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS') && POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS) {
//         $cmspostsapi = PostTypeAPIFacade::getInstance();
//         if ($cmspostsapi->getPostType($post_id) == POP_LOCATIONPOSTS_POSTTYPE_LOCATIONPOST) {
//             return POP_LOCATIONPOSTS_ROUTE_LOCATIONPOSTS;
//         }
//     }

//     return $pageid;
// }
