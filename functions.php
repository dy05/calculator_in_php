<?php

function add(float $arg1, float $arg2)
{
    return $arg1 + $arg2;
}

function remove(float $arg1, float $arg2)
{
    return $arg1 - $arg2;
}

function multiply(float $arg1, float $arg2) {
    return $arg1 * $arg2;
}

function divide(float $arg1, float $arg2) {
    return $arg1 / $arg2;
}

function operate($operator, float $arg1, float $arg2) {
    switch ($operator) {
        case '+':
            return add($arg1, $arg2);
        case '-':
             return remove($arg1, $arg2);
        case '*':
            return multiply($arg1, $arg2);
        case '/':
            return divide($arg1, $arg2);
    }
}

