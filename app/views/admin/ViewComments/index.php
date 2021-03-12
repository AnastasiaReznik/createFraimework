<h1 class="text-center">Модерация комментариев</h1>
 <?php if (isset($error) AND !empty($error)) : ?>
    <div class="alert alert-danger" role="alert">
  <?= $error; ?>
</div>
 <?php endif; ?>
<form method="post" action="">
<table class="table table-bordered">
<thead>
    <tr>
      <th scope="col">Комментарий</th>
      <th scope="col">Статус</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($comments as $key => $value) : ?>
    <tr>
        <th scope="row">
            <p><?= $value['comment'];?></p>
        </th>
        <td>
            <select name="status[<?= $value['id']?>]" class="form-select" aria-label="Default select example">
                <option value=<?= $value['status']; ?> selected><?= $value['status']; ?></option>
                <?php if ($value['status'] == 'reject' ) : ?>
                <option  value="approve">approve</option>
                <?php elseif ($value['status'] == 'approve') : ?>
                <option  value="reject">reject</option>
                <?php else:  ?>
                <option  value="approve">approve</option>
                <option  value="reject">reject</option>
                <?php endif; ?>
            </select>
        </td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
<button type="submit" class="btn btn-dark">Сохранить</button>
</form>