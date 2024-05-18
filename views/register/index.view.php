<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<main>
<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
      <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Register</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="/register/create" method="POST">
      <div>
          <!--USERNAME-->
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
          <div class="mt-2">
            <input id="username" name="username" type="username" autocomplete="username" value="<?= $_POST['username'] ?? '' ?>" class="block w-full rounded-md border-0 py-1.5 pl-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php if(isset($errors['username'])): ?>
            <span class="text-red-500 mt-3 text-sm leading-6"><?= $errors['username'] ?? '' ?></span>
            <?php endif; ?>
          </div>
        </div>
        <!--EMAIL-->
        <div>
          <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" value="<?= $_POST['email'] ?? '' ?>" class="block w-full rounded-md border-0 py-1.5 pl-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php if(isset($errors['email'])): ?>
            <span class="text-red-500 mt-3 text-sm leading-6"><?= $errors['email'] ?? '' ?></span>
            <?php endif; ?>
          </div>
        </div>
        <!--PROFESSION-->
        <div>
          <label for="profession" class="block text-sm font-medium leading-6 text-gray-900">Profession</label>
          <div class="mt-2">
            <input id="profession" name="profession" type="profession" autocomplete="profession" value="<?= $_POST['profession'] ?? '' ?>" class="block w-full rounded-md border-0 py-1.5 pl-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php if(isset($errors['profession'])): ?>
            <span class="text-red-500 mt-3 text-sm leading-6"><?= $errors['profession'] ?? '' ?></span>
            <?php endif; ?>
          </div>
        </div>
        <!--PASSWORD-->
        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="text-sm">
            </div>
          </div>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 pl-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            <?php if(isset($errors['password'])): ?>
            <span class="text-red-500 mt-3 text-sm leading-6"><?= $errors['password'] ?? '' ?></span>
            <?php endif; ?>
          </div>
        </div>

        <div>
          <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
</main>
<?php require base_path('views/partials/footer.php') ?>



