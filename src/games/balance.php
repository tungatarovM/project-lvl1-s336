<?php

namespace BrainGames\Games\Balance;

use function \BrainGames\Cli\startEngine;

const BALANCE_GAME_RULES = 'Balance the given number.';

function splitNum($num)
{
    $str = strval($num);
    $arrOfStrings = str_split($str);
    $arrOfNums = array_map(function ($str) {
        return intval($str);
    }, $arrOfStrings);
    return $arrOfNums;
}

function joinNums(array $arrOfNums)
{
    $joinedStr = implode($arrOfNums);
    return intval($joinedStr);
}

function getMaxDigitIndex(array $nums)
{
    $maxNumIndex = 0;
    
    foreach ($nums as $key => $value) {
        if ($value > $nums[$maxNumIndex]) {
            $maxNumIndex = $key;
        }
    }
    
    return $maxNumIndex;
}

function getMinDigitIndex(array $nums)
{
    $minNumIndex = 0;

    foreach ($nums as $key => $value) {
        if ($value < $nums[$minIndex]) {
            $minNumIndex = $key;
        }
    }
    
    return $minNumIndex;
}

function balanceNum(array $nums)
{
    $newNums = array_slice($nums, 0);
    $maxDigitIndex = getMaxDigitIndex($newNums);
    $minDigitIndex = getMinDigitIndex($newNums);
    
    foreach ($newNums as $key => $value) {

    }
}

function getBalancedNum($num)
{
    $arrOfNums = splitNum($num);

    if (isBalanced($arrOfNums)) {
        sort($arrOfNums);
        return joinNums($arrOfNums);
    }
    return getBalancedNum(balanceNum($arrOfNums));
}

function gameRun()
{
    $gameData = function () {
        $num = rand(0, 1000);
        $question = "{$num}";
        $answer = getBalancedNum($num);
        return [
            'getQuestion' => $question,
            'getCorrectAnswer' => $answer
        ];
    };
    return startEngine($gameData, BALANCE_GAME_RULES);
}
