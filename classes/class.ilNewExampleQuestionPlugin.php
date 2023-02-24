<?php

class ilNewExampleQuestionPlugin extends ilQuestionTypePlugin
{
    public function factory() : ilQuestionFactory
    {
        return new ilNewExampleQuestionFactory($this);
    }
}