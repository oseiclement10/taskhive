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

    <div class="mb-6 ">
        <?php
        if (isset($_GET["errors"])) {
            $errorsArr = explode("_", $_GET["errors"]);
            foreach ($errorsArr as $error) {
                echo "<p  class='notif bg-red-100 text-red-500 py-1 px-2 my-2 rounded-md'> $error </p>";
            }
        } else if (isset($_GET["success"])) {
            echo "<p  class='notif bg-emerald-100 py-2 px-4 my-2 rounded-md text-green-600 lg:w-1/2'>" . $_GET["success"] . "</p>";
        }
        ?>
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
                    <button>
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
</section>