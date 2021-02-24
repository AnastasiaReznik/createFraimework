<div class="col-md-8">
<?php if (!$allPosts) :?>
<h1>Постов в данной категории не найдено!</h1>
<?php else : ?>
<h1 class='text-center'>Категория <?= $this->route['alias']; ?></h1>
<?php require ROOT . '/app/views/inc/cards_with_posts.php'; ?>
<?php endif;  ?>
</div>