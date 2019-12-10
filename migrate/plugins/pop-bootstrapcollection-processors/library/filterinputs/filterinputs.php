<?php
class PoP_Module_Processor_MultiSelectFilterInputProcessor extends \PoP\ComponentModel\AbstractFilterInputProcessor
{
    public const FILTERINPUT_MODERATEDPOSTSTATUS = 'filterinput-moderatedpoststatus';
    public const FILTERINPUT_UNMODERATEDPOSTSTATUS = 'filterinput-unmoderatedpoststatus';

    public function getFilterInputsToProcess()
    {
        return array(
            [self::class, self::FILTERINPUT_MODERATEDPOSTSTATUS],
            [self::class, self::FILTERINPUT_UNMODERATEDPOSTSTATUS],
        );
    }

    public function filterDataloadQueryArgs(array $filterInput, array &$query, $value)
    {
        switch ($filterInput[1]) {
            case self::FILTERINPUT_MODERATEDPOSTSTATUS:
            case self::FILTERINPUT_UNMODERATEDPOSTSTATUS:
                $query['post-status'] = $value;
                break;
        }
    }
}


