<?php debug($post_edit); ?>
<h3 class="text-center">Редактирование статьи!</h3>

<form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Заголовок</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="<?= $post_edit['title']; ?>">
  </div>
  <div class="mb-3">
    <label for="text" class="form-label">Текст</label>
    <textarea id="summernote" name="text"> <?= $post_edit['text']; ?> </textarea>
  </div>
  <div class="mb-3">
  <p for="formFile" class="form-label"> Изображение: <?= $post_edit['image']; ?></p>
  <img class="img w-200" src="<?= $post_edit['image']; ?>" alt="">
  <p>
  <label for="formFile" class="form-label">Загрузите другое изображение</label>
  </p>
  <input class="form-control" type="file" id="formFile" name="image" accept=".jpg,.png" value="<?= $post_edit['image']; ?>" >
</div>
<div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Автор</label>
    <input type="text" class="form-control" id="exampleInputPassword2" name="author" value="<?= $post_edit['author']; ?>">
  </div>
<div class="mb-3">
    <label for="exampleInputPassword3" class="form-label">Alias</label>
    <input type="text" class="form-control" id="exampleInputPassword3" name="alias" value="<?= $post_edit['alias']; ?>">
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
       <?php if (in_array($value['id'],$arr_cat)) : ?>
        <input checked class="form-check-input" type="checkbox" value="<?= $value['id']; ?>" id="id_category<?= $value['id']; ?>" name="id_category[]">
        <?php else: ?>
        <input class="form-check-input" type="checkbox" value="<?= $value['id']; ?>" id="id_category<?= $value['id']; ?>" name="id_category[]">
       <?php endif; ?>

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
  <?php  if (($post_edit['status']) == 1) :?>
    <input checked class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status">
    <?php else:  ?>
  <input checked class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status">
  <?php endif; ?>
  <label class="form-check-label" for="flexSwitchCheckDefault">Активность(скрыть/показать)</label>
</div>
</div>
  <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
