<?php

require_once __DIR__ . '/lib/mysqli.php';

function validation($review){
    $errors = [];
// if文で入力検査してerrorsに入れる
    if (!strlen($review['title'])) {
        $errors['title'] = 'タイトルを記入してください';
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
        'score' => (int)$_POST['score'],
        'summary' => $_POST['summary']
    ];

    $link = dbConnect();
    createReview($link, $review);
    $errors = validation($review);

    // errorsが無ければデータ登録して一覧ページに遷移
    if (!count($errors)) {
    mysqli_close($link);
    echo 'データベースを切断しました';
    header("Location: index.php");
    }

    var_dump($errors);
    // エラーがあれば、new.phpの登録フォールを再表示して、エラーも表示させる
}
