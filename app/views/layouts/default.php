<?php
use  blog\App;
use  blog\libs\Pagination;
$categories = \R::findAll('categories');

if (isset($_GET['search'])) {
  $get_search = checkDataForm($_GET);
  // debug($get_search);

  search($get_search);
  //разбить на массив по пробелу
  //задать макс длину запроса и мин 1символ
  //проверить в бд по title в постах совпадение с запросом  и учесть по одной букве запрос
  //совпадения добавлять в массив
  // $res = checkDataForm($arr_form);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->getMeta(); ?>
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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= PATH; ?>">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">

    <div class="row">

    <?= $content; ?>

<div class="col-md-4">

<!-- Search Widget -->
<div class="card md-4">
  <h5 class="card-header">Поиск</h5>
  <div class="card-body">
  <form method="get" action="http://blog/">
      <div class="input-group">
      <input type="text" class="form-control" name="search" placeholder="Поисковый запрос">
      <span class="input-group-append">
        <button class="btn btn-secondary btnSearch" type="submit">Искать!</button>
      </span>
    </div>
  </form>
  </div>
</div>


<!-- Categories Widget -->
<div class="card md-4">
  <h5 class="card-header">Категории</h5>
  <div class="card-body">
    <div class="row">
      <div class="col-lg-6">
        <ul class="list-unstyled mb-0">
        <?php foreach ($categories as $key => $cat) : ?>
          <li>
            <a href="/category/<?= $cat['name']; ?>" data-id='<?= $key ?>'><?= $cat['name']; ?></a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>

    <?php $logs = R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();
    //debug( $logs->grep( 'SELECT' ) ); ?>
    </div>

 </div>

 <!-- Footer -->
  <footer class="py-5 bg-dark footer">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.js" crossorigin="anonymous"></script>
</body>
</html>

