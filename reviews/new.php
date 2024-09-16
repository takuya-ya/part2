<?php

$review['title'] = '';
$review['author'] = '';
$review['status'] = '未読';
$review['score'] = '';
$review['summary'] = '';

$errors = [];
$title = '登録ページ';
$contents = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
