<!-- Post Content Column -->
<div class="col-lg-8">

<?php if (isset($data_to_render['msg'])) : ?>
  <div class="alert alert-primary" role="alert">
    <?= $data_to_render['msg']; ?>
  </div>
<?php endif; ?>
<!-- Title -->
<?php $id_post = $data_to_render['id_post']  ?>
<h1 class="mt-4"><?= $data_to_render['post']['title']; ?></h1>
<hr>

<!-- Date/Time -->
<p>Опубликовано: <?= $data_to_render['post']['date']; ?></p>
<hr>

<!-- Preview Image -->
<img class="" src="<?= $data_to_render['post']['image']; ?>" alt="">
<hr>

<!-- Post Content -->
<p class="lead"><?= $data_to_render['post']['text']; ?></p>
<hr>

<!-- Comments Form -->
<div class="card my-4">
  <h5 class="card-header">Оставьте комментарий:</h5>
  <?php if (isset($data_to_render['error'])) : ?>
  <div class="alert alert-danger" role="alert">
    <?php echo 'Необходимо заполнить поле ' . $data_to_render['error']; ?>
  </div>
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
<?php if ($data_to_render['comments']) : ?>
<!-- Single Comment -->
<?php foreach ($data_to_render['comments'] as $ind => $comment) : ?>
<?php if ($comment['status'] == 'approve') : ?>
<div class="media mb-4">
  <div class="media-body">
    <hr>
    <h5 class="mt-0"><?= htmlspecialchars($comment['author'], ENT_QUOTES, 'utf-8'); ?></h5>
    <?= htmlspecialchars($comment['comment'], ENT_QUOTES, 'utf-8'); ?>
  </div>
</div>
<?php endif; ?>
<?php endforeach;  ?>
<?php endif; ?>
</div>