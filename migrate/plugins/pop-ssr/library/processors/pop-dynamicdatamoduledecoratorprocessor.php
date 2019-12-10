<?php
use PoP\ComponentModel\Modules\ModuleUtils;
use PoP\ComponentModel\ModuleProcessors\AbstractModuleDecoratorProcessor;
use PoP\ComponentModel\Facades\ModuleProcessors\ModuleProcessorManagerFacade;

class PoP_DynamicDataModuleDecoratorProcessor extends AbstractModuleDecoratorProcessor
{

    //-------------------------------------------------
    // PROTECTED Functions
    //-------------------------------------------------

    protected function getModuledecoratorprocessorManager()
    {
        global $pop_module_processordynamicdatadecorator_manager;
        return $pop_module_processordynamicdatadecorator_manager;
    }
    
    //-------------------------------------------------
    // PUBLIC Functions
    //-------------------------------------------------

    public function needsDynamicData(array $module, array &$props)
    {
        $processor = $this->getDecoratedmoduleProcessor($module);
        $needsDynamicData = $processor->getProp($module, $props, 'needs-dynamic-data');
        if (!is_null($needsDynamicData)) {
            return $needsDynamicData;
        }

        return false;
    }

    public function getDynamicDataFieldsDatasetmoduletree(array $module, array &$props)
    {

        // The data-properties start on a dataloading module, and finish on the next dataloding module down the line
        // This way, we can collect all the data-fields that the module will need to load for its dbobjects
        return $this->executeOnSelfAndPropagateToModules('getDynamicDataFieldsDatasetmoduletreeFullsection', __FUNCTION__, $module, $props);
    }

    public function getDynamicDataFieldsDatasetmoduletreeFullsection(array $module, array &$props)
    {
        $ret = array();

        // Only if this module loads data
        $processor = $this->getDecoratedmoduleProcessor($module);
        if ($typeDataResolverClass = $processor->getTypeDataResolverClass($module)) {
            if ($properties = $this->getDynamicDatasetmoduletreeSectionFlattenedDataFields($module, $props)) {
                $ret[POP_CONSTANT_DYNAMICDATAPROPERTIES] = array(
                    $typeDataResolverClass => $properties,
                );
            }
        }
    
        return $ret;
    }

    public function getDynamicDatasetmoduletreeSectionFlattenedDataFields(array $module, array &$props)
    {

        // If it needs dynamic data then that's it, simply return the data properties
        if ($this->needsDynamicData($module, $props)) {
            $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
            return $moduleprocessor_manager->getProcessor($module)->getDatasetmoduletreeSectionFlattenedDataFields($module, $props);
        }

        // Otherwise, propagate to the modules and submodules
        $ret = array();

        // Propagate down to the components
        $this->flattenDatasetmoduletreeDataProperties(__FUNCTION__, $ret, $module, $props);

        // Propagate down to the subcomponent modules
        $this->flattenRelationaldbobjectDataProperties(__FUNCTION__, $ret, $module, $props);
        
        return $ret;
    }

    // function getMutableonrequestDynamicDataPropertiesDatasetmoduletree(array $module, array &$props) {

    //     // The data-properties start on a dataloading module, and finish on the next dataloding module down the line
    //     // This way, we can collect all the data-fields that the module will need to load for its dbobjects
    //     return $this->executeOnSelfAndPropagateToModules('getMutableonrequestDynamicDataPropertiesDatasetmoduletreeFullsection', __FUNCTION__, $module, $props);
    // }

    // function getMutableonrequestDynamicDataPropertiesDatasetmoduletreeFullsection(array $module, array &$props) {

    //     $ret = array();

    //     // Only if this module has a typeDataResolver
    //     $processor = $this->getDecoratedmoduleProcessor($module);
    //     if ($typeDataResolver = $processor->getTypeDataResolverClass($module)) {

    //         if ($properties = $this->getMutableonrequestDynamicDataPropertiesDatasetmoduletreeSection($module, $props)) {

    //             $ret[POP_CONSTANT_DYNAMICDATAPROPERTIES] = array(
    //                 $typeDataResolver => $properties,
    //             );
    //         }
    //     }
    
    //     return $ret;
    // }

    // function getMutableonrequestDynamicDataPropertiesDatasetmoduletreeSection(array $module, array &$props) {

    //     // If it needs dynamic data then that's it, simply return the data properties
    //     if ($this->needsDynamicData($module, $props)) {

    //         $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
    //         return $moduleprocessor_manager->getProcessor($module)->get_mutableonrequest_data_properties_datasetmoduletree_section($module, $props);
    //     }

    //     // Otherwise, propagate to the modules and submodules
    //     $ret = array();

    //     // Propagate down to the components
    //     $this->flattenDatasetmoduletreeDataProperties(__FUNCTION__, $ret, $module, $props);

    //     // Propagate down to the subcomponent modules
    //     $this->flattenRelationaldbobjectDataProperties(__FUNCTION__, $ret, $module, $props);
        
    //     return $ret;
    // }

    protected function flattenDatasetmoduletreeDataProperties($propagate_fn, &$ret, array $module, array &$props)
    {
        global $pop_module_processordynamicdatadecorator_manager;
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
        $moduleFullName = ModuleUtils::getModuleFullName($module);

        // Exclude the subcomponent modules here
        $processor = $this->getDecoratedmoduleProcessor($module);
        $modulefilter_manager = ModuleFilterManager::getInstance();
        $modulefilter_manager->prepareForPropagation($module, $props);
        if ($submodules = $processor->getModulesToPropagateDataProperties($module)) {
            foreach ($submodules as $submodule) {
                $submodule_processor = $moduleprocessor_manager->getProcessor($submodule);

                // Propagate only if the submodule start a new dataloading section. If it does, this is the end of the data line
                if (!$submodule_processor->startDataloadingSection($submodule, $props[$moduleFullName][POP_PROPS_SUBMODULES])) {
                    if ($submodule_ret = $pop_module_processordynamicdatadecorator_manager->getProcessordecorator($moduleprocessor_manager->getProcessor($submodule))->$propagate_fn($submodule, $props[$moduleFullName][POP_PROPS_SUBMODULES])) {
                        // array_merge_recursive => data-fields from different sidebar-components can be integrated all together
                        $ret = array_merge_recursive(
                            $ret,
                            $submodule_ret
                        );
                    }
                }
            }
            
            // Array Merge appends values when under numeric keys, so we gotta filter duplicates out
            if ($ret['data-fields']) {
                $ret['data-fields'] = array_values(array_unique($ret['data-fields']));
            }
        }
        $modulefilter_manager->restoreFromPropagation($module, $props);
    }

    protected function flattenRelationaldbobjectDataProperties($propagate_fn, &$ret, array $module, array &$props)
    {
        global $pop_module_processordynamicdatadecorator_manager;
        $moduleprocessor_manager = ModuleProcessorManagerFacade::getInstance();
        $moduleFullName = ModuleUtils::getModuleFullName($module);
        
        // If it has subcomponent modules, integrate them under 'subcomponents'
        $processor = $this->getDecoratedmoduleProcessor($module);
        $modulefilter_manager = ModuleFilterManager::getInstance();
        $modulefilter_manager->prepareForPropagation($module, $props);
        foreach ($processor->getDomainSwitchingSubmodules($module) as $subcomponent_data_field => $subcomponent_typeDataResolver_options) {
            foreach ($subcomponent_typeDataResolver_options as $subcomponent_typeDataResolver_class => $subcomponent_modules) {
                $subcomponent_modules_data_properties = array(
                    'data-fields' => array(),
                    'subcomponents' => array()
                );
                foreach ($subcomponent_modules as $subcomponent_module) {
                    if ($subcomponent_module_data_properties = $pop_module_processordynamicdatadecorator_manager->getProcessordecorator($moduleprocessor_manager->getProcessor($subcomponent_module))->$propagate_fn($subcomponent_module, $props[$moduleFullName][POP_PROPS_SUBMODULES])) {
                        $subcomponent_modules_data_properties = array_merge_recursive(
                            $subcomponent_modules_data_properties,
                            $subcomponent_module_data_properties
                        );
                    }
                }
                
                $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class] = $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class] ?? array();
                if ($subcomponent_modules_data_properties['data-fields']) {
                    $subcomponent_modules_data_properties['data-fields'] = array_unique($subcomponent_modules_data_properties['data-fields']);
                    
                    $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['data-fields'] = $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['data-fields'] ?? array();
                    $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['data-fields'] = array_unique(
                        array_merge(
                            $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['data-fields'],
                            $subcomponent_modules_data_properties['data-fields']
                        )
                    );
                }
                if ($subcomponent_modules_data_properties['subcomponents']) {
                    $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['subcomponents'] = $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['subcomponents'] ?? array();
                    $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['subcomponents'] = array_merge_recursive(
                        $ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver_class]['subcomponents'],
                        $subcomponent_modules_data_properties['subcomponents']
                    );
                }
            }
        }
        $modulefilter_manager->restoreFromPropagation($module, $props);
    }

    // protected function removeEmptyEntries(&$ret) {
    
    //     // If after the propagation, we have entries of 'subcomponents' empty, then remove them
    //     if ($ret['subcomponents']) {

    //         // Iterate through all the data_field => dataloaders
    //         $subcomponent_data_fields = array_keys($ret['subcomponents']);
    //         foreach ($subcomponent_data_fields as $subcomponent_data_field) {

    //             $subcomponent_typeDataResolvers = array_keys($ret['subcomponents'][$subcomponent_data_field]);
    //             foreach ($subcomponent_typeDataResolvers as $subcomponent_typeDataResolver) {
    //                 if (empty($ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver])) {
                        
    //                     unset($ret['subcomponents'][$subcomponent_data_field][$subcomponent_typeDataResolver]);
    //                 }
    //             }

    //             if (empty($ret['subcomponents'][$subcomponent_data_field])) {
                        
    //                 unset($ret['subcomponents'][$subcomponent_data_field]);
    //             }
    //         }

    //         if (empty($ret['subcomponents'])) {
                    
    //             unset($ret['subcomponents']);
    //         }
    //     }
        
    //     return $ret;
    // }
}

/**
 * Settings Initialization
 */
global $pop_module_processordynamicdatadecorator_manager;
$pop_module_processordynamicdatadecorator_manager->add(PoP_WebPlatformQueryDataModuleProcessorBase::class, PoP_DynamicDataModuleDecoratorProcessor::class);
// $pop_module_processordynamicdatadecorator_manager->add(PoP_Module_ProcessorBaseWrapper::class, PoP_DynamicDataModuleDecoratorProcessor::class);