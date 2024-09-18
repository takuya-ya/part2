<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

// ダミーの初期値　後でデータベースから取得する処理を追加後に削除
$review['title'] = '';
$review['author'] = '';
$review['status'] = '未読';
$review['score'] = '';
$review['summary'] = '';

function listReviews($link) {
    $reviews = [];
    $sql = 'SELECT * FROM reviews';
    $result = mysqli_query($link, $sql);
    while ($review = mysqli_fetch_assoc($result)) {
        $reviews[] = $review;
    }
    return $reviews;
}

$link = dbConnect();
$reviews = listreviews($link);

$title = '読書ログ一覧';
$contents = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
