<?php

require_once __DIR__ . '/lib/mysqli.php';

function validation($review){
    $errors = [];
// if文で入力検査してerrorsに入れる
    if (!mb_strlen($review['title'])) {
        $errors['title'] = 'タイトルを記入してください' . PHP_EOL;
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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>読書ログ</title>
</head>

<body>
  <h1>読書ログ</h1>
  <h2>読書ログの登録</h2>
  <form action="create.php" method="POST">
        <?php if (count($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>
                        <?php echo $error; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
      <div>
          <label for="title">書籍名</label>
          <input type="text" id="title" name="title">
      </div>
      <div>
          <label for="author">著者名</label>
          <input type="text" id="author" name="author">
      </div>
      <div>
          <label for="status">読書状況</label>
          <div>
              <div>
                  <input type="radio" id="status1" name="status" value="未読">
                  <label for="status1">未読</label>
              </div>
              <div>
                  <input type="radio" id="status2" name="status" value="読書中">
                  <label for="status2">読書中</label>
              </div>
              <div>
                  <input type="radio" id="status3" name="status" value="読了">
                  <label for="status3">読了</label>
              </div>
          </div>
      </div>
      <div>
          <label for="score">評価（5点満点の整数 ）</label>
          <input type="text" id="score" name="score">
      </div>
      <div>
          <label for="summary">感想</label>
          <textarea name="summary" id="summary" rows="10"></textarea>
      </div>
      <button type="submit">登録する</button>
  </form>
</body>
</html>
