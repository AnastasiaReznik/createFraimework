<!-- Post Content Column -->
<div class="col-lg-8">
<?php if (isset($msg)) : ?>
  <div class="alert alert-primary" role="alert">
    <?= $msg; ?>
  </div>
<?php endif; ?>
<!-- Title -->
<h1 class="mt-4"><?= $post[$id_post]['title']; ?></h1>
<hr>

<!-- Date/Time -->
<p>Опубликовано: <?= $post[$id_post]['date']; ?></p>
<hr>

<!-- Preview Image -->
<img class="" src="<?= $post[$id_post]['image']; ?>" alt="">
<hr>

<!-- Post Content -->
<p class="lead"><?= $post[$id_post]['text']; ?></p>
<hr>

<!-- Comments Form -->
<div class="card my-4">
  <h5 class="card-header">Оставьте комментарий:</h5>
  <?php if (isset($error)) : ?>
  <?php if (isset($error['empty_field'])) : ?>
  <?php if ($error['empty_field'] == 'userName') : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $error['error'] . ' "Ваше имя"'; ?>
  </div>
  <?php endif; ?>
  <?php if ($error['empty_field'] == 'email') : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $error['error'] . ' "Email"'; ?>
  </div>
  <?php endif; ?>
  <?php if ($error['empty_field'] == 'comment') : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $error['error'] . ' "Комментарий"'; ?>
  </div>
  <?php endif; ?>
  <?php elseif (!isset($error['empty_field'])) : ?>
    <div class="alert alert-danger" role="alert">
    <?php echo "Заполните все поля!"; ?>
  </div>
  <?php endif; ?>
  <?php endif; ?>
  <div class="card-body">
    <form id="form-comments" method="POST" >
      <div class="form-group">
          <label>Ваше имя: </label>
          <input class="form-control" type="text" name="userName" value="<?php if (isset($_POST['userName'])) {
            echo $_POST['userName'];
          } ?>" required>
          <label>Email: </label>
          <input class="form-control" type="email" name="email" value="<?php if (isset($_POST['email'])) {
            echo $_POST['email'];
          } ?>" required>
          <label>Комментарий: </label>
        <textarea class="form-control" name="comment" rows="3" required><?php if (isset($_POST['comment'])) {
            echo $_POST['comment'];
          } ?></textarea>
      </div>
      <div class="g-recaptcha" data-sitekey="6Ldo4VgaAAAAADS1-8_jIWxzN5M3E0s1T6M3AdVd"></div>
      <button type="submit" class=" btn btn-primary">Отправить</button>
    </form>
  </div>
</div>
<?php if ($comments) : ?>
<!-- Single Comment -->
<?php foreach ($comments as $ind => $comment) : ?>
<div class="media mb-4">
  <div class="media-body">
    <hr>
    <h5 class="mt-0"><?= htmlspecialchars($comment['author'], ENT_QUOTES, 'utf-8'); ?></h5>
    <?= htmlspecialchars($comment['comment'], ENT_QUOTES, 'utf-8'); ?>
  </div>
</div>
<?php endforeach;  ?>
<?php endif; ?>
</div>