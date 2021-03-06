<?php
class PoP_Module_Processor_FormsFilterInputProcessor extends \PoP\ComponentModel\AbstractFilterInputProcessor
{
    public const FILTERCOMPONENT_SELECTABLETYPEAHEAD_PROFILES = 'filtercomponent-selectabletypeahead-profiles';
    public const FILTERINPUT_HASHTAGS = 'filterinput-hashtags';

    public function getFilterInputsToProcess()
    {
        return array(
            [self::class, self::FILTERCOMPONENT_SELECTABLETYPEAHEAD_PROFILES],
            [self::class, self::FILTERINPUT_HASHTAGS],
        );
    }

    public function filterDataloadQueryArgs(array $filterInput, array &$query, $value)
    {
        switch ($filterInput[1]) {
            case self::FILTERCOMPONENT_SELECTABLETYPEAHEAD_PROFILES:
                $query['authors'] = $value;
                break;

            case self::FILTERINPUT_HASHTAGS:
                // tags provided separated by space, color or comma
                $tags = [];
                foreach (multiexplode(array(',', ';', ' '), $value) as $hashtag) {
                    if ($hashtag) {
                        $tags[] = (substr($hashtag, 0, 1) == '#') ? substr($hashtag, 1) : $hashtag;
                    }
                }
                $query['tags'] = $tags;
                break;
        }
    }
}
