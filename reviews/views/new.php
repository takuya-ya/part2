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
          <input type="text" id="title" name="title" value="<?php echo $review['title']; ?>">
      </div>
      <div>
          <label for="author">著者名</label>
          <input type="text" id="author" name="author" value="<?php echo $review['author']; ?>">
      </div>
      <div>
          <label for="status">読書状況</label>
          <div>
              <div>
                  <input type="radio" id="status1" name="status" value="未読"
                  <?php echo ($review['status'] === '未読') ? 'checked' : ''; ?>>
                  <label for="status1">未読</label>
              </div>
              <div>
                  <input type="radio" id="status2" name="status" value="読書中"
                  <?php echo ($review['status'] === '読書中') ? 'checked' : ''; ?>>
                  <label for="status2">読書中</label>
              </div>
              <div>
                  <input type="radio" id="status3" name="status" value="読了"
                      <?php echo ($review['status'] === '読了') ? 'checked' : ''; ?>>
                  <label for="status3">読了</label>
              </div>
          </div>
      </div>
      <div>
          <label for="score">評価（5点満点の整数 ）</label>
          <input type="text" id="score" name="score" value="<?php echo $review['score']; ?>">
      </div>
      <div>
          <label for="summary">感想</label>
          <textarea name="summary" id="summary" rows="10"><?php echo $review['summary']; ?></textarea>
      </div>
      <button type="submit">登録する</button>
  </form>
</body>
</html>
