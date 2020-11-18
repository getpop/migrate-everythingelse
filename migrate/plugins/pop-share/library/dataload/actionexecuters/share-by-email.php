<?php
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;
use PoPSitesWassup\FormMutations\MutationResolverBridges\AbstractFormComponentMutationResolverBridge;

class GD_DataLoad_ActionExecuter_ShareByEmail extends AbstractFormComponentMutationResolverBridge
{
    public function getMutationResolverClass(): string
    {
        return PoP_ActionExecuterInstance_ShareByEmail::class;
    }

    public function getFormData(): array
    {
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();

        $form_data = array(
            'name' => $moduleprocessor_manager->getProcessor([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME])->getValue([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME]),
            'email' => $moduleprocessor_manager->getProcessor([PoP_Share_Module_Processor_TextFormInputs::class, PoP_Share_Module_Processor_TextFormInputs::MODULE_FORMINPUT_DESTINATIONEMAIL])->getValue([PoP_Share_Module_Processor_TextFormInputs::class, PoP_Share_Module_Processor_TextFormInputs::MODULE_FORMINPUT_DESTINATIONEMAIL]),
            'message' => $moduleprocessor_manager->getProcessor([PoP_Module_Processor_TextareaFormInputs::class, PoP_Module_Processor_TextareaFormInputs::MODULE_FORMINPUT_ADDITIONALMESSAGE])->getValue([PoP_Module_Processor_TextareaFormInputs::class, PoP_Module_Processor_TextareaFormInputs::MODULE_FORMINPUT_ADDITIONALMESSAGE]),
            'target-url' => $moduleprocessor_manager->getProcessor([PoP_Module_Processor_TextFormInputs::class, PoP_Module_Processor_TextFormInputs::MODULE_FORMINPUT_TARGETURL])->getValue([PoP_Module_Processor_TextFormInputs::class, PoP_Module_Processor_TextFormInputs::MODULE_FORMINPUT_TARGETURL]),
            'target-title' => $moduleprocessor_manager->getProcessor([PoP_Module_Processor_TextFormInputs::class, PoP_Module_Processor_TextFormInputs::MODULE_FORMINPUT_TARGETTITLE])->getValue([PoP_Module_Processor_TextFormInputs::class, PoP_Module_Processor_TextFormInputs::MODULE_FORMINPUT_TARGETTITLE]),
        );

        return $form_data;
    }
}

