<?php

use App\Controllers\CategoryController;

$userCategories = CategoryController::fetchUserCategories();

?>

<section>
    <h3 class="font-semibold text-2xl"> Your Categories</h3>

    <div class="flex items-end justify-end   mb-8 lg:w-5/6">
        <a href="./category/new" class="bg-amber-500 flex items-center text-white text-center rounded-md px-3 py-1 hover:opacity-80 active:opacity-30">
            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
            </svg>
            <span class="ml-1">Add Category </span>

        </a>
    </div>
    <section class="grid gap-4 md:grid-cols-2 md:gap-8 lg:w-[92%]">
        <?php foreach ($userCategories as $index => $category) { ?>
            <div class="relative border-l-4 border-amber-400 bg-amber-50 rounded-tr-md rounded-br-md py-4 px-2 max-w-[500px]">
                <div class="flex items-center space-x-2">
                    <span class="bg-white flex items-center justify-center text-sm font-semibold w-5 h-5 shadow-sm  rounded-full"> <?php echo $index + 1; ?> </span>
                    <h2 class="font-semibold text-slate-700 text-lg"> <?php echo $category["name"] ?> </h2>
                </div>

                <div class="flex items-center justify-end absolute right-4 bottom-2">
                    <a title="edit task" href="">
                        <svg class="w-5 h-5 text-slate-700 dark:text-white hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </a>

                    <button title="delete" class="openDelete">
                        <svg class="w-5 h-5 text-slate-700 dark:text-white  hover:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                    </button>
                </div> 

            </div>
        <?php } ?>
    </section>
</section>