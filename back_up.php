<?php

function memoCreate() {
    echo '内容を入力してください';
    $contents = trim(fgets(STDIN));

    echo '重要度を入力してください';
    $importance = trim(fgets(STDIN));
    _dump($importance);

    echo '緊急度を入力してください';
    $urgency = trim(fgets(STDIN));

    echo '〆切を入力してください';
    $deadline = trim(fgets(STDIN));


    return [
        'contents' => $contents,
        'importance' => $importance,
        'urgency' => $urgency,
        'deadline' => $deadline
    ];
}

function memoView($registeredMemos) {
    foreach($registeredMemos as $registeredMemo)
    echo 'メモを表示します' . PHP_EOL;
    echo '内容:' . $registeredMemo['contents'] . PHP_EOL;
    echo '重要度:' . $registeredMemo['importance'] . PHP_EOL;
    echo '緊急度:' . $registeredMemo['urgency'] . PHP_EOL;
    echo '〆切:' . $registeredMemo['deadline'] . PHP_EOL;
}

$registeredMemos = [];
while(true) {
    echo '1.メモを登録する' . PHP_EOL;
    echo '2.メモを表示する' . PHP_EOL;
    echo '9.アプリを終了する' . PHP_EOL;
    echo 'メニューを選択して下さい:';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
       $registeredMemos[] = memoCreate();

    } elseif ($num === '2') {
        memoView($registeredMemos);
    } elseif ($num === '9') {
        break;
    }
}

// 機能を選択する

// 選択を読み込む

// メモを登録する
// メモを表示する
// アプリを終了する
