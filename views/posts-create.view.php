<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <form method="post">
      <input type="text" name="title" value="<?= $_POST['title'] ?? '' ?>">
      <span><?= $errors['title'] ?? '' ?></span><br>
      <input type="text"  name="description" value="<?= $_POST['description'] ?? '' ?>"><br><br>
      <input type="submit" value="Submit">
    </form> 
  </div>
</main>
<?php require('partials/footer.php') ?>

