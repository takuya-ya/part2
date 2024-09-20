

<a href="./new.php" class="alert-link">読書ログを登録する</a>

<main>
    <?php if (!count($reviews)) : ?>
        会社情報が登録されていません。
    <?php endif; ?>
    <?php foreach ($reviews as $review) : ?>
        <section>
            <h2>
                タイトル：<?php echo escape($review['title']); ?>
            </h2>
            <div>
                著者名：<?php echo escape($review['author']); ?>
            </div>
            <div>
                読書状況：<?php echo escape($review['status']); ?>
            </div>
            <div>
                評価：<?php echo escape($review['score']); ?>
            </div>
            <div>
                感想：<?php echo nl2br(escape($review['summary'])); ?>
            </div>
        </section>
    <?php endforeach; ?>
</main>
