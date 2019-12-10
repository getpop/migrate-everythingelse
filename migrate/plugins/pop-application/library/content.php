<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;

// function gdGetDocumentTitle()
// {
//     $vars = \PoP\ComponentModel\Engine_Vars::getVars();
//     $cmsengineapi = \PoP\Engine\FunctionAPIFactory::getInstance();
//     $cmsapplicationapi = \PoP\Application\FunctionAPIFactory::getInstance();
//     $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
//     $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
//     $cmsapplicationhelpers = \PoP\Application\HelperAPIFactory::getInstance();
//     $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
    
//     $site_name = $cmsapplicationapi->getSiteName();
//     $separator = '|';
    
//     if ($vars['routing-state']['is-post']) {
//         $post = $vars['routing-state']['queried-object'];
//         $content = $cmspostsapi->getSinglePostTitle($post);
//     } elseif ($vars['routing-state']['is-home']/* || $vars['routing-state']['is-front-page']*/) {
//         $content = $cmsapplicationapi->getSiteDescription();
//     } elseif ($vars['routing-state']['is-page']) {
//         $post = $vars['routing-state']['queried-object'];
//         $content = $cmspostsapi->getSinglePostTitle($post);
//     } /*elseif ($vars['routing-state']['is-search']) {
//         $content = TranslationAPIFacade::getInstance()->__('Search:', 'pop-engine');
//         $content .= ' ' . $cmsapplicationhelpers->escapeHTML(stripslashes($cmsengineapi->getSearchQuery()), true);
//     }*/ elseif ($vars['routing-state']['is-category']) {
//         $cat = $vars['routing-state']['queried-object'];
//         $content = $taxonomyapi->getCategoryTitle($cat);
//     } elseif ($vars['routing-state']['is-tag']) {
//         $tag = $vars['routing-state']['queried-object'];
//         $content = $taxonomyapi->getTagTitle($tag);
//     } elseif ($vars['routing-state']['is-404']) {
//         $content = TranslationAPIFacade::getInstance()->__('Ops, nothing found here!', 'pop-engine');
//     } elseif ($vars['routing-state']['is-user']) {
//         $author = $vars['routing-state']['queried-object-id'];
//         $content = $cmsusersapi->getUserDisplayName($author);
//     } else {
//         $content = $cmsapplicationapi->getSiteDescription();
//     }

//     // if ($cmsengineapi->getQueryVar('paged')) {
//     //     $content .= ' ' .$separator. ' ';
//     //     $content .= 'Page';
//     //     $content .= ' ';
//     //     $content .= $cmsengineapi->getQueryVar('paged');
//     // }

//     if ($content) {
//         if ($vars['routing-state']['is-home']/* || $vars['routing-state']['is-front-page']*/) {
//             $elements = array(
//                 'site_name' => $site_name,
//                 'separator' => $separator,
//                 'content' => $content
//             );
//         } else {
//             $elements = array(
//                 'content' => $content
//             );
//         }
//     } else {
//         $elements = array(
//             'site_name' => $site_name
//         );
//     }

//     if (is_array($elements)) {
//         $doctitle = implode(' ', $elements);
//     } else {
//         $doctitle = $elements;
//     }
    
//     return HooksAPIFacade::getInstance()->applyFilters('gdGetDocumentTitle', $doctitle);
// }

function gdGetFavicon()
{
    $cmsengineapi = \PoP\Engine\FunctionAPIFactory::getInstance();
    return HooksAPIFacade::getInstance()->applyFilters('gdGetFavicon', $cmsengineapi->getHomeURL().'/favicon.ico');
}