<?php

class NewExampleQuestionPlugin extends ilQuestionTypePlugin
{
    public function factory() : ilQuestionTypeFactory
    {
        return new NewExampleQuestionFactory($this);
    }
}