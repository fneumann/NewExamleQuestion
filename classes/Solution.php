<?php

namespace ILIAS\Plugins\NewExampleQuestion;

use ilQuestionSolution;

class Solution implements ilQuestionSolution
{
    private ?string $text = null;
    private ?int $points = null;


    public function __construct(?string $text, ?int $points) {
        $this->text = $text;
        $this->points = $points;
    }

    public function toJSON() : string
    {
        return json_encode([
            'text' => $this->text,
            'points' => $this->points
        ]);
    }

    public static function fromJSON(string $json) : ilQuestionSolution
    {
        $decoded = (array) json_decode($json);
        $text = $decoded['text'] ?? null;
        $points = $decoded['points'] ?? null;

        return new self($text, $points);
    }

    public function toValuePairs() : array
    {
        return [new \ilQuestionSolutionValuePair(
            $this->text,
            isset($this->points) ? (string) $this->points : null)
        ];
    }

    public static function fromValuePairs(array $pairs) : ilQuestionSolution
    {
        $text = null;
        $points = null;
        foreach ($pairs as $pair) {
            $text = $pair->getValue1();
            $points = ($pair->getValue2() === null) ? null : (int) $pair->getValue2();
        }
        return new self($text, $points);
    }

    /**
     * @return string|null
     */
    public function getText() : ?string
    {
        return $this->text;
    }

    /**
     * @return int|null
     */
    public function getPoints() : ?int
    {
        return $this->points;
    }

    public function isEmpty() : bool
    {
        return $this->text === null && $this->points === null;
    }
}