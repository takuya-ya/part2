
  <h1>読書ログ一覧</h1>
  <a href="./new.php">登録ページ</a>
  <main>
      <section>
        <?php echo $review['title']; ?>
      </section>
      <section></section>
      <section></section>
      <section></section>

        "{$review['author']}",
        "{$review['status']}",
        "{$review['score']}",
        "{$review['summary']}"
  </main>
