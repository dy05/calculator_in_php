<?php

$array = ['2', '-', '4', '*', '0', '*', '3', '-', '5', '*', '2'];

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

function getTotal($characters): array
{
    $total = [(float)$characters[0]];
    $last_operators = [];

    for ($count = 0; $count < count($characters); $count++) {
        $char = $characters[$count];
        // Verify if $char is not 0 or .
        if ($char == '0' || $char == '.') {
            continue;
        }
        $last_total = end($total);
        if (in_array($char, OPERATORS)) {
            $last_operators[] = $char;
        } else {
            if (count($last_operators)) {
                switch (end($last_operators)) {
                    case '+':
                        $total[] = add($last_total, $char);
                        break;
                    case '-':
                        $total[] = remove($last_total, $char);
                        break;
                }
            }
        }
    }

    return $total;
}

function multiplyPriority($array) {
    do {
        $index = array_search('*', $array);
        if ($index === count($array) - 1) {
            unset($array[$index]);
        } else if ($index && isset($array[$index - 1]) && isset($array[$index + 1])) {
            $array[$index - 1] = multiply((float)$array[$index - 1], (float)$array[$index + 1]);
            // Remove the number after the operator
            unset($array[$index + 1]);
            // Remove the index of the operator
            unset($array[$index]);
        }
        $array = array_values($array);
    } while($index);
    return $array;
}

function dividePriority($array) {
    do {
        $index = array_search('/', $array);
        if ($index === count($array) - 1) {
            unset($array[$index]);
        } else if ($index && isset($array[$index - 1]) && isset($array[$index + 1])) {
            $array[$index - 1] = divide((float)$array[$index - 1], (float)$array[$index + 1]);
            // Remove the number after the operator
            unset($array[$index + 1]);
            // Remove the index of the operator
            unset($array[$index]);
        }
        $array = array_values($array);
    } while($index);
    return $array;
}
