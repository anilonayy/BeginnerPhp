<?php

require_once base_path('views/partials/head.php');
require_once base_path('views/partials/nav.php');
require_once base_path('views/partials/banner.php');

?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mt-6">
           <?= htmlspecialchars($note['body']) ?>
        </p>


        <div class="flex gap-3">
            <form class="mt-6" method="POST" action="/notes">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?=$note['id']?>">
                <button class="text-sm text-red-500">Delete</button>
            </form>

            <a class="flex mt-6  text-sm text-blue-500" href="/note/edit?id=<?=$note['id']?>">Update</a>
        </div>
       
    </div>
</main>

<?php require_once base_path('views/partials/footer.php'); ?>