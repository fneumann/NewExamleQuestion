<?php

class NewExampleQuestionFactory implements ilQuestionTypeFactory
{
    protected NewExampleQuestionPlugin $plugin;


    public function __construct(NewExampleQuestionPlugin $plugin)
    {
        $this->plugin = $plugin;
    }

    public function getTypeTag() : string
    {
        return 'nexmqst';
    }

    public function getTypeTranslation() : string
    {
        return $this->plugin->txt('new_example_question');
    }
}