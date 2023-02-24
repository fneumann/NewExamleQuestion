<?php

class ilNewExampleQuestionFactory implements ilQuestionFactory
{
    protected ilNewExampleQuestionPlugin $plugin;

    public function __construct(ilNewExampleQuestionPlugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getTypeTag() : string
    {
        return 'NewExampleQuestion';
    }

    public function getTypeTranslation() : string
    {
        return $this->plugin->txt('new_example_question');
    }
}