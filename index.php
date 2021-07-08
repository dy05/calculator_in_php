<?php
    require 'functions.php';
    if (! empty($_POST)) {
        dd($_POST);
//        dd($_SERVER['REQUEST_METHOD']);
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
