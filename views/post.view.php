
<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <h1 class="text-blue-500">
          <?= $post['title'] ?>
      </h1><br>
      <p>
          <?= $post['description'] ?>
      </p>
      <br><br><br>
      <a href="<?= $routes['/posts']?>" class="text-blue-700 underline font-bold">
          Go back
      </a>
  </div>
</main>
<?php require('partials/footer.php') ?>

