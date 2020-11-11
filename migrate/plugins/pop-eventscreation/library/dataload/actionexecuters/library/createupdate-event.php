<?php
use PoPSchema\Events\Facades\EventTypeAPIFacade;
use PoP\Translation\Facades\TranslationAPIFacade;
use PoPSchema\EventMutations\Facades\EventMutationTypeAPIFacade;
use PoPSitesWassup\CustomPostMutations\MutationResolvers\AbstractCreateUpdateCustomPostMutationResolver;

abstract class GD_CreateUpdate_Event extends AbstractCreateUpdateCustomPostMutationResolver
{
    public function getCustomPostType(): string
    {
        $eventTypeAPI = EventTypeAPIFacade::getInstance();
        return $eventTypeAPI->getEventCustomPostType();
    }
    protected function volunteer()
    {
        return true;
    }

    // Update Post Validation
    protected function validatecontent(&$errors, $form_data)
    {
        parent::validatecontent($errors, $form_data);

        // Validate for any status (even "draft"), since without date EM doesn't create the Event
        if (empty(array_filter(array_values($form_data['when'])))) {
            $errors[] = TranslationAPIFacade::getInstance()->__('The dates/time cannot be empty', 'poptheme-wassup');
        }
    }

    protected function getCreatepostData($form_data)
    {
        $post_data = parent::getCreatepostData($form_data);
        $post_data = $this->getCreateupdatepostData($post_data, $form_data);

        return $post_data;
    }

    protected function getUpdatepostData($form_data)
    {
        $post_data = parent::getUpdatepostData($form_data);
        $post_data = $this->getCreateupdatepostData($post_data, $form_data);

        return $post_data;
    }

    protected function getCreateupdatepostData($post_data, $form_data)
    {
        $post_data['when'] = $form_data['when'];
        $post_data['location'] = $form_data['location'];

        return $post_data;
    }

    protected function populate(&$EM_Event, $post_data)
    {
        $eventMutationTypeAPI = EventMutationTypeAPIFacade::getInstance();
        $eventMutationTypeAPI->populate($EM_Event, $post_data);

        return $EM_Event;
    }

    protected function save(&$EM_Event, $post_data)
    {
        $EM_Event = $this->populate($EM_Event, $post_data);
        $EM_Event->save();
        return $EM_Event->post_id;
    }

    protected function executeUpdateCustomPost($post_data)
    {
        $EM_Event = new EM_Event($post_data['id'], 'post_id');
        return $this->save($EM_Event, $post_data);
    }

    protected function executeCreateCustomPost($post_data)
    {
        $EM_Event = new EM_Event();
        return $this->save($EM_Event, $post_data);
    }
}

