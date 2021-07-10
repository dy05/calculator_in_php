<?php

function add(float $arg1, float $arg2): float
{
    return $arg1 + $arg2;
}

function remove(float $arg1, float $arg2): float
{
    return $arg1 - $arg2;
}

function multiply(float $arg1, float $arg2): float
{
    return $arg1 * $arg2;
}

function divide(float $arg1, float $arg2): float
{
    return $arg1 / $arg2;
}

function operate($operator, float $arg1, float $arg2): ?float
{
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

    return null;
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

function multiplyPriority($array): array
{
    do {
        $index = array_search('*', $array);
        $array = unsetIndexFromArray($index, '*', $array);
        $array = array_values($array);
    } while($index);
    return $array;
}

function dividePriority($array): array
{
    do {
        $index = array_search('/', $array);
        $array = unsetIndexFromArray($index, '/', $array);
        $array = array_values($array);
    } while($index);
    return $array;
}

function removeZero($array): array
{
    do {
        $index = array_search('0', $array);
        if ($index) {
            // Remove the index of zero
            unset($array[$index]);
        }
        $array = array_values($array);
    } while($index);
    return $array;
}

function unsetIndexFromArray($index, $operation, $array): array
{
    if ($index === count($array) - 1) {
        unset($array[$index]);
    } else if ($index && isset($array[$index - 1]) && isset($array[$index + 1])) {
        if ($operation === '*' || $operation === '/') {
            $array[$index - 1] = $operation === '*'
                ? multiply((float)$array[$index - 1], (float)$array[$index + 1])
                : divide((float)$array[$index - 1], (float)$array[$index + 1]);
            // Remove the number after the operator
            unset($array[$index + 1]);
            // Remove the index of the operator
            unset($array[$index]);
        }
    }
    return $array;
}

function divisionAndMultiplication($array): array
{
    do {
        $indexMultiplication = array_search('/', $array);
        $indexDivision = array_search('/', $array);
        if ($indexDivision < $indexMultiplication) {
            $array = unsetIndexFromArray($indexDivision, '/', $array);
        } else {
            $array = unsetIndexFromArray($indexMultiplication, '*', $array);
        }
        $array = array_values($array);
    } while($indexDivision || $indexMultiplication);
    return $array;
}
