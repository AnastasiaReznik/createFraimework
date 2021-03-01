<div class="col-md-8">
<h1>Блог о WEB-РАЗРАБОТКЕ</h1>
<hr>
<h5>Все категории блога:</h5>
<?php if ($cat) :?>
<?php foreach ($cat as $key => $categories) : ?>
          <li>
            <a href="/category/<?= $categories['name']; ?>"><?= $categories['name']; ?></a>
          </li>
<?php endforeach; ?>
<?php endif; ?>
<hr>
<h5>Всего постов в блоге:
<?php if (!$countPosts) : ?>
<p>Постов нету!</p>
<?php else : echo $countPosts; ?>
</h5>
<hr>
<h5>Дата первой публикации:<?= $firstDate['date']; ?></h5>
<hr>
<h5>Дата последней публикации:<?= $lastDate['date']; ?></h5>
<hr>
<?php endif; ?>
</div>