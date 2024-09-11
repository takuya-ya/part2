<?php

require_once __DIR__ . '/lib/mysqli.php';

$link = dbConnect();
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
        'title',
        'author',
        'status',
        'score',
        'summary'
    ) VALUES (
        "{$review['title']}",
        "{$review['status']}",
        "{$review['author']}",
        "{$review['score']}",
        "{$review['summary']}"
    )
EOT;
$result = mysqli_query($link, $sql);
  // データベースを切断する
};
