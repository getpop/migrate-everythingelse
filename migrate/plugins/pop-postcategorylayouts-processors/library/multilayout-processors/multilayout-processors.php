<?php
use PoP\ComponentModel\Facades\Schema\FieldQueryInterpreterFacade;

class PoP_PostCategoryLayouts_Multilayout_Processor extends PoP_Application_Multilayout_ProcessorBase
{
    public function addLayoutModules(&$layouts, $handle, $format = '')
    {
        switch ($handle) {
            case POP_MULTILAYOUT_HANDLE_POSTCONTENT:
            case POP_MULTILAYOUT_HANDLE_AUTHORPOSTCONTENT:
            case POP_MULTILAYOUT_HANDLE_SINGLEPOSTCONTENT:
                $extra_layouts = array(
                    POP_FORMAT_SIMPLEVIEW => [PoP_PostCategoryLayouts_Module_Processor_SimpleViewPreviewPostLayouts::class, PoP_PostCategoryLayouts_Module_Processor_SimpleViewPreviewPostLayouts::MODULE_LAYOUT_PREVIEWPOST_SIMPLEVIEW_FEATUREIMAGE],
                );
                if ($layout = $extra_layouts[$format]) {
                    if (POP_POSTCATEGORYLAYOUTS_CATEGORIES_LAYOUTFEATUREIMAGE) {
                        $fieldQueryInterpreter = FieldQueryInterpreterFacade::getInstance();
                        $field = $fieldQueryInterpreter->getField(
                            'equals', 
                            [
                                'value1' => $fieldQueryInterpreter->createFieldArgValueAsFieldFromFieldName('post-type'), 
                                'value2' => 'post',
                            ]
                        );
                        $layouts[$field] = $layout;
                        // $layouts['post-featureimage'] = $layout;
                    }
                }
                break;
        }
    }
}

/**
 * Initialization
 */
new PoP_PostCategoryLayouts_Multilayout_Processor();