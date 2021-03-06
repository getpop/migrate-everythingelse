<?php
use PoP\Translation\Facades\TranslationAPIFacade;

class GD_FormInput_OrderTag extends \PoP\Engine\GD_FormInput_Order
{
    public function getAllValues($label = null)
    {
        $values = parent::getAllValues($label);
        
        $values = array_merge(
            $values,
            array(
                'name|ASC' => TranslationAPIFacade::getInstance()->__('Name ascending', 'pop-application'),
                'name|DESC' => TranslationAPIFacade::getInstance()->__('Name descending', 'pop-application'),
                'count|DESC' => TranslationAPIFacade::getInstance()->__('Count highest', 'pop-application'),
                'count|ASC' => TranslationAPIFacade::getInstance()->__('Count lowest', 'pop-application'),
            )
        );
        
        return $values;
    }

    public function getDefaultValue()
    {
        return 'count|DESC';
    }
}
