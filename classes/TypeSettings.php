<?php

namespace ILIAS\Plugins\NewExampleQuestion;

class TypeSettings implements \ilQuestionTypeSettings
{
    /**
     * No specific settings yet
     */
    public function toJSON() : string
    {
        return json_encode('');
    }
}