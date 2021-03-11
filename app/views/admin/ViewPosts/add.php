<h3 class="text-center">ДОБАВЛЕНИЕ НОВОЙ СТАТЬИ!</h3>
<?php if (isset($error) AND !empty($error)) : ?>
  <div class="alert alert-danger" role="alert">
  <?= $error; ?>
</div>
<?php endif; ?>
<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Заголовок</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="<?php if (isset($_POST['title'])) {echo $_POST['title']; } ?>">
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">Текст</label>
    <textarea id="summernote" name="text"><?php if (isset($_POST['text'])) {
     echo $_POST['text'];
    } ?> </textarea>

  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Загрузите изображение</label>
  <input class="form-control" type="file" id="formFile" name="image" accept=".jpg,.png" value="" >
</div>
<div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Автор</label>
    <input type="text" class="form-control" id="exampleInputPassword2" name="author" value="<?php if (isset($_POST['author'])) {echo $_POST['author']; } ?>">
  </div>
<div class="mb-3">
    <label for="exampleInputPassword3" class="form-label">Alias</label>
    <input type="text" class="form-control" id="exampleInputPassword3" name="alias" value="<?php if (isset($_POST['alias'])) {echo $_POST['alias']; } ?>">
  </div>
<div class="mb-3">

<div class="accordion accordion" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        Выбор категории
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">

      <div class="accordion-body">
      <ul class="list-group">
        <?php foreach ($categories as $key => $value) : ?>
        <li class="list-group-item">
        <input class="form-check-input" type="checkbox" value="<?= $value['id']; ?>" id="id_category<?= $value['id']; ?>" name="id_category[]">

        <label class="form-check-label" for="id_category<?= $value['id']; ?>">
        <?= $value['name']; ?>
        </label>
        </li>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>

  <div class="mb-3">
  <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status">
  <label class="form-check-label" for="flexSwitchCheckDefault">Активность(скрыть/показать)</label>
</div>
</div>
  <button type="submit" class="btn btn-primary">Добавить</button>
</form>