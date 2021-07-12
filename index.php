<?php
const EQUAL_CHARACTER = '=';
const SUP_CHARACTER = 'sup';
const NUMBERS = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, '.'];

// List of all operators
const OPERATORS = ['-', '+', '/', '*'];

// List of all input characters coming from the form
$characters = [];

// List of all results in order
$results = [];

// To list all the query like 1+2+3...
$operations = '';


// The result to show to the user after all operations
$result = null;

// The input character (can be a number or an operator)
$character = null;

// The error to show to user
$error = null;

if (! empty($_POST)) {
    require 'functions.php';
    if (isset($_POST['characters'])) {
        $characters = json_decode($_POST['characters']);
    }

    if (isset($_POST['character'])) {
        $character = $_POST['character'];
        $last_character = end($characters);
        if ($character === '0' && substr($last_character, 0, 1) == '0') {
            $character = null;
        }

        if ($character === ',') {
            $character = '.';
            if ($last_character && in_array($character, str_split($last_character))) {
                $character = null;
            }
        }

        if ($character || $character == '0') {
            if (in_array($character, NUMBERS)) {
                // Verify that the last character exists and that it is greater than 0
                if ($last_character && $last_character >= 0 || $last_character == '.') {
                    $characters[count($characters) - 1] = $characters[count($characters) - 1] . $character;
                } else {
                    $characters[] = $character;
                }
            }
            // If character is an operator
            else if (in_array($character, OPERATORS)) {
                // If last character is null
                if (! $last_character) {
                    $error = 'You cant add an operator first';
                }
                // If last characters array is an operator, replace it
                else if (in_array($last_character, OPERATORS)) {
                    $characters[count($characters) - 1] = $character;
                } else {
                    $characters[] = $character;
                }
            } else if ($character === SUP_CHARACTER) {
                // Verify that the last character exists and that its length is greater than 1
                if ($last_character && strlen($last_character) > 1) {
                    $characters[count($characters) - 1] = substr($characters[count($characters) - 1], 0, -1);
                } else {
                    array_pop($characters);
                }
            }
        }

        $characters_temp = $characters;
        if (in_array('0', $characters_temp)) {
            $characters_temp = removeZero($characters_temp);
        }
        $characters_length = count($characters);
        if ($characters_length > 2) {
            // Do division and multiplication from left to right operation first
            if (in_array('*', $characters_temp) || in_array('/', $characters_temp)) {
                $characters_temp = divisionAndMultiplication($characters_temp);
            }
            $results = getTotal($characters_temp);
        } else {
            $results = [];
        }

        // if ($character == EQUAL_CHARACTER && count($results)) {
            $result = end($results) ?? null;
        // }
    }
}

if (count($characters)) {
    $operations = join(' ', $characters);
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
    <?php if ($error): ?>
    <div class="error p-2 m-4"><?= $error; ?></div>
    <?php endif; ?>
    <form action="" method="post">
        <input type="hidden" name="characters" value="<?= htmlspecialchars(json_encode($characters), ENT_QUOTES, 'UTF-8') ?>">
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
                <input class="p-2" type="submit" name="character" value="/" />
                <input class="p-2" type="submit" name="character" value="*" />
                <input class="p-2" type="submit" name="character" value="-" />
                <input class="p-2" type="submit" name="character" value="+" />
            </div>
        </div>
    </form>
</div>

<script>
<?php 
if (in_array('0', $characters)) {
    $characters = removeZero($characters);
}
$characters = join('', $characters);
?>
window.addEventListener('load', () => {
    let $characters = `<?= $characters; ?>`;
    if ($characters.length > 2) {
        let $last_character = $characters[$characters.length - 1];
        if (! ['-', '+', '.', '*', '/'].includes($last_character)) {
            console.log(eval($characters));
        }
    }
})
</script>
</body>
</html>
