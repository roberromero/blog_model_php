<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <h1 class="text-blue-500">
          <?= $post['title'] ?>
      </h1><br>
      <p>
          <?= $post['description'] ?>
      </p><br>
      <div class="flex space-x-4">
    <form method="post" action="/post/destroy">
        <input type="hidden" value="DELETE" name="_request_method">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <button type="submit" class="text-sm bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">Delete</button>
    </form>
    <a href="<?= '/post/edit?id='.$post['id']?>" class="text-sm rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 py-2 px-4">
        Edit
    </a>
</div>

      <br><br><br>
      <a href="/posts" class="text-blue-700 underline font-bold">
          Go back
      </a>
  </div>
</main>
<?php require base_path('views/partials/footer.php') ?>

