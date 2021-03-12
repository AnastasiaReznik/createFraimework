<h1 class="text-center">Все категории</h1>
<?php if ($dataPosts) : ?>
<?php  require ROOT . '/app/views/inc/admin_view_cards.php'; ?>
<?php else : ?>
<h5>Категории отсутсвуют!</h5>
<?php  endif; ?>