<?php
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;
use PoPSitesWassup\FormMutations\MutationResolverBridges\AbstractFormComponentMutationResolverBridge;

class GD_DataLoad_ActionExecuter_Flag extends AbstractFormComponentMutationResolverBridge
{
    public function getMutationResolverClass(): string
    {
        return PoP_ActionExecuterInstance_Flag::class;
    }

    public function getFormData(): array
    {
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();

        $form_data = array(
            'name' => $moduleprocessor_manager->getProcessor([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME])->getValue([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_NAME]),
            'email' => $moduleprocessor_manager->getProcessor([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_EMAIL])->getValue([PoP_Forms_Module_Processor_TextFormInputs::class, PoP_Forms_Module_Processor_TextFormInputs::MODULE_FORMINPUT_EMAIL]),
            'whyflag' => $moduleprocessor_manager->getProcessor([PoP_ContentCreation_Module_Processor_TextareaFormInputs::class, PoP_ContentCreation_Module_Processor_TextareaFormInputs::MODULE_FORMINPUT_WHYFLAG])->getValue([PoP_ContentCreation_Module_Processor_TextareaFormInputs::class, PoP_ContentCreation_Module_Processor_TextareaFormInputs::MODULE_FORMINPUT_WHYFLAG]),
            'target-id' => $moduleprocessor_manager->getProcessor([PoP_Application_Module_Processor_PostTriggerLayoutFormComponentValues::class, PoP_Application_Module_Processor_PostTriggerLayoutFormComponentValues::MODULE_FORMCOMPONENT_CARD_POST])->getValue([PoP_Application_Module_Processor_PostTriggerLayoutFormComponentValues::class, PoP_Application_Module_Processor_PostTriggerLayoutFormComponentValues::MODULE_FORMCOMPONENT_CARD_POST]),
        );

        return $form_data;
    }
}

