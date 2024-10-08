<h1 class="h2 text-dark mt-4 mb-4" >読書記録の一覧</h1>
<a href="./new.php" class="btn btn-primary mb-4">読書ログを登録する</a>
<main>
    <?php if (!count($reviews)) : ?>
        会社情報が登録されていません。
    <?php endif; ?>
    <?php foreach ($reviews as $review) : ?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3 h4">
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
            </div>
        </section>
    <?php endforeach; ?>
</main>
