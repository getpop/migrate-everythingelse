<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;

class PoP_ContentPostLinks_Utils
{
    public static function getLinkExcerpt($post)
    {
        return sprintf(
            '<em>%2$s</em><a href="%1$s">%1$s</a>',
            self::getLinkUrl($post),
            TranslationAPIFacade::getInstance()->__('Source: ', 'pop-coreprocessors')
        );
    }

    public static function getLinkContent($post, $show = false)
    {
        $source = self::getLinkExcerpt($post);
        $url = self::getLinkUrl($post);
        $host = self::getLinkHost($post_id);
        $parse = parse_url($url);
        $nonembeddable_message = '';
        $content = sprintf(
            '<p>%s</p>',
            $source
        );

        $collapse = $iframe = '';
        $messages = array();

        // Check if the source is embeddable (eg: Facebook is not)
        $nonembeddable = PoP_MediaHostThumbs_Utils::getNonembeddableHosts();
        if (!in_array($host, $nonembeddable) && (!is_ssl() || (is_ssl() && $parse['scheme'] == 'https'))) {
            $cmspostsresolver = \PoP\Posts\ObjectPropertyResolverFactory::getInstance();
            // iframe wrapper: setting up width and height in code to fix the iOS Safari problem: https://stackoverflow.com/questions/16937070/iframe-size-with-css-on-ios
            $iframe = sprintf(
                '<div class="iframe-wrapper content-iframe-wrapper" style="width: %2$s; height: %3$spx;"><iframe src="%1$s" width="%2$s" height="%3$s" frameborder="0"></iframe></div>',
                $cmspostsresolver->getPostContent($post),
                '100%',
                '400'
            );
            
            // If not $show, add a button to Load the frame (eg: feed). If not, show the frame directly (eg: single link)
            if (!$show) {
                $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
                $post_id = $cmspostsresolver->getPostId($post);
                $collapse_id = $cmspostsapi->getPostType($post_id).$post_id.'-'.POP_CONSTANT_CURRENTTIMESTAMP;
                $messages[] = sprintf(
                    '<a href="%s" class="btn btn-primary" data-toggle="collapse"><i class="fa fa-fw fa-link"></i>%s</a>',
                    '#'.$collapse_id,
                    TranslationAPIFacade::getInstance()->__('Load link', 'pop-coreprocessors')
                );

                $script = sprintf(
                    '<script type="text/javascript">jQuery("%1$s").one("show.bs.collapse", function() { jQuery(this).html("%2$s"); });</script>',
                    '#'.$collapse_id,
                    str_replace('"', '\"', $iframe)
                );
                $collapse = sprintf(
                    '<div id="%s" class="linkcollapse-iframe collapse"></div>',
                    $collapse_id
                );
                $collapse .= $script;
            }
        }

        $messages[] = sprintf(
            '<a href="%s" class="btn btn-default" target="_blank"><i class="fa fa-fw fa-external-link"></i>%s</a>',
            $url,
            TranslationAPIFacade::getInstance()->__('Open link in new tab', 'pop-coreprocessors')
        );

        $content .= sprintf(
            '<p class="btn-group">%s</p>',
            implode('', $messages)
        );
        if ($show) {
            // Add directly the frame
            $content .= $iframe;
        } else {
            // Add the collapse with the frame
            $content .= $collapse;
        }

        return $content;
    }

    public static function getLinkCategories()
    {
        return HooksAPIFacade::getInstance()->applyFilters(
            'gd_thumb_defaultlink:link_categories',
            array_filter(
                array(
                    POP_CONTENTPOSTLINKS_CAT_CONTENTPOSTLINKS,
                )
            )
        );
    }

    public static function isLink($post_id)
    {
        $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
        $link_cats = self::getLinkCategories();
        // $post_cats = gdGetCategories($post_id);
        // return !empty(array_intersect($link_cats, $post_cats));
        return !empty(array_intersect($link_cats, $taxonomyapi->getPostCategories($post_id, ['return-type' => POP_RETURNTYPE_IDS])));
    }

    public static function getLinkUrl($post)
    {
        // for the Link, its content IS the URL
        $cmspostsresolver = \PoP\Posts\ObjectPropertyResolverFactory::getInstance();
        return $cmspostsresolver->getPostContent($post);
    }

    public static function getLinkHost($post_id)
    {
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $post = $cmspostsapi->getPost($post_id);
        $url = self::getLinkUrl($post);
        return getUrlHost($url);
    }
}