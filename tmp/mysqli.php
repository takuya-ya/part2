<?php

$link = mysqli_connect('db', 'bok_log', 'pass', 'book_log');
if (!$link) {
    $error = mysqli_connect_error();
    echo <<<ERROR
Error: データベースに接続できませんでした
Debugging error: {$error}
ERROR;
    exit();
}
echo 'データベースに接続できました' . PHP_EOL;
mysqli_close($link);
echo 'データベースを切断しました' . PHP_EOL;
