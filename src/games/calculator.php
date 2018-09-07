<?php

namespace BrainGames\Games\Calculator;

use function \BrainGames\Cli\startEngine;

const CALC_GAME_RULES = 'What is the result of the expression?';

function getRandomOperation()
{
    $operations = ['+', '-', '*'];
    return $operations[rand(0, count($operations)- 1)];
}

function getCorrectAnswer($firstNum, $secondNum, $operation)
{
    if ($operation === '+') {
        return $firstNum + $secondNum;
    } elseif ($operation === '-') {
        return $firstNum - $secondNum;
    } else {
        return $firstNum * $secondNum;
    }
}

function gameRun()
{
    $gameData = function () {
        $firstNum = rand(0, 1000);
        $secondNum = rand(0, 1000);
        $randomOperation = getRandomOperation();
        $question = "{$firstNum}{$randomOperation}{$secondNum}";
        $answer = getCorrectAnswer($firstNum, $secondNum, $randomOperation);
        
        return [
            "getQuestion" => $question,
            "getCorrectAnswer" => "{$answer}"
        ];
    };
    return startEngine($gameData, CALC_GAME_RULES);
}
