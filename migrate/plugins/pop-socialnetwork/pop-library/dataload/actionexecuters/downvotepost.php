<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\QueryInputOutputHandlers\ResponseConstants;

class GD_DataLoad_ActionExecuter_DownvotePost implements \PoP\ComponentModel\ActionExecuterInterface
{
    protected function getInstance()
    {
        return new GD_DownvotePost();
    }

    public function execute(&$data_properties)
    {
        $errors = array();
        $instance = $this->getInstance();
        $target_id = $instance->execute($errors, $data_properties);

        if ($errors) {
            return array(
                ResponseConstants::ERRORSTRINGS => $errors
            );
        }
        
        // Save the result for some module to incorporate it into the query args
        $cmspostsapi = \PoP\Posts\FunctionAPIFactory::getInstance();
        $gd_dataload_actionexecution_manager = \PoP\ComponentModel\ActionExecutionManagerFactory::getInstance();
        $gd_dataload_actionexecution_manager->setResult(self::class, $target_id);
        $success_msg = sprintf(
            TranslationAPIFacade::getInstance()->__('You have down-voted <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
            $cmspostsapi->getTitle($target_id)
        );

        // No errors => success
        return array(
            ResponseConstants::SUCCESSSTRINGS => array($success_msg),
            ResponseConstants::SUCCESS => true
        );
    }
}
    