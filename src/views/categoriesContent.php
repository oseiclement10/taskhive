<?php

use App\Controllers\CategoryController;

$userCategories = CategoryController::fetchUserCategories();

?>

<section>
    <h3 class="font-semibold text-2xl"> Your Categories</h3>
    <div class="flex items-end justify-end   mb-8 lg:w-5/6">
        <button id="addCategory" class="bg-amber-500 flex items-center text-white text-center rounded-md px-3 py-1 hover:opacity-80 active:opacity-30">
            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
            </svg>
            <span class="ml-1">Add Category </span>

        </button>
    </div>
    <section class="grid gap-4 md:grid-cols-2 md:gap-8 lg:w-[92%]">
        <?php foreach ($userCategories as $index => $category) { ?>
            <div class="relative border-l-4 border-amber-400 bg-amber-50 rounded-tr-md rounded-br-md py-4 px-2 max-w-[500px]">
                <div class="flex items-center space-x-2">
                    <span class="bg-white flex items-center justify-center text-sm font-semibold w-6 h-6 shadow-sm  rounded-full"> <?php echo $index + 1; ?> </span>
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

    <section id="modalOverlay" class="hidden w-screen h-screen  fixed top-0 left-0  items-center justify-center">
        <div class="absolute w-full h-full bg-black/70 z-1"></div>
        <div class="absolute top-0 right-0 flex justify-between py-2">
            <button class="relative text-3xl cursor-pointer top-10 right-10 text-white hover:opacity-70 active:opacity-30" id="closeOverlay">&times;</button>
        </div>

        <div class=" bg-white rounded-2xl p-8 max-w-[400px] lg:max-w-[500px] relative transition-all ease-in-out duration-150">
            <form name="delete" method="POST" action="/taskhive/usr/category/new" id="">
                <h4 class="text-xl font-semibold mb-2 text-slate-800 ">ADD NEW CATEGORY</h4>
                <label class="block font-semibold text-slate-700 mb-2">Title</label>
                <input required type="text" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task category" name="category" value="" />
                <div class="flex items-center space-x-3 my-4">
                    <input type="submit" name="delete_task" value="Save Task" class="cursor-pointer border px-4 py-1 rounded-md bg-amber-600 text-white  hover:opacity-80 active:opacity-30" />
                    <input id="closeForm" type="button" value="Cancel" class="cursor-pointer border px-4 py-1  rounded-md  border-slate-300 hover:border-blue-400 hover:opacity-80 active:opacity-30" />
                </div>
            </form>
        </div>
    </section>

</section>

<script>
    const addCategoryTrigger = document.getElementById("addCategory");
    const modalOverlay = document.getElementById("modalOverlay");
    const closeOverlay = document.getElementById("closeOverlay");
    const closeForm = document.getElementById("closeForm");

    closeForm.addEventListener("click", (e) => {
        modalOverlay.classList.toggle("hidden");
    })

    closeOverlay.addEventListener("click", (e) => {
        modalOverlay.classList.toggle("hidden");
    })

    addCategoryTrigger.addEventListener("click", (e) => {
        modalOverlay.classList.toggle("hidden");
    })
</script>