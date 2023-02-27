<?php

class ilNewExampleQuestionPlugin extends ilQuestionTypePlugin
{
    public function factory() : ilQuestionFactory
    {
        return new ILIAS\Plugins\NewExampleQuestion\Factory($this);
    }
}