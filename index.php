<?php
session_start();

const EQUAL_CHARACTER = '=';
const SUP_CHARACTER = 'sup';
const NUMBERS = [0,1,2,3,4,5,6,7,8,9];

// List of all operators
$operators = ['-', '+', '\\', '*'];

// List of all input characters coming from the form
$characters = [];

// List of all results in order
$results = [];

// To list all the query like 1+2+3...
$operations = '';

// The input character (can be a number or an operator)
$character = null;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    session_unset();
} else {
    if (isset($_SESSION['results'])) {
        $results = $_SESSION['results'];
    }
    if (isset($_SESSION['operations'])) {
        $operations = $_SESSION['operations'];
    }
    if (isset($_SESSION['characters'])) {
        $characters = $_SESSION['characters'];
    }
}

// The result to show to the user after all operations
$result = end($results);

if (! empty($_POST)) {
    require 'functions.php';
    if (isset($_POST['character'])) {
        $character = $_POST['character'];

        if (in_array($character, NUMBERS)) {
            $results[] = $character;
            $characters[] = $character;
        }
        // If character is an operator
        else if (in_array($character, $operators)) {
            // If last characters array is an operator, delete it
            if (in_array(end($characters), $operators)) {
                $characters[count($characters) - 1] = $character;
            } else {
                $characters[] = $character;
            }
        } else if ($character === SUP_CHARACTER) {
            array_pop($characters);
        } else {
            session_unset();
        }

//            var_dump($characters);
//            die();
        if ($character !== EQUAL_CHARACTER) {
            $_SESSION['characters'] = $characters;
        }
    }
}

if (count($characters)) {
    $operations = join('', $characters);
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>Calculator</title>
</head>
<body>

<div class="container">
    <h1>Calculator in PHP</h1>
    <form action="" method="post">
        <div class="board">
            <label class="d-none" for="operations"></label>
            <label class="d-none" for="result"></label>
            <input class="p-2" name="operations" id="operations" disabled value="<?= $operations ?? ''; ?>" />
            <input class="p-2" name="result" id="result" disabled value="<?= $result ?? ''; ?>" />
        </div>
        <div class="characters">
            <div class="line-4">
                <div class="grid-3">
                    <input class="p-2" type="submit" name="character" value="1" />
                    <input class="p-2" type="submit" name="character" value="2" />
                    <input class="p-2" type="submit" name="character" value="3" />
                </div>
                <div class="grid-3">
                    <input class="p-2" type="submit" name="character" value="4" />
                    <input class="p-2" type="submit" name="character" value="5" />
                    <input class="p-2" type="submit" name="character" value="6" />
                </div>
                <div class="grid-3">
                    <input class="p-2" type="submit" name="character" value="7" />
                    <input class="p-2" type="submit" name="character" value="8" />
                    <input class="p-2" type="submit" name="character" value="9" />
                </div>
                <div class="grid-3">
                    <input class="p-2" type="submit" name="character" value="," />
                    <input class="p-2" type="submit" name="character" value="0" />
                    <input class="p-2" type="submit" name="character" value="=" />
                </div>
            </div>
            <div class="line-5">
                <input class="p-2" type="submit" name="character" value="sup" />
                <input class="p-2" type="submit" name="character" value="\" />
                <input class="p-2" type="submit" name="character" value="*" />
                <input class="p-2" type="submit" name="character" value="-" />
                <input class="p-2" type="submit" name="character" value="+" />
            </div>
        </div>
    </form>
</div>

</body>
</html>
