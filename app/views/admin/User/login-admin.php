<h1 class="text-center">Вход для администратора</h1>
<div class="row justify-content-center align-items-center" style="margin-top: 60px">
    <form method="POST" style="width: 550px;" action="<?= ADMIN;?>/user/login-admin">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error; ?>
            </div>
        <?php endif; ?>
          <div class="row mb-2">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Login</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>" name="login" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" required>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">
              Sign in
          </button>
        </form>
</div>
