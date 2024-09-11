<?php

function dbConnect() {
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

    if(!$link)
    {
        echo 'データベースとの接続に失敗しました' . PHP_EOL;
        echo 'Debugging error:' . mysqli_connect_error($link);
        exit;
    }

    return $link;
}

function validation($memo) {
    $error = [];
    if (!mb_strlen($memo['contents'])) {
        $error['contents'] = 'メモ内容が入力されていません' . PHP_EOL;
    } elseif (mb_strlen($memo['contents']) >= 255) {
        $error['contents'] = 'メモは255文字以内で入力して下さい' . PHP_EOL;
    }

    if (!mb_strlen($memo['importance'])) {
        $error['importance'] = '重要度が入力されていません ' . PHP_EOL;
    } elseif ($memo['importance'] < 1 || 5 < $memo['urgency']) {
        $error ['importance'] = '1~5の整数で入力して下さい' . PHP_EOL;
    }

    if (!mb_strlen($memo['urgency'])) {
        $error['urgency'] = '重要度が入力されていません' . PHP_EOL;
    } elseif ($memo['urgency'] < 1 || 5 < $memo['urgency']) {
        $error ['urgency'] = '1~5の整数で入力して下さい'  . PHP_EOL;
    }

    if (!mb_strlen($memo['deadline'])) {
        $error['deadline'] = '〆切が入力されていません' . PHP_EOL;
    } elseif ( $memo['deadline'] < date('Y-m-d')) {
        $error['deadline'] = '〆切を過去に設定することはできません' . PHP_EOL;
    }

    return $error;
 }

function memoCreate($link) {
    $memo = [];
    echo '内容を入力してください:';
    $memo['contents'] = trim(fgets(STDIN));

    echo '重要度を1~5で入力してください:';
    $memo['importance'] = (int)trim(fgets(STDIN));

    echo '緊急度を1~5で入力してください:';
    $memo['urgency'] = (int)trim(fgets(STDIN));

    echo '〆切を入力してください:';
    $memo['deadline'] = trim(fgets(STDIN));
    echo PHP_EOL;

    $validated = validation($memo);
    if ($validated) {
        foreach ($validated as $error) {
            echo $error . PHP_EOL;
        }
        exit;
    }

    $sql = <<<EOL
        INSERT INTO memos (
            contents,
            importance,
            urgency,
            deadline
        ) VALUES (
            "{$memo['contents']}",
            "{$memo['importance']}",
            "{$memo['urgency']}",
            "{$memo['deadline']}"
        )
EOL;

    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo 'データの登録に失敗しました' . PHP_EOL;
        echo 'Debbuging error:' . mysqli_error($link);
        exit;
    }

    echo 'データを登録しました' . PHP_EOL;
    echo PHP_EOL;
}

function memoView($link) {
    echo 'メモを表示します' . PHP_EOL;
    $sql = 'SELECT * FROM memos;';
    $result = mysqli_query($link, $sql);
    while($memo = mysqli_fetch_assoc($result)) {
        echo '内容:' . $memo['contents'] . PHP_EOL;
        echo '重要度:' . $memo['importance'] . PHP_EOL;
        echo '緊急度:' . $memo['urgency'] . PHP_EOL;
        echo '〆切:' . $memo['deadline'] . PHP_EOL;
        echo PHP_EOL;
    }

    mysqli_free_result($result);
}

$link = dbConnect();
while(true) {
    echo '1.メモを登録する' . PHP_EOL;
    echo '2.メモを表示する' . PHP_EOL;
    echo '9.アプリを終了する' . PHP_EOL;
    echo 'メニューを選択して下さい:';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        memoCreate($link);
    } elseif ($num === '2') {
        memoView($link);
    } elseif ($num === '9') {
        mysqli_close($close);
        echo 'データベースを切断しました';
        break;
    }
}
