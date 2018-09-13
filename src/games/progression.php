<?php

namespace BrainGames\Games\Progression;

use function \BrainGames\Cli\startEngine;

const PROGRESSION_GAME_RULES = 'What number is missing in this progression?';

function mkSequence()
{
    $sequenceLength = 9;
    $startNum = rand(0, 100);
    $range = rand(0, 100);
    $missedNumIndex = rand(0, $sequenceLength);
    $sequence = [];

    for ($index = 0; $index < $sequenceLength; $index++) {
        if ($index === $missedNumIndex) {
            $sequence[$index] = '..';
        } else {
            $sequence[$index] = $startNum + ($range * $index);
        }
    }

    return [
        'getSequence' => $sequence,
        'getRange' => $range,
        'getStartNum' => $startNum,
        'getMissedNumIndex' => $missedNumIndex,
        'getSequenceLength' => $sequenceLength,
    ];
}

function toStr($sequenceObj)
{
    $seq = $sequenceObj['getSequence'];
    return implode(' ', $seq);
}

function getMissedNum($sequenceObj)
{
    $seq = $sequenceObj['getSequence'];
    $missedNumIndex = $sequenceObj['getMissedNumIndex'];
    $startNum = $sequenceObj['getStartNum'];
    $range = $sequenceObj['getRange'];

    $previousNum = $seq[$missedNumIndex - 1];
    $nextNum = $seq[$missedNumIndex + 1];

    if ($missedNumIndex === 0) {
        return $nextNum - $range;
    }
    return $previousNum + $range;
}

function getCorrectAnswer($sequenceObj)
{
    return getMissedNum($sequenceObj);
}

function gameRun()
{
    $gameData = function () {
        $sequenceObj = mkSequence();
        $question = toStr($sequenceObj);
        $answer = getCorrectAnswer($sequenceObj);
        return [
            'getQuestion' => $question,
            'getCorrectAnswer' => "{$answer}",
        ];
    };
    return startEngine($gameData, PROGRESSION_GAME_RULES);
}
