<?php if (!$data_cat) : ?>
<h1>Произошла ошибка! Попробуйте позже.</h1>
<a href="/admin/category">Вернуться к списку категорий</a>
<?php else: ?>
<h1>Редактирование категории</h1>
<?php if (isset($data_cat['edit_error'])) : ?>
<div class="alert alert-danger" role="alert">
  <?php debug($data_cat['edit_error']); ?>
</div>
<?php endif; ?>
<form method="post" action="">
<table class="table table-bordered">
<thead>
    <tr>
      <th scope="col">Название</th>
      <th scope="col">Alias</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><input class="form-control" type="text" value="<?= $data_cat['name']; ?>" name="name" required></th>
      <td><input class="form-control" type="text" value="<?= $data_cat['alias']; ?>" name="alias" required></td>
    </tr>
  </tbody>
</table>
<button type="submit" class="btn btn-dark">Сохранить</button>
</form>
<a href="/admin/category">Вернуться к списку категорий</a>
<?php endif; ?>