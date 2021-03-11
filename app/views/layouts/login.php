<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход для администратора</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
  <link href="/public/styles/css/bootstrap-grid.css" rel="stylesheet">
  <link href="/public/styles/css/bootstrap-grid.min.css" rel="stylesheet">
  <link href="/public/styles/css/bootstrap-reboot.css" rel="stylesheet">
  <link href="/public/styles/css/bootstrap-reboot.min.css" rel="stylesheet">
  <link href="/public/styles/css/bootstrap.css" rel="stylesheet">
  <link href="/public/styles/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
      <a class="navbar-brand" href="<?= PATH; ?>">Главная</a>
</div>
</nav>
<?= $content; ?>
</body>
</html>