<?php

require __DIR__ . '/../../vendor/autoload.php';

function dbConnect() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUser = $_ENV['DB_USERNAME'];
    $dbPass = $_ENV['DB_PASSWORD'];
    $dbDatabase = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($dbHost, $dbUser, $dbPass, $dbDatabase);

    $error = mysqli_connect_error();
    if(!$link) {
        die(<<<ERROR
            データベースに接続できませんでした。
            Debuging_error:"$error"
ERROR
        ) . PHP_EOL;
        exit;
    }

return $link;
}
