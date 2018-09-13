<?php

namespace BrainGames\Games\Even;

use function \BrainGames\Cli\startEngine;

const EVEN_GAME_RULES = 'Answer "yes" if number even otherwise answer "no"';


function getCorrectAnswer($question)
{
    $answer = isEven($question)? 'yes' : 'no';
    return $answer;
}

function isEven($number)
{
    return $number % 2 === 0;
}

function gameRun()
{
    $gameData = function () {
        $question = rand(0, 100);
        $answer = getCorrectAnswer($question);
        return [
            "getQuestion" => $question,
            "getCorrectAnswer" => "{$answer}"
        ];
    };
    return startEngine($gameData, EVEN_GAME_RULES);
}
