<?php
use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;
use PoP\ComponentModel\QueryInputOutputHandlers\ResponseConstants;

class GD_DataLoad_ActionExecuter_LostPasswordReset implements \PoP\ComponentModel\ActionExecuterInterface
{
    public function execute(&$data_properties)
    {

        // If the post has been submitted, execute the Gravity Forms shortcode
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
            $code = trim($moduleprocessor_manager->getProcessor([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::MODULE_FORMINPUT_LOSTPWDRESET_CODE])->getValue([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::MODULE_FORMINPUT_LOSTPWDRESET_CODE]));
            $pwd = trim($moduleprocessor_manager->getProcessor([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::MODULE_FORMINPUT_LOSTPWDRESET_NEWPASSWORD])->getValue([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::MODULE_FORMINPUT_LOSTPWDRESET_NEWPASSWORD]));
            $repeatpwd = trim($moduleprocessor_manager->getProcessor([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::MODULE_FORMINPUT_LOSTPWDRESET_PASSWORDREPEAT])->getValue([PoP_Module_Processor_LoginTextFormInputs::class, PoP_Module_Processor_LoginTextFormInputs::MODULE_FORMINPUT_LOSTPWDRESET_PASSWORDREPEAT]));

            $cmsuseraccountapi = \PoP\UserAccount\FunctionAPIFactory::getInstance();
            $errorcodes = array();
            if ($code) {
                $decoded = GD_LostPasswordUtils::decodeCode($code);
                $rp_key = $decoded['key'];
                $rp_login = $decoded['login'];

                if (!$rp_key || !$rp_login) {
                    $errorcodes[] = 'error-wrongcode';
                } else {
                    $user = $cmsuseraccountapi->checkPasswordResetKey($rp_key, $rp_login);
                    if (!$user || \PoP\ComponentModel\GeneralUtils::isError($user)) {
                        $errorcodes[] = 'error-invalidkey';
                    }
                }
            } else {
                $errorcodes[] = 'error-nocode';
            }

            if (!$pwd) {
                $errorcodes[] = 'error-nopwd';
            } elseif (strlen($pwd) < 8) {
                $errorcodes[] = 'error-short';
            }
            if (!$repeatpwd) {
                $errorcodes[] = 'error-norepeatpwd';
            }
            if ($pwd != $repeatpwd) {
                $errorcodes[] = 'error-pwdnomatch';
            }

            // Return error string
            if ($errorcodes) {
                return array(
                    ResponseConstants::ERRORCODES => $errorcodes
                );
            }

            // Do the actual password reset
            $cmsuseraccountapi->resetPassword($user, $pwd);

            $cmsusersresolver = \PoP\Users\ObjectPropertyResolverFactory::getInstance();
            HooksAPIFacade::getInstance()->doAction('gd_lostpasswordreset', $cmsusersresolver->getUserId($user));

            return array(
                ResponseConstants::SUCCESS => true
            );
        }

        return null;
    }
}
    