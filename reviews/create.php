<?php

require_once __DIR__ . '/lib/mysqli.php';

$list = dbConnect();
// HTTPメソッドがPOSTか判定
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $review = [
      'title' => $_POST['title'],
      'author' => $_POST['author'],
      'status' => $_POST['status'],
      'score' => $_POST['score'],
      'summary' => $_POST['summary']
  ];
var_dump($review);

  // データベースに接続
  // ユーザーのポストを取得
  // ヴァリデーション
  // データベースに登録
  // データベースを切断する
};
