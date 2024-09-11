<?php

function validate($reviews)
{
    $errors = [];

    if (!mb_strlen($reviews['title'])) {
        $errors['title'] = '書籍名が入力されていません' . PHP_EOL;
    } elseif (mb_strlen($reviews['title']) > 255) {
        $errors['title'] = '書籍名は255文字以内で入力してください';
    }

    if (!mb_strlen($reviews['author'])) {
        $errors['author'] = '著者名が入力されていません' . PHP_EOL;
    } elseif (mb_strlen($reviews['author']) > 255) {
        $errors['author'] = '著者名は255文字以内で入力してください';
    }

    $status = ['未読', '読書中', '読了'];
    if  (!in_array($reviews['status'], $status)) {
        $errors['status'] = '読書状況は選択肢から入力して下さい' . PHP_EOL;
    }

    if (1 >= $reviews['score'] || $reviews['score'] >= 5) {
        $errors['score'] = '評価は1～5の整数で入力してください' . PHP_EOL;
    }

    if (!mb_strlen($reviews['summary'])) {
        $errors['summary'] = '感想が入力されていません' . PHP_EOL;
    } elseif (mb_strlen($reviews['summary']) > 255) {
        $errors['summary'] = '感想は255文字以内で入力してください';
    }

    return $errors;
}

function dbConnect()
{
    $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
    $error = mysqli_connect_error();

    if(!$link) {
        die(<<<ERROR
データベースに接続できませんでした。
Debuging_error:"$error"
ERROR
        ) . PHP_EOL;
}

return $link;
}

function createReview($link) {
    $reviews = [];
    echo '読書ログを登録して下さい' . PHP_EOL;
    echo 'タイトル:';
    $reviews['title'] = trim(fgets(STDIN));
    echo '著者名:';
    $reviews['author'] = trim(fgets(STDIN));
    echo '読書状況（未読、読書中、読了）:';
    $reviews['status'] = trim(fgets(STDIN));
    echo '評価（5点満点の整数）:';
    $reviews['score'] = (int) trim(fgets(STDIN));
    echo '感想:';
    $reviews['summary'] = trim(fgets(STDIN));
    echo PHP_EOL;

    $validated = validate($reviews);
    if (count($validated) > 0 )
    {
        foreach ($validated as $error)
        {
            echo $error . PHP_EOL;
        }
        return;
    }

    $sql = <<<EOL
    INSERT INTO reviews
    (
      title,
      author,
      status,
      score,
      summary
    ) VALUES (
      "{$reviews['title']}",
      "{$reviews['author']}",
      "{$reviews['status']}",
      "{$reviews['score']}",
      "{$reviews['summary']}"
    )
EOL;

    $result = mysqli_query($link, $sql);
    $error = mysqli_error($link);

    if ($result) {
        echo 'データを登録しました' . PHP_EOL;
    } else {<<<EOL
        die (
        データの登録に失敗しました.
        Debugging_error:"{$error}"
      )
EOL;
    }
}

function listReviews($link) {
    echo '読書ログの一覧を表示します' . PHP_EOL;

    $sql = 'SELECT * FROM reviews;';
    $result = mysqli_query($link, $sql);
    while($review = mysqli_fetch_assoc($result))
    {
      echo '書籍名：' . $review['title'] . PHP_EOL;
      echo '著者名：' . $review['author']  . PHP_EOL;
      echo '読書状況：' . $review['status']  . PHP_EOL;
      echo '評価：' . $review['score']  . PHP_EOL;
      echo '感想：' . $review['summary'] . PHP_EOL;
      echo PHP_EOL;
    }
    mysqli_free_result($result);
}

$link = dbConnect();
while (true) {
    echo '1:読書ログを登録する' . PHP_EOL;
    echo '2:読書ログを表示する' . PHP_EOL;
    echo 'メニューを選択して下さい:';
    $num = trim(fgets(STDIN));

    if ($num === '1') {
        createReview($link);
    } elseif ($num === '2') {
        listReviews($link);
    } else {
        mysqli_close($link);
         echo 'データベースを切断しました。' . PHP_EOL;
        break;
    }
}
