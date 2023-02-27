<?php

namespace ILIAS\Plugins\NewExampleQuestion;

use ilQuestionSolution;

class SolutionHandler implements \ilQuestionSolutionHandler
{
    public function getSolutionFromValuePairs(array $pairs) : ilQuestionSolution
    {
        return Solution::fromValuePairs($pairs);
    }

    public function getValuePairsFromSolution(ilQuestionSolution $solution) : array
    {
        return $solution->toValuePairs();
    }

    public function getSolutionFromJSON(string $json) : ilQuestionSolution
    {
        return Solution::fromJSON($json);
    }

    public function getJSONFromSolution(ilQuestionSolution $solution) : string
    {
        return $solution->toJSON();
    }


}