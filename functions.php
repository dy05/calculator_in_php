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

function operate($operation, $arg1, $arg2, $last_total = null, $last_operator = null) {
    switch ($operation) {
        case '+':
            return add($arg1, $arg2);
        case '-':
             return remove($arg1, $arg2);
        case '*':
            if ($last_total && $last_operator) {
                return operate($last_operator, $last_total, multiply($arg1, $arg2));
            }

            return multiply($arg1, $arg2);
        case '/':
            if ($last_total && $last_operator) {
                return operate($last_operator, $last_total, divide($arg1, $arg2));
            }

            return divide($arg1, $arg2);
    }
}

