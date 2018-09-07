<?php

namespace BrainGames\Games\Gcd;

use function \BrainGames\Cli\startEngine;

const GCD_GAME_RULE = 'Find the greatest common divisor of given numbers.';

function findGcd($numOne, $numTwo)
{
    $large = $numOne > $numTwo ? $numOne : $numTwo;
    $small = $numOne > $numTwo ? $numTwo : $numOne;
    $remainder = $large % $small;
    return $remainder === 0 ? $small : findGcd($small, $remainder);
}

function gameRun()
{
    $gameData = function () {
        $numOne = rand(0, 10);
        $numTwo = rand(0, 10);
        $question = "{$numOne} {$numTwo}";
        $answer = findGcd($numOne, $numTwo);
        return [
            'getQuestion' => $question,
            'getCorrectAnswer' => $answer
        ];
    };
    return startEngine($gameData, GCD_GAME_RULE);
}
