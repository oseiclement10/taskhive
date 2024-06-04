<?php

use App\Controllers\TaskController;

$userTasks = TaskController::getAllUserTasks();

function getBgColor($prop)
{
    switch ($prop) {
        case "Pending":
            return "bg-amber-200";
        case "Completed":
            return "bg-green-300";
        case "Very High":
            return "bg-red-400";
        case "High":
            return "bg-red-200";
        case "Moderate":
            return "bg-amber-300";
        case "Low":
            return "bg-sky-300";
        case "Very Low":
            return "bg-sky-100";
        default:
            return "bg-amber-200";
    }
}

?>
<section class="">
    <h3 class="font-semibold text-2xl"> Your Tasks</h3>
    <div class="flex items-end justify-end w-5/6  mb-10">
        <a href="./tasks/new" class="bg-amber-500 flex items-center text-white text-center rounded-md px-3 py-1 hover:opacity-80 active:opacity-30">
            <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
            </svg>
            <span class="ml-1">Add New Task</span>

        </a>
    </div>

    <section class="grid grid-cols-3 w-5/6 gap-6">
        <?php
        foreach ($userTasks as $task) {
            echo '
                <div class="border-[1px]  border-slate-200 rounded-xl px-4 py-3 ">
                <div class="flex space-x-1 items-end justify-end">
                    <a href="./tasks/new?mode=edit&id=' . $task["id"] . '">
                        <svg class="w-5 h-5 text-slate-600 dark:text-white hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </a>
                    <button class="openEdit">
                        <svg class="w-5 h-5 text-slate-600 dark:text-white  hover:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                    </button>
    
                </div>
                <div class=" mb-3 -mt-3">
                    <h3 class="font-semibold text-lg">' . htmlspecialchars($task["title"]) . '</h3>
                    <p class="text-slate-700  text-sm">' . htmlspecialchars($task["description"]) . '</p>
                </div>
                <div class="flex justify-between">
                    <div class=" space-x-1">
                        <span class="px-3 rounded-md py-[2px] text-sm ' . getBgColor($task["status"]) . ' ">' . htmlspecialchars($task["status"]) . '</span>
                        <span class="px-3 rounded-md py-[2px] text-sm ' . getBgColor($task["priority"]) . ' ">' . htmlspecialchars($task["priority"]) . '</span>
                    </div>
                    <span class="text-slate-900 text-sm">' . htmlspecialchars($task["category"]) . '</span>
                </div>
            </div>';
        }
        ?>
    </section>

    <!-- DELETE TASK -->
    <section id="deleteOverlay" class="hidden w-screen h-screen  fixed top-0 left-0  items-center justify-center">
        <div class="absolute w-full h-full bg-black/70 z-1"></div>
        <div class="absolute top-0 right-0 flex justify-between py-2">
            <button class="relative text-2xl cursor-pointer top-10 right-10 text-white hover:opacity-70 active:opacity-30" id="closeOverlay">X</button>
        </div>

        <div class=" bg-white rounded-2xl p-8 max-w-[400px] lg:max-w-[500px] relative transition-all ease-in-out duration-150">
            <form name="delete" method="POST" action="/taskhive/usr/tasks/new?mode=delete">
                <h4 class="text-xl font-semibold mb-2 text-slate-800 ">DELETE TASK</h4>
                <p class="text-slate-800 py-3">Are you sure you want to delete task <?php echo $task["title"] ?> ? </p>
                <div class="flex items-center space-x-3 my-4">
                    <button type="submit" class="border px-4 py-1 rounded-md bg-red-600 text-white border-red-600 hover:opacity-80 active:opacity-30 ">YES! DELETE</button>
                    <button id="closeForm" type="button" class="border px-4 py-1  rounded-md  border-slate-300 hover:border-blue-400 hover:opacity-80 active:opacity-30">CANCEL</button>
                </div>
            </form>

        </div>
    </section>

    <script>
        const openEdit = document.getElementsByClassName("openEdit");
        const closeOverlay = document.getElementById("closeOverlay");
        const closeForm = document.getElementById("closeForm");
        const deleteOverlay = document.getElementById("deleteOverlay");

        Array.from(openEdit).forEach(elem => {
            elem.addEventListener("click", (e) => {
                deleteOverlay.classList.remove("hidden");
                deleteOverlay.classList.add("flex");
            })
        })

        closeOverlay.addEventListener("click", (e) => {
            deleteOverlay.classList.remove("flex");
            deleteOverlay.classList.add("hidden");
        })

        closeForm.addEventListener("click", (e) => {
            deleteOverlay.classList.remove("flex");
            deleteOverlay.classList.add("hidden");
        })

    </script>
</section>