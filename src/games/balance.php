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
        if ($value < $nums[$minNumIndex]) {
            $minNumIndex = $key;
        }
    }
    
    return $minNumIndex;
}

function balanceNum($num)
{
    $arrOfNums = splitNum($num);
    $maxDigitIndex = getMaxDigitIndex($arrOfNums);
    $minDigitIndex = getMinDigitIndex($arrOfNums);
    
    foreach ($arrOfNums as $key => $value) {
        if ($key === $minDigitIndex) {
            $arrOfNums[$key] = $value + 1;
        }
        if ($key === $maxDigitIndex) {
            $arrOfNums[$key] = $value - 1;
        }
    }
    sort($arrOfNums);
    return joinNums($arrOfNums);
}

function isSorted($arrOfNums)
{
    $stack = [$arrOfNums[0]];
    for ($i = 0; $i < count($arrOfNums); $i++) {
        $curr = $arrOfNums[$i];
        $prev = array_pop($stack);
        if ($curr < $prev) {
            return false;
        }
        array_push($stack, $curr);
    }
    return true;
}

function isBalanced($num)
{
    $arrOfNums = splitNum($num);
    $maxDigitIndex = getMaxDigitIndex($arrOfNums);
    $minDigitIndex = getMinDigitIndex($arrOfNums);

    if (count($arrOfNums) <= 1) {
        return true;
    }
    
    if ($arrOfNums[$maxDigitIndex] - $arrOfNums[$minDigitIndex] <= 1 && isSorted($arrOfNums)) {
        return true;
    } else {
        return false;
    }
}

function getBalancedNum($num)
{
    if (isBalanced($num)) {
        return $num;
    }
    return getBalancedNum(balanceNum($num));
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
