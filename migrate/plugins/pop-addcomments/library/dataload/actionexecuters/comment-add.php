<?php
use PoP\ComponentModel\QueryInputOutputHandlers\ResponseConstants;

class GD_DataLoad_ActionExecuter_AddComment implements \PoP\ComponentModel\ActionExecuterInterface
{
    protected function getInstance()
    {
        return new GD_AddComment();
    }

    public function execute(&$data_properties)
    {

        // If the post has been submitted, execute the Gravity Forms shortcode
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $errors = array();
            $instance = $this->getInstance();
            $comment_id = $instance->addcomment($errors, $data_properties);

            if ($errors) {
                return array(
                    ResponseConstants::ERRORSTRINGS => $errors
                );
            }

            // Save the result for some module to incorporate it into the query args
            $gd_dataload_actionexecution_manager = \PoP\ComponentModel\ActionExecutionManagerFactory::getInstance();
            $gd_dataload_actionexecution_manager->setResult(get_called_class(), $comment_id);

            // No errors => success
            return array(
                ResponseConstants::SUCCESS => true
            );
        }

        return null;
    }
}

