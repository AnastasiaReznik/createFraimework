<div class="col-md-8">
<h1 class="mb-4">Последние опубликованные посты</h1>
<?php if ($allPosts) : ?>
<?php require_once LIBS .'/cardsWithPostsInc.php'; ?>
<?php if ($pagination->countPages > 1) : ?>
<?= $pagination; ?>
<?php endif;  ?>
<?php endif;  ?>
</div>
