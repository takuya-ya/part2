<?php
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
  <form action="" method="post">
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
                  <input type="radio" id="status1" name="status1" value="未読">
                  <label for="status1">未読</label>
              </div>
              <div>
                  <input type="radio" id="status2" name="status2" value="読書中">
                  <label for="status2">読書中</label>
              </div>
              <div>
                  <input type="radio" id="status3" name="status3" value="読了">
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
