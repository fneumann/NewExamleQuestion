<?php

namespace ILIAS\Plugins\NewExampleQuestion;

use ilQuestionBaseSettings;
use ilQuestionTypeSettings;
use ilQuestionSolution;


class BackendGrader implements \ilQuestionGrader
{
    protected ilQuestionBaseSettings $base_settings;
    protected ilQuestionTypeSettings $type_settings;

    public function __construct(
        ilQuestionBaseSettings $base_settings,
        ilQuestionTypeSettings $type_settings)
    {
        $this->base_settings = $base_settings;
        $this->type_settings = $type_settings;
    }

    /**
     * @var Solution $solution
     */
    public function getReachedPoints(ilQuestionSolution $solution) : float
    {
       if ($solution->getPoints() <= $this->base_settings->getMaxPoints()) {
           return $solution->getPoints();
       }
       return 0;
    }

    public function getTypeFeedback(ilQuestionSolution $solution) : TypeFeedback
    {
        return new TypeFeedback($solution->getPoints() == $this->base_settings->getMaxPoints());
    }

    public function getCorrectSolution() : ilQuestionSolution
    {
        return new Solution('Best Solution', $this->base_settings->getMaxPoints());
    }
}