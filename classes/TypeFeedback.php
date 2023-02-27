<?php

namespace ILIAS\Plugins\NewExampleQuestion;

use ilQuestionTypeFeedback;

class TypeFeedback implements ilQuestionTypeFeedback
{
    private bool $points_ok = false;

    public function __construct(bool $points_ok)
    {
        $this->points_ok = $points_ok;
    }

    public function toJSON() : string
    {
        return json_encode([
           'points_ok' => $this->points_ok
        ]);
    }

    public static function fromJSON(string $json) : TypeFeedback
    {
        $decoded = (array) json_decode($json);
        $points_ok = isset($decoded['points_ok']) ? (bool) $decoded['points_ok'] : false;
        return new self($points_ok);
    }

    /**
     * @return bool
     */
    public function isPointsOk() : bool
    {
        return $this->points_ok;
    }
}