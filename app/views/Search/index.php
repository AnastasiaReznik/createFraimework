<div class="col-lg-8">
<h1>Результаты поиска:</h1>
<?php if (!isset($_GET['search']) OR empty($_GET['search'])) : ?>
<h5>Пустой запрос!</h5>
<?php elseif (!$allPosts) : ?>
<h5>По вашему запросу ничего не найдено!</h5>
<?php elseif ($allPosts) : require ROOT . '/app/views/inc/cards_with_posts.php'; ?>
<?php endif; ?>
<?php if ($pagination->countPages > 1) : ?>
<?= $pagination; ?>
<?php endif;  ?>
</div>