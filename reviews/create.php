<?php

require_once __DIR__ . '/lib/mysqli.php';

function validation($review){
    $errors = [];
// if文で入力検査してerrorsに入れる
    if (!mb_strlen($review['title'])) {
        $errors['title'] = 'タイトルを記入してください' . PHP_EOL;
    }

    if (!mb_strlen($review['author'])) {
        $errors['author'] = '著者名を入力してください' . PHP_EOL;
    }
    if (!mb_strlen($review['status'])) {
        $errors['status'] = '読書状況を入力してください' . PHP_EOL;
    }
    if (!mb_strlen($review['score'])) {
        $errors['score'] = '評価を入力してください' . PHP_EOL;
    }
    if (!mb_strlen($review['summary'])) {
        $errors['summary'] = '感想を入力してください' . PHP_EOL;
    }

    return $errors;
}

function createReview($link, $review) {
    $sql = <<<EOT
    INSERT INTO reviews (
        title,
        author,
        status,
        score,
        summary
    ) VALUES (
        "{$review['title']}",
        "{$review['author']}",
        "{$review['status']}",
        "{$review['score']}",
        "{$review['summary']}"
    )
EOT;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Failed to register data.' . PHP_EOL);
        error_log('Debugging error:' . mysqli_error($link));
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'summary' => $_POST['summary']
    ];

    $link = dbConnect();
    $errors = validation($review);

    // errorsが無ければデータ登録して一覧ページに遷移
    if (!count($errors)) {
    createReview($link, $review);
    mysqli_close($link);
    echo 'データベースを切断しました';
    header("Location: index.php");
    }
}

$title = '読書ログ登録';
$contents = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
