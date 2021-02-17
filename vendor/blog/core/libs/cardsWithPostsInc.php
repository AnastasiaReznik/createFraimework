<?php if ($allPosts) : ?>
    <?php foreach ($allPosts as $ind => $content) : ?>
    <!-- Blog Post -->
    <div class="card mb-4" style="width:700px;">
              <h2 class="card-title"> <?= $content['title']; ?></h2>
              <div class="d-flex">
                <img class="card-img-top" src=" <?= $content['image']; ?>" alt="Card image cap" style="width: 200px; height: 150px">
              <div class="card-body" style="">
                  <p class="card-text" style="height: 300px; white-space: wrap;overflow: hidden;padding: 5px;"><?= $content['text']; ?></p>
              </div>
              </div>
                <div class="card-body h-100" style="">
                  <a href="/post/<?=$content['alias']?>" class="btn btn-primary">Читать дальше&rarr;</a>
                </div>
              <div class="card-footer text-muted">
                Дата публикации: <?= $content['date']; ?>
              </div>
            </div>
    <?php endforeach; ?>
<?php endif;  ?>