<?php

namespace BrainGames\Cli;

use function \cli\line;
use function \cli\prompt;

const LIVE_POINTS = 3;


function startEngine($gameData, $gameRules)
{
    line("Welcome to the Brain Games!");
    line("{$gameRules}");
    $playerName = prompt("May I have your name");
    line("Hello {$playerName}");
    
    for ($attempt = 0; $attempt < LIVE_POINTS; $attempt++) {
        $currentGame = gameData();
        $question = $currentGame['getQuestion'];
        $correctAnswer = $currentGame['getCorrectAnswer'];

        line("Question: {$question}");
        $playersAnswer = prompt("Your answer:");

        if ($playersAnswer === $correctAnswer) {
            line("Correct!");
            $userPoints = $userPoints + 1;
        } else {
            line("'{$playersAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'");
            line("Let's try again {$playerName}");
            return;
        }
    }
    return line("Congratulations {$playerName}");
}
