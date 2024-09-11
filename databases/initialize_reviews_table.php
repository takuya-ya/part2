<?php

require __DIR__ . '/../vendor/autoload.php';

function dbConnect() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
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

function dropTable($link) {
    $dropTableSql = 'DROP TABLE IF EXISTS reviews;';
    $result = mysqli_query($link, $dropTableSql);

    if ($result) {
        echo 'テーブルを削除しました' . PHP_EOL;
    } else {
        echo 'テーブルの削除に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }
}

function createTable($link) {
    $createTableSql = <<<EOT
    CREATE TABLE reviews(
    id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR(25) NOT NULL,
    author VARCHAR(30) NOT NULL,
    status VARCHAR(10) NOT NULL,
    score INTEGER NOT NULL,
    summary VARCHAR(300) NOT NULL,
    created_at DATE NOT NULL
    ) DEFAULT CHARSET=utf8mb4;
EOT;
    $result = mysqli_query($link, $createTableSql );
    if ($result) {
        echo 'テーブルを作成しました' . PHP_EOL;
    } else {
        echo 'テーブルの作成に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_error($link) . PHP_EOL;
    }
}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
