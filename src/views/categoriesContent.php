<?php

use App\Controllers\CategoryController;

$userCategories = CategoryController::fetchUserCategories();

$isFormOpen = (isset($_GET["status"]) && $_GET["status"] == "openForm");


$existingCategory = null;

if ($isFormOpen) {
    $categoryId = filter_var($_GET["id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $existingCategory = CategoryController::fetchUserCategoryByCategoryId($categoryId);
}


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
                    <button title="edit task" class="editTaskTrigger" data-categoryName="<?php echo $category["name"] ?>" data-categoryId="<?php echo $category["id"] ?>">
                        <svg class="w-5 h-5 text-slate-700 dark:text-white hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </button>

                    <button title="delete" class="openDelete">
                        <svg class="w-5 h-5 text-slate-700 dark:text-white  hover:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                    </button>
                </div>

            </div>
        <?php } ?>
    </section>

    <section id="modalOverlay" class="<?php echo $isFormOpen ? "flex" : "hidden" ?> w-screen h-screen  fixed top-0 left-0  items-center justify-center">

        <div class="absolute w-full h-full bg-black/70 z-1"></div>

        <div class="absolute top-0 right-0 flex justify-between py-2">
            <button class="relative text-3xl cursor-pointer top-10 right-10 text-white hover:opacity-70 active:opacity-30" id="closeOverlay">&times;</button>
        </div>

        <div class=" bg-white  rounded-2xl p-8 w-[450px] relative transition-all ease-in-out duration-150">
            <form name="category" method="POST" action="/taskhive/usr/category/form?mode=new" id="categoryForm">
                <h4 id="formCaption" class="text-lg text-center font-semibold mb-4 text-slate-800 ">ADD NEW CATEGORY</h4>
                <input required type="text" id="categoryInput" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter new category" name="category" value="" />
                <div class="flex items-center justify-center space-x-3 my-4">
                    <input type="submit" name="save-category" value="Save Category" class="cursor-pointer  px-4 py-1 rounded-md bg-amber-500 text-white  hover:opacity-80 active:opacity-30" />
                    <input id="closeForm" type="button" value="Cancel" class="cursor-pointer border px-4 py-1  rounded-md  border-slate-300 hover:border-blue-400 hover:opacity-80 active:opacity-30" />
                </div>
            </form>
        </div>
    </section>

</section>

<script>
    const addCategoryTrigger = document.getElementById("addCategory");
    const editTaskTriggers = document.getElementsByClassName("editTaskTrigger");

    const modalOverlay = document.getElementById("modalOverlay");
    const closeOverlay = document.getElementById("closeOverlay");

    const form = document.getElementById("categoryForm");
    const closeForm = document.getElementById("closeForm");
    const formCaption = document.getElementById("formCaption");
    const formNameInput = document.getElementById("categoryInput");



    closeForm.addEventListener("click", (e) => {
        modalOverlay.classList.toggle("hidden");
        modalOverlay.classList.toggle("flex");
    })

    closeOverlay.addEventListener("click", (e) => {
        modalOverlay.classList.toggle("hidden");
        modalOverlay.classList.toggle("flex");
    })

    addCategoryTrigger.addEventListener("click", (e) => {
        formCaption.innerText = "ADD NEW CATEGORY";
        formNameInput.value = "";
        modalOverlay.classList.toggle("hidden");
        modalOverlay.classList.toggle("flex");
    })

    Array.from(editTaskTriggers).forEach((elem) => {

        elem.addEventListener("click", (e) => {

            const categoryId = elem.dataset["categoryid"];
            const categoryName = elem.dataset["categoryname"];

         
            form.action = form.action.replace("new", `edit&category_id=${categoryId}`);
            formCaption.innerText = "EDIT CATEGORY";

            formNameInput.value = categoryName;


            modalOverlay.classList.toggle("hidden");
            modalOverlay.classList.toggle("flex");

        })

    })
</script>