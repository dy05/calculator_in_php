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

function getTotal($characters): array
{
    $total = [(float)$characters[0]];
    $last_operators = [];
    $last_character = null;

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
                    case '*':
                        var_dump($last_total);
                        $operator = $last_operators[count($last_operators) - 2] ?? null;
                        if (isset($total[count($total) - 2])) {
                            $last_total = $total[count($total) - 2];
                        }

                        if ($operator) {
                            var_dump($operator);
                            var_dump($last_total);
                            var_dump(multiply($last_character, $char));
                            $total[] = operate($operator, $last_total, multiply($last_character, $char));
                        } else {
                            $total[] = multiply($last_character, $char);
                        }
                        break;
                    case '/':
                        $operator = $last_operators[count($last_operators) - 2] ?? null;
                        if (isset($total[count($total) - 2])) {
                            $last_total = $total[count($total) - 2];
                        }

                        if ($operator) {
                            $total[] = operate($operator, $last_total, divide($last_character, $char));
                        } else {
                            $total[] = divide($last_character, $char);
                        }
                        break;
                }
            }
            $last_character = $char;
        }
    }

    return $total;
}

