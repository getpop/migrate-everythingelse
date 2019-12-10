<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;

class PoP_AddPostLinks_DataLoad_ActionExecuter_Hook
{
    public function __construct()
    {
        HooksAPIFacade::getInstance()->addFilter(
            'GD_CreateUpdate_Post:form-data',
            array($this, 'getFormData'),
            10
        );
        HooksAPIFacade::getInstance()->addAction(
            'GD_CreateUpdate_Post:validatecontent',
            array($this, 'validatecontent'),
            10,
            2
        );
        HooksAPIFacade::getInstance()->addAction(
            'gd_createupdate_post',
            array($this, 'createupdate'),
            10,
            2
        );
    }

    public function validatecontent($errors_in_array, $form_data)
    {
        $errors = &$errors_in_array[0];

        if ($link = $form_data['link']) {
            if (!isValidUrl($link)) {
                $errors[] = TranslationAPIFacade::getInstance()->__('The external link has an invalid format', 'pop-addpostlinks');
            }
        }
    }

    public function createupdate($post_id, $form_data)
    {

        // Save the link in the post meta
        $link = $form_data['link'];
        if ($link) {
            \PoP\PostMeta\Utils::updatePostMeta($post_id, GD_METAKEY_POST_LINK, $link, true);
        } else {
            \PoP\PostMeta\Utils::deletePostMeta($post_id, GD_METAKEY_POST_LINK);
        }
    }

    public function getFormData($form_data)
    {
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
        
        $form_data['link'] = $moduleprocessor_manager->getProcessor([PoP_AddPostLinks_Module_Processor_TextFormInputs::class, PoP_AddPostLinks_Module_Processor_TextFormInputs::MODULE_ADDPOSTLINKS_FORMINPUT_LINK])->getValue([PoP_AddPostLinks_Module_Processor_TextFormInputs::class, PoP_AddPostLinks_Module_Processor_TextFormInputs::MODULE_ADDPOSTLINKS_FORMINPUT_LINK]);

        return $form_data;
    }
}
    
/**
 * Initialize
 */
new PoP_AddPostLinks_DataLoad_ActionExecuter_Hook();