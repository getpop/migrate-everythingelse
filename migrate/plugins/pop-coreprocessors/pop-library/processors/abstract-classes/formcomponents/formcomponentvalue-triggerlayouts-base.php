<?php
use PoP\ComponentModel\Modules\ModuleUtils;
use PoP\ComponentModel\Facades\Instances\InstanceManagerFacade;
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;

abstract class PoP_Module_Processor_TriggerLayoutFormComponentValuesBase extends PoPEngine_QueryDataModuleProcessorBase implements FormComponent
{
    use FormComponentValueTrait, FormComponentModuleDelegatorTrait;

    public function getTemplateResource(array $module, array &$props): ?array
    {
        return [PoP_Forms_TemplateResourceLoaderProcessor::class, PoP_Forms_TemplateResourceLoaderProcessor::RESOURCE_FORMCOMPONENTVALUE_TRIGGERLAYOUT];
    }

    public function getFormcomponentModule(array $module)
    {
        return $this->getTriggerSubmodule($module);
    }

    public function getJsmethods(array $module, array &$props)
    {
        $ret = parent::getJsmethods($module, $props);

        // if ($this->getProp($module, $props, 'replicable')) {

        $this->addJsmethod($ret, 'renderDBObjectLayoutFromURLParam');
        // }

        return $ret;
    }

    public function getTriggerTypeDataResolverClass(array $module)
    {
        return null;
    }
    public function getTriggerSubmodule(array $module)
    {
        return null;
    }

    public function getSubmodules(array $module): array
    {
        $ret = parent::getSubmodules($module);
    
        $ret[] = $this->getTriggerSubmodule($module);
        
        return $ret;
    }

    public function initWebPlatformModelProps(array $module, array &$props)
    {
        $trigger_module = $this->getTriggerSubmodule($module);
        
        // Add the class to be able to merge
        $this->appendProp($module, $props, 'class', PoP_WebPlatformEngine_Module_Utils::getMergeClass($trigger_module));

        parent::initWebPlatformModelProps($module, $props);
    }

    public function getUrlParam(array $module)
    {

        // By default, it is the field name. However, it is disassociated: we can pass "references" in the URL to initially set the value,
        // however the form field has a different name, for security (eg: fight spammers)
        return $this->getName($module);
    }

    public function initRequestProps(array $module, array &$props)
    {
        $this->metaFormcomponentInitModuleRequestProps($module, $props);

        // Because the URL param and the field name are disassociated, instead of getting ->getValue (which gets the value for the fieldname),
        // we do $_REQUEST instead
        if ($value = $_REQUEST[$this->getUrlParam($module)]) {
            $trigger_module = $this->getTriggerSubmodule($module);
            $this->setProp($trigger_module, $props, 'default-value', $value);
        }

        parent::initRequestProps($module, $props);
    }

    public function initModelProps(array $module, array &$props)
    {
        $trigger_module = $this->getTriggerSubmodule($module);

        // // Because the triggered layout will need to be rendered, it needs to have its template_path printed in the webplatform
        // $this->setProp($trigger_module, $props, 'module-path', true);
        $this->setProp($trigger_module, $props, 'dynamic-module', true);

        // // Initialize typeahead value for replicable/webplatform
        // if ($this->getProp($module, $props, 'replicable')) {

        $instanceManager = InstanceManagerFacade::getInstance();
        $typeDataResolver = $instanceManager->getInstance($this->getTriggerTypeDataResolverClass($module));
        $database_key = $typeDataResolver->getDatabaseKey();

        // Needed to execute fillInput on the typeahead input to get the value from the request
        $this->mergeProp(
            $module,
            $props,
            'params',
            array(
                'data-database-key' => $database_key,
                'data-urlparam' => $this->getUrlParam($module),
            )
        );
        // }

        parent::initModelProps($module, $props);
    }

    public function getImmutableJsconfiguration(array $module, array &$props): array
    {
        $ret = parent::getImmutableJsconfiguration($module, $props);

        // if ($this->getProp($module, $props, 'replicable')) {
        $ret['renderDBObjectLayoutFromURLParam']['trigger-layout'] = $this->getTriggerSubmodule($module);
        // }

        return $ret;
    }

    public function getDataFields(array $module, array &$props): array
    {
        $ret = parent::getDataFields($module, $props);
        $this->addMetaFormcomponentDataFields($ret, $module, $props);
        return $ret;
    }

    public function getImmutableConfiguration(array $module, array &$props): array
    {
        $ret = parent::getImmutableConfiguration($module, $props);

        $instanceManager = InstanceManagerFacade::getInstance();
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
        $typeDataResolver_class = $this->getTriggerTypeDataResolverClass($module);
        $typeDataResolver = $instanceManager->getInstance($typeDataResolver_class);
        $ret['dbkey'] = $typeDataResolver->getDatabaseKey();

        $trigger_module = $this->getTriggerSubmodule($module);
        $ret[GD_JS_SUBMODULEOUTPUTNAMES]['trigger-layout'] = ModuleUtils::getModuleOutputName($trigger_module);

        $this->addMetaFormcomponentModuleConfiguration($ret, $module, $props);

        return $ret;
    }
    
    public function getDomainSwitchingSubmodules(array $module): array
    {
        if ($field = $this->getDbobjectField($module)) {
            return array(
                $field => array(
                    $this->getTriggerTypeDataResolverClass($module) => array(
                        $this->getTriggerSubmodule($module),
                    ),
                )
            );
        }
        
        return parent::getDomainSwitchingSubmodules($module);
    }

    public function getMutableonrequestConfiguration(array $module, array &$props): array
    {
        $ret = parent::getMutableonrequestConfiguration($module, $props);
        $this->addMetaFormcomponentModuleRuntimeconfiguration($ret, $module, $props);
        return $ret;
    }

    protected function getModuleMutableonrequestSupplementaryDbobjectdataValues(array $module, array &$props)
    {

        // Load all the potential values for the Typeahead Trigger:
        // First check for the value. If it has one, that's it
        // If not, in the webplatform it will possibly need 2 other values: 'default-value', and the URL param value
        // But the latter one, only if the URL param is different than the name. If it is not, that case is already covered by ->getValue()
        // $filter = $this->getProp($module, $props, 'filter');
        if ($value = $this->getValue($module)) {
            // If not multiinput, the $value may not be an array
            if (!is_array($value)) {
                $value = array($value);
            }
        } else {
            $value = array();
            if ($default_value = $this->getProp($module, $props, 'default-value')) {
                $value = array_merge(
                    $value,
                    is_array($default_value) ? $default_value : array($default_value)
                );
            }
            if ($this->getUrlParam($module) != $this->getName($module)) {
                if ($urlparam_value = $_REQUEST[$this->getUrlParam($module)]) {
                    $value = array_merge(
                        $value,
                        is_array($urlparam_value) ? $urlparam_value : array($urlparam_value)
                    );
                }
            }
        }
        
        return $value;
    }

    public function getMutableonrequestSupplementaryDbobjectdata(array $module, array &$props): array
    {
        if ($value = $this->getModuleMutableonrequestSupplementaryDbobjectdataValues($module, $props)) {
            $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();

            // The Typeahead set the data-settings under 'typeahead-trigger'
            $moduleFullName = ModuleUtils::getModuleFullName($module);
            $trigger_module = $this->getTriggerSubmodule($module);
            $trigger_data_properties = $moduleprocessor_manager->getProcessor($trigger_module)->getDatasetmoduletreeSectionFlattenedDataFields($trigger_module, $props[$moduleFullName][POP_PROPS_SUBMODULES]);

            // Extend the dataload ids
            return array(
                $this->getTriggerTypeDataResolverClass($module) => array(
                    'ids' => $value,
                    'data-fields' => $trigger_data_properties['data-fields'],
                ),
            );
        }
        
        return parent::getMutableonrequestSupplementaryDbobjectdata($module, $props);
    }
}