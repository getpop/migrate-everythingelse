<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;

define('POP_EMAIL_ADDEDCOMMENT', 'added-comment');
define('POP_EMAIL_SUBSCRIBEDTOTOPIC', 'subscribedtotopic');

class PoP_SocialNetwork_EmailSender_ContentCreation_Hooks
{
    public function __construct()
    {

        // Important: do not change the order of the hooks added below, because users receive only 1 email for each type (eg: added a post),
        // so if they suit 2 different hooks (eg: general preferences and user network preferences) then send it under the most specific one (eg: user network preferences)
        
        //----------------------------------------------------------------------
        // Functional emails
        //----------------------------------------------------------------------
        // User tagged
        HooksAPIFacade::getInstance()->addAction('PoP_Mentions:post_tags:tagged_users', array($this, 'sendemailToUsersTaggedInPost'), 10, 3);
        HooksAPIFacade::getInstance()->addAction('PoP_Mentions:comment_tags:tagged_users', array($this, 'sendemailToUsersTaggedInComment'), 10, 2);
        
        //----------------------------------------------------------------------
        // Email Notifications
        //----------------------------------------------------------------------
        // EMAILNOTIFICATIONS_SUBSCRIBEDTOPIC_CREATEDCONTENT:
        HooksAPIFacade::getInstance()->addAction('gd_createupdate_post:create', array($this, 'emailnotificationsSubscribedtopicCreatedpostCreate'), 10, 1);
        HooksAPIFacade::getInstance()->addAction('gd_createupdate_post:update', array($this, 'emailnotificationsSubscribedtopicCreatedpostUpdate'), 10, 2);
        // EMAILNOTIFICATIONS_NETWORK_CREATEDCONTENT:
        HooksAPIFacade::getInstance()->addAction('gd_createupdate_post:create', array($this, 'emailnotificationsNetworkCreatedpostCreate'), 10, 1);
        HooksAPIFacade::getInstance()->addAction('gd_createupdate_post:update', array($this, 'emailnotificationsNetworkCreatedpostUpdate'), 10, 2);
        // EMAILNOTIFICATIONS_SUBSCRIBEDTOPIC_ADDEDCOMMENT:
        HooksAPIFacade::getInstance()->addAction(
            'popcms:insertComment', 
            array($this, 'emailnotificationsSubscribedtopicAddedcomment'), 
            10, 
            2
        );
        // EMAILNOTIFICATIONS_NETWORK_ADDEDCOMMENT:
        HooksAPIFacade::getInstance()->addAction(
            'popcms:insertComment', 
            array($this, 'emailnotificationsNetworkAddedcomment'), 
            10, 
            2
        );
        // EMAILNOTIFICATIONS_NETWORK_SUBSCRIBEDTOTOPIC:
        HooksAPIFacade::getInstance()->addAction('gd_subscribetotag', array($this, 'emailnotificationsNetworkSubscribedtotopic'), 10, 1);
    }

    /**
     * Email Notifications
     */
    
    /**
     * User's network notification emails: post created
     */
    public function emailnotificationsNetworkCreatedpostCreate($post_id)
    {

        // Send email if the created post has been published
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        if ($cmspostsapi->getPostStatus($post_id) == POP_POSTSTATUS_PUBLISHED) {
            $this->sendemailToUsersnetworkFromPost($post_id);
        }
    }
    public function emailnotificationsNetworkCreatedpostUpdate($post_id, $log)
    {

        // Send an email to all post owners's network when a post is published
        $old_status = $log['previous-status'];

        // Send email if the updated post has been published
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        if ($cmspostsapi->getPostStatus($post_id) == POP_POSTSTATUS_PUBLISHED && $old_status != POP_POSTSTATUS_PUBLISHED) {
            $this->sendemailToUsersnetworkFromPost($post_id);
        }
    }
    protected function sendemailToUsersnetworkFromPost($post_id)
    {

        // Check if for a given type of post the email must not be sent (eg: Highlights)
        if (PoP_EmailSender_Utils::sendemailSkip($post_id)) {
            return;
        }

        // Do not send for RIPESS
        if (!HooksAPIFacade::getInstance()->applyFilters('PoP_EmailSender_Hooks:sendemailToUsersnetworkFromPost:enabled', true)) {
            return;
        }

        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();

        // No need to check if the post_status is "published", since it's been checked in the previous 2 functions (create/update)
        $post_html = PoP_EmailTemplatesFactory::getInstance()->getPosthtml($post_id);
        $post_name = gdGetPostname($post_id);
        $post_title = $cmspostsapi->getTitle($post_id);
        $footer = PoP_UserPlatform_EmailSenderUtils::getPreferencesFooter(TranslationAPIFacade::getInstance()->__('You are receiving this notification for belonging to the user’s network.', 'pop-emailsender'));

        // $allnetworkusers = array();
        $authors = gdGetPostauthors($post_id);
        foreach ($authors as $author) {
            // Get all the author's network's users (followers + members of same communities)
            $networkusers = PoP_SocialNetwork_EmailUtils::getUserNetworkusers($author);

            // Do not send email to the authors of the post, they know already!
            $networkusers = array_diff($networkusers, $authors);

            // From those, remove all users who got an email in a previous email function
            if ($networkusers = array_diff($networkusers, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_CREATEDCONTENT))) {
                // Keep only the users with the corresponding preference on
                if ($networkusers = PoP_UserPlatform_UserPreferencesUtils::getPreferenceonUsers(POP_USERPREFERENCES_EMAILNOTIFICATIONS_NETWORK_CREATEDCONTENT, $networkusers)) {
                    $emails = $names = array();
                    foreach ($networkusers as $networkuser) {
                        $emails[] = $cmsusersapi->getUserEmail($networkuser);
                        $names[] = $cmsusersapi->getUserDisplayName($networkuser);
                    }

                    $author_name = $cmsusersapi->getUserDisplayName($author);
                    $author_url = $cmsusersapi->getUserURL($author);
                    $subject = sprintf(
                        TranslationAPIFacade::getInstance()->__('%s has created a new %s: “%s”', 'pop-emailsender'),
                        $author_name,
                        $post_name,
                        $post_title
                    );
                    $content = sprintf(
                        '<p>%s</p>',
                        sprintf(
                            TranslationAPIFacade::getInstance()->__('<b><a href="%s">%s</a></b> has created a new %s:', 'pop-emailsender'),
                            $author_url,
                            $author_name,
                            $post_name
                        )
                    );
                    $content .= $post_html;
                    $content .= $footer;

                    PoP_EmailSender_Utils::sendemailToUsers($emails, $names, $subject, $content, true);

                    PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_CREATEDCONTENT, $networkusers);
                }
            }
        }
    }

    /**
     * Subscribed tags/topics: post created
     */
    // Send an email to all post owners's network when a post is published
    public function emailnotificationsSubscribedtopicCreatedpostUpdate($post_id, $log)
    {
        $old_status = $log['previous-status'];

        // Send email if the updated post has been published
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        if ($cmspostsapi->getPostStatus($post_id) == POP_POSTSTATUS_PUBLISHED && $old_status != POP_POSTSTATUS_PUBLISHED) {
            $this->sendemailToSubscribedtagusersFromPost($post_id);
        }
    }
    public function emailnotificationsSubscribedtopicCreatedpostCreate($post_id)
    {

        // Send email if the created post has been published
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        if ($cmspostsapi->getPostStatus($post_id) == POP_POSTSTATUS_PUBLISHED) {
            $this->sendemailToSubscribedtagusersFromPost($post_id);
        }
    }
    protected function sendemailToSubscribedtagusersFromPost($post_id)
    {

        // Check if for a given type of post the email must not be sent (eg: Highlights)
        if (PoP_EmailSender_Utils::sendemailSkip($post_id)) {
            return;
        }

        // If the post has tags...
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
        $cmstaxonomiesresolver = \PoP\Taxonomies\ObjectPropertyResolverFactory::getInstance();
        if ($post_tags = $taxonomyapi->getPostTags($post_id, ['return-type' => POP_RETURNTYPE_IDS])) {
            $post_html = PoP_EmailTemplatesFactory::getInstance()->getPosthtml($post_id);
            $post_name = gdGetPostname($post_id);
            $post_title = $cmspostsapi->getTitle($post_id);
            $footer = PoP_UserPlatform_EmailSenderUtils::getPreferencesFooter(TranslationAPIFacade::getInstance()->__('You are receiving this notification for having subscribed to tags/topics added in this post.', 'pop-emailsender'));

            $vars = \PoP\ComponentModel\Engine_Vars::getVars();
            foreach ($post_tags as $tag_id) {
                // Get all the users who subscribed to each tag
                if ($tag_subscribers = \PoP\TaxonomyMeta\Utils::getTermMeta($tag_id, GD_METAKEY_TERM_SUBSCRIBEDBY)) {
                    // From those, remove all users who got an email in a previous email function
                    if ($tag_subscribers = array_diff($tag_subscribers, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_CREATEDCONTENT))) {
                        // Keep only the users with the corresponding preference on
                        // Do not send to the current user
                        if ($tag_subscribers = PoP_UserPlatform_UserPreferencesUtils::getPreferenceonUsers(POP_USERPREFERENCES_EMAILNOTIFICATIONS_SUBSCRIBEDTOPIC_CREATEDCONTENT, $tag_subscribers, array($vars['global-userstate']['current-user-id']))) {
                            $emails = $names = array();
                            foreach ($tag_subscribers as $subscribeduser) {
                                $emails[] = $cmsusersapi->getUserEmail($subscribeduser);
                                $names[] = $cmsusersapi->getUserDisplayName($subscribeduser);
                            }

                            $tag = $taxonomyapi->getTag($tag_id);
                            $tag_url = $taxonomyapi->getTagLink($tag_id);
                            $tag_name = $cmstaxonomiesresolver->getTagSymbolName($tag);
                            $subject = sprintf(
                                TranslationAPIFacade::getInstance()->__('There is a new %s tagged with “%s”: “%s”', 'pop-emailsender'),
                                $post_name,
                                $tag_name,
                                $post_title
                            );
                            
                            $content = sprintf(
                                '<p>%s</p>',
                                sprintf(
                                    TranslationAPIFacade::getInstance()->__('There is a new %s, tagged with <a href="%s">%s</a>:', 'pop-emailsender'),
                                    $post_name,
                                    $tag_url,
                                    $tag_name
                                )
                            );
                            $content .= $post_html;
                            $content .= $footer;

                            PoP_EmailSender_Utils::sendemailToUsers($emails, $names, $subject, $content, true);

                            // Add the users to the list of users who got an email sent to
                            PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_CREATEDCONTENT, $tag_subscribers);
                        }
                    }
                }
            }
        }
    }

    public function emailnotificationsNetworkAddedcomment($comment_id, $comment)
    {
        $cmscommentsapi = \PoP\Comments\FunctionAPIFactory::getInstance();
        $cmscommentsresolver = \PoP\Comments\ObjectPropertyResolverFactory::getInstance();
        $comment = $cmscommentsapi->getComment($comment_id);

        // Only for published comments
        if (!$cmscommentsresolver->isCommentApproved($comment)) {
            return;
        }

        // Get all the author's network's users (followers + members of same communities)
        $networkusers = PoP_SocialNetwork_EmailUtils::getUserNetworkusers($cmscommentsresolver->getCommentUserId($comment));
        if ($networkusers = array_diff($networkusers, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_ADDEDCOMMENT))) {
            // Keep only the users with the corresponding preference on
            if ($networkusers = PoP_UserPlatform_UserPreferencesUtils::getPreferenceonUsers(POP_USERPREFERENCES_EMAILNOTIFICATIONS_NETWORK_ADDEDCOMMENT, $networkusers)) {
                $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
                $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
                $emails = $names = array();
                foreach ($networkusers as $networkuser) {
                    $emails[] = $cmsusersapi->getUserEmail($networkuser);
                    $names[] = $cmsusersapi->getUserDisplayName($networkuser);
                }

                $title = $cmspostsapi->getTitle($cmscommentsresolver->getCommentPostId($comment));
                $url = $cmspostsapi->getPermalink($cmscommentsresolver->getCommentPostId($comment));
                $post_name = gdGetPostname($cmscommentsresolver->getCommentPostId($comment), 'lc');
                $author_name = $cmsusersapi->getUserDisplayName($cmscommentsresolver->getCommentUserId($comment));

                $content = sprintf(
                    TranslationAPIFacade::getInstance()->__('<p><a href="%1$s">%2$s</a> added a comment in %3$s <a href="%4%s">%5$s</a>:</p>', 'pop-emailsender'),
                    $cmsusersapi->getUserURL($cmscommentsresolver->getCommentUserId($comment)),
                    $author_name,
                    $post_name,
                    $url,
                    $title
                );

                $content .= PoP_EmailTemplatesFactory::getInstance()->getCommentcontenthtml($comment);

                $footer = PoP_UserPlatform_EmailSenderUtils::getPreferencesFooter(TranslationAPIFacade::getInstance()->__('You are receiving this notification for belonging to the user’s network.', 'pop-emailsender'));
                $content .= $footer;
                
                // Possibly the title has html entities, these must be transformed again for the subjects below
                $title = html_entity_decode($title);

                $subject = sprintf(
                    TranslationAPIFacade::getInstance()->__('%1$s added a comment in %2$s “%3$s”', 'pop-emailsender'),
                    $author_name,
                    $post_name,
                    $title
                );

                PoP_EmailSender_Utils::sendemailToUsers($emails, $names, $subject, $content, true);

                // Add the users to the list of users who got an email sent to
                PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_ADDEDCOMMENT, $networkusers);
            }
        }
    }

    public function emailnotificationsSubscribedtopicAddedcomment($comment_id, $comment)
    {

        // Only for published comments
        $cmscommentsresolver = \PoP\Comments\ObjectPropertyResolverFactory::getInstance();
        if (!$cmscommentsresolver->isCommentApproved($comment)) {
            return;
        }

        $post_id = $cmscommentsresolver->getCommentPostId($comment);

        // If the post has tags...
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
        $cmstaxonomiesresolver = \PoP\Taxonomies\ObjectPropertyResolverFactory::getInstance();
        if ($post_tags = $taxonomyapi->getPostTags($post_id, ['return-type' => POP_RETURNTYPE_IDS])) {
            $post_html = PoP_EmailTemplatesFactory::getInstance()->getPosthtml($post_id);
            $post_name = gdGetPostname($post_id);
            $post_title = $cmspostsapi->getTitle($post_id);
            $footer = PoP_UserPlatform_EmailSenderUtils::getPreferencesFooter(TranslationAPIFacade::getInstance()->__('You are receiving this notification for having subscribed to tags/topics added in this comment/post.', 'pop-emailsender'));

            $vars = \PoP\ComponentModel\Engine_Vars::getVars();
            foreach ($post_tags as $tag_id) {
                // Get all the users who subscribed to each tag
                if ($tag_subscribers = \PoP\TaxonomyMeta\Utils::getTermMeta($tag_id, GD_METAKEY_TERM_SUBSCRIBEDBY)) {
                    // From those, remove all users who got an email in a previous email function
                    if ($tag_subscribers = array_diff($tag_subscribers, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_ADDEDCOMMENT))) {
                        // Keep only the users with the corresponding preference on
                        // Do not send to the current user
                        if ($tag_subscribers = PoP_UserPlatform_UserPreferencesUtils::getPreferenceonUsers(POP_USERPREFERENCES_EMAILNOTIFICATIONS_SUBSCRIBEDTOPIC_ADDEDCOMMENT, $tag_subscribers, array($vars['global-userstate']['current-user-id']))) {
                            $emails = $names = array();
                            foreach ($tag_subscribers as $tag_subscriber) {
                                $emails[] = $cmsusersapi->getUserEmail($tag_subscriber);
                                $names[] = $cmsusersapi->getUserDisplayName($tag_subscriber);
                            }

                            $tag = $taxonomyapi->getTag($tag_id);
                            $tag_url = $taxonomyapi->getTagLink($tag_id);
                            $tag_name = $cmstaxonomiesresolver->getTagSymbolName($tag);
                            $subject = sprintf(
                                TranslationAPIFacade::getInstance()->__('New comment added under %s with topic “%s”', 'pop-emailsender'),
                                $post_name,
                                $tag_name
                            );
                            
                            $content = sprintf(
                                '<p>%s</p>',
                                sprintf(
                                    TranslationAPIFacade::getInstance()->__('A new comment has been added in %s <a href="%s">%s</a>, which has topic <a href="%s">%s</a>:', 'pop-emailsender'),
                                    $post_name,
                                    $cmspostsapi->getPermalink($post_id),
                                    $post_title,
                                    $tag_url,
                                    $tag_name
                                )
                            );
                            $content .= $post_html;
                            $content .= $footer;

                            PoP_EmailSender_Utils::sendemailToUsers($emails, $names, $subject, $content, true);

                            // Add the users to the list of users who got an email sent to
                            PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_ADDEDCOMMENT, $tag_subscribers);
                        }
                    }
                }
            }
        }
    }
    public function emailnotificationsNetworkSubscribedtotopic($tag_id)
    {
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        $user_id = $vars['global-userstate']['current-user-id'];
        $cmstaxonomiesresolver = \PoP\Taxonomies\ObjectPropertyResolverFactory::getInstance();

        // Get the current user's network's users (followers + members of same communities)
        $networkusers = PoP_SocialNetwork_EmailUtils::getUserNetworkusers($user_id);
        if ($networkusers = array_diff($networkusers, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_SUBSCRIBEDTOTOPIC))) {
            // Keep only the users with the corresponding preference on
            if ($networkusers = PoP_UserPlatform_UserPreferencesUtils::getPreferenceonUsers(POP_USERPREFERENCES_EMAILNOTIFICATIONS_NETWORK_SUBSCRIBEDTOTOPIC, $networkusers)) {
                $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
                $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
                $emails = $names = array();
                foreach ($networkusers as $networkuser) {
                    $emails[] = $cmsusersapi->getUserEmail($networkuser);
                    $names[] = $cmsusersapi->getUserDisplayName($networkuser);
                }

                $user_url = $cmsusersapi->getUserURL($user_id);
                $user_name = $cmsusersapi->getUserDisplayName($user_id);
                $tag = $taxonomyapi->getTag($tag_id);
                $tag_name = $cmstaxonomiesresolver->getTagSymbolName($tag);
                $subject = sprintf(
                    TranslationAPIFacade::getInstance()->__('%s subscribed to %s', 'pop-emailsender'),
                    $user_name,
                    $tag_name
                );
                
                $content = sprintf(
                    TranslationAPIFacade::getInstance()->__('<p><a href="%s">%s</a> subscribed to:</p>', 'pop-emailsender'),
                    $user_url,
                    $user_name
                );
                $tag_html = PoP_EmailTemplatesFactory::getInstance()->getTaghtml($tag_id);
                $content .= $tag_html;

                $footer = PoP_UserPlatform_EmailSenderUtils::getPreferencesFooter(TranslationAPIFacade::getInstance()->__('You are receiving this notification for belonging to the user’s network.', 'pop-emailsender'));
                $content .= $footer;
                
                PoP_EmailSender_Utils::sendemailToUsers($emails, $names, $subject, $content);

                // Add the users to the list of users who got an email sent to
                PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_SUBSCRIBEDTOTOPIC, $networkusers);
            }
        }
    }
    

    /**
     * Send Email when tagging a user in a post or comment
     */
    public function sendemailToTaggedusers($taggedusers_ids, $subject, $content)
    {
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $emails = array();
        $names = array();
        foreach ($taggedusers_ids as $taggeduser_id) {
            $emails[] = $cmsusersapi->getUserEmail($taggeduser_id);
            $names[] = $cmsusersapi->getUserDisplayName($taggeduser_id);
        }

        PoP_EmailSender_Utils::sendemailToUsers($emails, $names, $subject, $content, true);
    }

    public function sendemailToUsersTaggedInPost($post_id, $taggedusers_ids, $newly_taggedusers_ids)
    {
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $post = $cmspostsapi->getPost($post_id);

        // Only for published posts
        if ($cmspostsapi->getPostStatus($post_id) != POP_POSTSTATUS_PUBLISHED) {
            return;
        }

        //
        if ($newly_taggedusers_ids = array_diff($newly_taggedusers_ids, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_CREATEDCONTENT))) {
            
            $cmspostsresolver = \PoP\Posts\ObjectPropertyResolverFactory::getInstance();
            $post_name = gdGetPostname($post_id, 'lc');
            $post_author_id = $cmspostsresolver->getPostAuthor($post);

            $content = sprintf(
                TranslationAPIFacade::getInstance()->__('<p><a href="%s">%s</a> mentioned you in %s:</p>', 'pop-emailsender'),
                $cmsusersapi->getUserURL($post_author_id),
                $cmsusersapi->getUserDisplayName($post_author_id),
                $post_name
            );

            $content .= PoP_EmailTemplatesFactory::getInstance()->getPosthtml($post_id);
            
            // Possibly the title has html entities, these must be transformed again for the subjects below
            $title = $cmspostsapi->getTitle($post_id);
            $title = html_entity_decode($title);

            $subject = sprintf(
                TranslationAPIFacade::getInstance()->__('You were mentioned in %1$s “%2$s”', 'pop-emailsender'),
                $post_name,
                $title
            );

            self::sendemailToTaggedusers($newly_taggedusers_ids, $subject, $content);

            // Add the users to the list of users who got an email sent to
            PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_CREATEDCONTENT, $newly_taggedusers_ids);
        }
    }

    public function sendemailToUsersTaggedInComment($comment_id, $taggedusers_ids)
    {
        $cmscommentsapi = \PoP\Comments\FunctionAPIFactory::getInstance();
        $cmscommentsresolver = \PoP\Comments\ObjectPropertyResolverFactory::getInstance();
        $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();
        $comment = $cmscommentsapi->getComment($comment_id);

        // Only for published comments
        if (!$cmscommentsresolver->isCommentApproved($comment)) {
            return;
        }

        // From those, remove all users who got an email in a previous email function
        if ($taggedusers_ids = array_diff($taggedusers_ids, PoP_EmailSender_SentEmailsManager::getSentemailUsers(POP_EMAIL_ADDEDCOMMENT))) {
            $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
            $title = $cmspostsapi->getTitle($cmscommentsresolver->getCommentPostId($comment));
            $url = $cmspostsapi->getPermalink($cmscommentsresolver->getCommentPostId($comment));
            $post_name = gdGetPostname($cmscommentsresolver->getCommentPostId($comment), 'lc');

            $content = sprintf(
                TranslationAPIFacade::getInstance()->__('<p><a href="%1$s">%2$s</a> mentioned you in a comment from %3$s <a href="%4%s">%5$s</a>:</p>', 'pop-emailsender'),
                $cmsusersapi->getUserURL($cmscommentsresolver->getCommentUserId($comment)),
                $cmsusersapi->getUserDisplayName($cmscommentsresolver->getCommentUserId($comment)),
                $post_name,
                $url,
                $title
            );

            $content .= PoP_EmailTemplatesFactory::getInstance()->getCommentcontenthtml($comment);
            
            // Possibly the title has html entities, these must be transformed again for the subjects below
            $title = html_entity_decode($title);

            $subject = sprintf(
                TranslationAPIFacade::getInstance()->__('You were mentioned in a comment from %1$s “%2$s”', 'pop-emailsender'),
                $post_name,
                $title
            );

            self::sendemailToTaggedusers($taggedusers_ids, $subject, $content);

            // Add the users to the list of users who got an email sent to
            PoP_EmailSender_SentEmailsManager::addSentemailUsers(POP_EMAIL_ADDEDCOMMENT, $taggedusers_ids);
        }
    }
}

/**
 * Initialization
 */
new PoP_SocialNetwork_EmailSender_ContentCreation_Hooks();