<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <?php 
    foreach($posts as $post): ?>
      <ul class="list-none">
          <a href="<?= '/post?id='.$post['id']?>" class="text-blue-500 hover:underline	">
              <?= $post['id'] . " . " . $post['title'] . "<br>" ?>
          </a>
    </ul>
    <?php endforeach; ?> 
  </div>
</main>
<?php require base_path('views/partials/footer.php') ?>

