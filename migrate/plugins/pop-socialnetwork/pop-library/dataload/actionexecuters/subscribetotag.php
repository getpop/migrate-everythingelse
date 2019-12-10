<?php
use PoP\Translation\Facades\TranslationAPIFacade;
use PoP\ComponentModel\QueryInputOutputHandlers\ResponseConstants;

class GD_DataLoad_ActionExecuter_SubscribeToTag implements \PoP\ComponentModel\ActionExecuterInterface
{
    protected function getInstance()
    {
        return new GD_SubscribeToTag();
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
        $taxonomyapi = \PoP\Taxonomies\FunctionAPIFactory::getInstance();
        $cmstaxonomiesresolver = \PoP\Taxonomies\ObjectPropertyResolverFactory::getInstance();
        $gd_dataload_actionexecution_manager = \PoP\ComponentModel\ActionExecutionManagerFactory::getInstance();
        $gd_dataload_actionexecution_manager->setResult(self::class, $target_id);
        $tag = $taxonomyapi->getTag($target_id);
        $success_msg = sprintf(
            TranslationAPIFacade::getInstance()->__('You have subscribed to <em><strong>%s</strong></em>.', 'pop-coreprocessors'),
            $cmstaxonomiesresolver->getTagSymbolName($tag)
        );

        // No errors => success
        return array(
            ResponseConstants::SUCCESSSTRINGS => array($success_msg),
            ResponseConstants::SUCCESS => true
        );
    }
}
    