<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>
<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
  <ul role="list" class="divide-y divide-gray-100">
  <?php foreach($posts as $post): ?>
    <a href="<?= '/post?id='.$post['id']?>">
    <li class="flex justify-between gap-x-6 py-5">
      <div class="flex min-w-0 gap-x-4">
        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="<?=  'images/'.$post['avatar'] ?>" alt="">
        <div class="min-w-0 flex-auto">
          <p class="text-sm font-semibold leading-6 text-gray-900"><?= $post['username'] ?></p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500"><?= $post['title'] ?></p>
        </div>
      </div>
      <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
        <p class="text-sm leading-6 text-gray-900"><?= $post['profession'] ?></p>
        <p class="mt-1 text-xs leading-5 text-gray-500">Created <?= formatTimeStamp($post["created_at"]) ?></time></p>
      </div>
    </li>
    </a>
  <?php endforeach; ?> 
</ul>

  </div>
</main>
<?php require base_path('views/partials/footer.php') ?>

