<h3 class="text-center">ДОБАВЛЕНИЕ НОВОЙ КАТЕГОРИИ!</h3>
<?php if (isset($data) AND !empty($data)) : ?>
<div class="alert alert-danger" role="alert">
  <?= $data; ?>
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
      <th scope="row"><input class="form-control" type="text" value="" name="name" required></th>
      <td><input class="form-control" type="text" value="" name="alias" required></td>
    </tr>
  </tbody>
</table>
<button type="submit" class="btn btn-dark">Добавить</button>
</form>
<a href="/admin/category">Вернуться к списку категорий</a>