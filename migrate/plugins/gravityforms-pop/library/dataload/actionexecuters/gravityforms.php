<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;
use PoP\ComponentModel\QueryInputOutputHandlers\ResponseConstants;

class GD_DataLoad_ActionExecuter_GravityForms extends GD_DataLoad_FormActionExecuterBase
{
    public function __construct()
    {
        // Execute before HooksAPIFacade::getInstance()->addAction('wp',  array('RGForms', 'maybe_process_form'), 9);
        if (doingPost()) {
            HooksAPIFacade::getInstance()->addAction(
                'popcms:boot', 
                array($this, 'setup'), 
                5
            );

            // The 2 functions below must be executed in this order, otherwise 'renameFields' may remove the value filled by 'maybeFillFields'
            HooksAPIFacade::getInstance()->addAction(
                'popcms:boot', 
                array($this, 'renameFields'), 
                6
            );
            HooksAPIFacade::getInstance()->addAction(
                'popcms:boot', 
                array($this, 'maybeFillFields'), 
                7
            );
            HooksAPIFacade::getInstance()->addAction(
                'popcms:boot', 
                array($this, 'maybeValidateCaptcha'), 
                8
            );
        }
    }

    protected function executeForm(&$data_properties)
    {
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();

        $formid_processor = $moduleprocessor_manager->getProcessor([GD_GF_Module_Processor_TextFormInputs::class, GD_GF_Module_Processor_TextFormInputs::MODULE_GF_FORMINPUT_FORMID]);
        $form_id = $formid_processor->getValue([GD_GF_Module_Processor_TextFormInputs::class, GD_GF_Module_Processor_TextFormInputs::MODULE_GF_FORMINPUT_FORMID]);

        // $execution_response = do_shortcode('[gravityform id="'.$form_id.'" title="false" description="false" ajax="false"]');
        $execution_response = RGForms::get_form($form_id, false, false);

        // These are the Strings to use to return the errors: This is how they must be used to return errors / success
        // (Eg: in Gravity Forms confirmations)
        // $errorcode = "{{gd:ec:%s}}";
        // $errorstring = "{{gd:es:%s}}";
        // $softredirect = "{{gd:sr:%s}}";
        // $hardredirect = "{{gd:hr:%s}}";
        // $success = "{{gd:success}}";
    
        // Error codes
        preg_match_all("/\{\{gd\:ec\:(.*?)\}\}/", $execution_response, $errorcodes);

        // Error strings
        preg_match_all("/\{\{gd\:es\:(.*?)\}\}/", $execution_response, $errorstrings);

        // Soft Redirect
        preg_match_all("/\{\{gd\:sr\:(.*?)\}\}/", $execution_response, $softredirect);

        // Hard Redirect
        preg_match_all("/\{\{gd\:hr\:(.*?)\}\}/", $execution_response, $hardredirect);

        // Success
        preg_match_all("/\{\{gd\:success\}\}/", $execution_response, $success);

        $executed = array();
        if (!empty($success[0])) {
            $executed[ResponseConstants::SUCCESS] = true;
        } elseif (!empty($errorstrings[1]) || !empty($errorcodes[1])) {
            $executed[ResponseConstants::ERRORSTRINGS] = $errorstrings[1];
            $executed[ResponseConstants::ERRORCODES] = $errorcodes[1];
        }

        // Redirects are unique values, so just get the first occurrence
        if ($softredirect[1]) {
            $executed[GD_DATALOAD_QUERYHANDLERRESPONSE_SOFTREDIRECT] = $softredirect[1][0];
        } elseif ($hardredirect[1]) {
            $executed[GD_DATALOAD_QUERYHANDLERRESPONSE_HARDREDIRECT] = $hardredirect[1][0];
        }

        return $executed;
    }

    public function setup()
    {

        // Since GF 1.9.44, they setup field $_POST[ 'is_submit_' . $form['id'] ] )
        // (in file plugins/gravityforms/form_display.php function validate)
        // So here re-create that field
        if ($form_id = $_POST["gform_submit"]) {
            $_POST['is_submit_'.$form_id] = true;
        }
    }

    protected function getFormFieldnames($form_id)
    {
        return HooksAPIFacade::getInstance()->applyFilters(
            'GD_DataLoad_ActionExecuter_GravityForms:fieldnames',
            array(),
            $form_id
        );
    }

    public function maybeFillFields()
    {

        // Pre-populate values when the user is logged in
        // These are needed since implementing PoP where the user is always logged in, so we can't print the name/email
        // on the front-end anymore, instead fields PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME and PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_EMAIL are
        // not visible when the user is logged in
        $vars = \PoP\ComponentModel\Engine_Vars::getVars();
        if (PoP_FormUtils::useLoggedinuserData() && $vars['global-userstate']['is-user-logged-in']) {
            if ($form_id = $_POST["gform_submit"]) {
                // Hook the fieldnames from the configuration
                if ($fieldnames = $this->getFormFieldnames($form_id)) {
                    $user_id = $vars['global-userstate']['current-user-id'];
                    $cmsusersapi = \PoP\Users\FunctionAPIFactory::getInstance();

                    $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
                    
                    // Fill the user name
                    $name = $moduleprocessor_manager->getProcessor([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME])->getName([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME]);
                    if (isset($fieldnames[$name])) {
                        $_POST[$fieldnames[$name]] = $cmsusersapi->getUserDisplayName($user_id);
                    }

                    // Fill the user email
                    $email = $moduleprocessor_manager->getProcessor([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_EMAIL])->getName([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_EMAIL]);
                    if (isset($fieldnames[$email])) {
                        $_POST[$fieldnames[$email]] = $cmsusersapi->getUserEmail($user_id);
                    }
                }
            }
        }
    }

    public function renameFields()
    {

        // We need to populate the $_POST using the input names needed by Gravity Forms
        if ($form_id = $_POST["gform_submit"]) {
            // Hook the fieldnames from the configuration
            if ($fieldnames = $this->getFormFieldnames($form_id)) {
                foreach ($fieldnames as $module_name => $gf_form_fieldname) {
                    // For each regular PoP module value, set it also under the expected form input name by Gravity Forms
                    $_POST[$gf_form_fieldname] = $_POST[$module_name];
                }
            }
        }
    }

    public function maybeValidateCaptcha()
    {

        // This is a workaround to validate the form which takes place in advance based on if the captcha is present or not
        // this is done now because GF sends the email at the beginning, this can't be postponed
        // Check only if the user is not logged in. When logged in, we never use the captcha
        if (PoP_Forms_ConfigurationUtils::captchaEnabled()) {
            $vars = \PoP\ComponentModel\Engine_Vars::getVars();
            if (!(PoP_FormUtils::useLoggedinuserData() && $vars['global-userstate']['is-user-logged-in'])) {
                if ($form_id = $_POST["gform_submit"]) {
                    // Check if there's a captcha sent along
                    $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
                    $captcha_name = $moduleprocessor_manager->getProcessor([PoP_Module_Processor_CaptchaFormInputs::class, PoP_Module_Processor_CaptchaFormInputs::MODULE_FORMINPUT_CAPTCHA])->getName([PoP_Module_Processor_CaptchaFormInputs::class, PoP_Module_Processor_CaptchaFormInputs::MODULE_FORMINPUT_CAPTCHA]);
                    if ($captcha = $_POST[$captcha_name]) {
                        // Validate the captcha. If it fails, remove the attr "gform_submit" from $_POST
                        $captcha_validation = GD_Captcha::validate($captcha);
                        if (\PoP\ComponentModel\GeneralUtils::isError($captcha_validation)) {
                            // By unsetting this value in the $_POST, the email won't be processed by function RGForms::maybe_process_form
                            unset($_POST["gform_submit"]);
                        }
                    }
                }
            }
        }
    }
}
    