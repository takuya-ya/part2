<?php

require_once __DIR__ . '/lib/mysqli.php';

$link = dbConnect();
$error = mysqli_connect_error($link);
// HTTPメソッドがPOSTか判定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $review = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'status' => $_POST['status'],
        'score' => $_POST['score'],
        'summary' => $_POST['summary']
    ];

  // ヴァリデーション
  // データベースに登録
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

if ($result) {
    echo 'データを登録しました' . PHP_EOL;
} else {
    echo 'データの登録に失敗しました' . PHP_EOL;
    echo 'Debugging error:' . mysqli_error($link);
}
mysqli_close($link);
echo 'データベースを切断しました';
}
header("Location: index.php");
