<h1 class="text-center">Все статьи</h1>
<?php if (isset($error_delete) AND !empty($error_delete)) :  ?>
<div class="alert alert-danger" role="alert">
  <?= $error_delete; ?>
</div>
<?php  endif; ?>
<?php if ($dataPosts) : ?>
<?php  require ROOT . '/app/views/inc/admin_view_cards.php';
else : ?>
<h5>Статьи отсутсвуют!</h5>
<?php  endif; ?>