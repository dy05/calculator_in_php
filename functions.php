<?php

function add($arg1, $arg2) {
    return $arg1 + $arg2;
}

function remove($arg1, $arg2) {
    return $arg1 - $arg2;
}

function multiply($arg1, $arg2) {
    return $arg1 * $arg2;
}

function divide($arg1, $arg2) {
    return $arg1 / $arg2;
}

function operate($operation, $arg1, $arg2, &$total, &$last_operators, $indice = 0) {
    switch ($operation) {
        case '+':
            return add($arg1, $arg2);
        case '-':
             return remove($arg1, $arg2);
        case '*':
            if ($last_operators[$indice] == '*' || $last_operators[$indice] == '/') {
                return operate($last_operators[$indice], $arg1, $arg2, $total[count($total) - $indice - 2], $last_operators, $indice - 1);
            }

            return multiply($arg1, $arg2);
//            return operate($last_operators[$indice - 2], $arg1, $arg2, $total, $last_operators, $indice - 1);
//            return $total[count($total) - $indice - 2] multiply($arg1, $arg2);
        case '/':
            if ($last_operators[$indice] == '*' || $last_operators[$indice] == '/') {
//                return operate($last_operators[$indice], $arg1, $arg2, $total, $last_operators, $indice - 1);
                return operate($last_operators[$indice], $arg1, $arg2, $total[count($total) - $indice - 2], $last_operators, $indice - 1);
            }
            return divide($arg1, $arg2);
    }
}

