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
        case "Overdue":
            return "bg-red-500";
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
<section id="taskContentContainer" class="">
    <h3 class="font-semibold text-2xl"> Your Tasks</h3>
    <div class="flex items-end justify-end w-5/6  mb-6">
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
                <div class="flex space-x-1 items-center justify-end">
                    <span class="relative " title="change status" > 
                        <button class="toggleStatus"> 
                            <svg class="w-[26px] h-[26px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2.7" d="M6 12h.01m6 0h.01m5.99 0h.01"/>
                            </svg>
                        </button>
                        <form name="update_status" method="POST" action="/taskhive/usr/tasks/new" class="toggleContainer absolute hidden top-6 bg-white border-t-2 border-slate-100 flex-col w-fit  py-2 space-y-1 rounded-md shadow-md">
                            <input type="hidden" name="task_id" value="' . $task["id"] . '" />
                            <span class="text-slate-600 text-sm text-center font-semibold underline">Mark task as </span>
                            <input name="update_status" type="submit" value="Pending" class=" py-2 px-5  text-sm cursor-pointer text-slate-600  hover:bg-slate-100 hover:text-amber-600 active:opacity-30 "/>
                            <input name="update_status" type="submit" value="Completed" class=" py-2 px-5  text-sm cursor-pointer text-slate-600 hover:bg-slate-100 hover:text-green-600 active:opacity-30 "/>
                            <input name="update_status" type="submit" value="Overdue" class=" py-2 px-5  text-sm cursor-pointer text-slate-600 hover:bg-slate-100 hover:text-red-600 active:opacity-30 "/>
                        </form>
                    </span>
                    
                    
                    

                    <a title="edit task" href="./tasks/new?mode=edit&id=' . $task["id"] . '">
                        <svg class="w-5 h-5 text-slate-600 dark:text-white hover:text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </a>

                    <button title="delete" class="openDelete" data-id=' . $task["id"] . '>
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

    <!-- DELETE TASK MODAL -->
    <section id="deleteOverlay" class="hidden w-screen h-screen  fixed top-0 left-0  items-center justify-center">
        <div class="absolute w-full h-full bg-black/70 z-1"></div>
        <div class="absolute top-0 right-0 flex justify-between py-2">
            <button class="relative text-3xl cursor-pointer top-10 right-10 text-white hover:opacity-70 active:opacity-30" id="closeOverlay">&times;</button>
        </div>

        <div class=" bg-white rounded-2xl p-8 max-w-[400px] lg:max-w-[500px] relative transition-all ease-in-out duration-150">
            <form name="delete" method="POST" action="/taskhive/usr/tasks/new" id="deleteForm">
                <h4 class="text-xl font-semibold mb-2 text-slate-800 ">DELETE TASK</h4>
                <p class="text-slate-800 py-3">Are you sure you want to delete task <span id="taskname"> </span> ? </p>
                <div class="flex items-center space-x-3 my-4">
                    <input type="submit" name="delete_task" value="Yes ! Delete" class="cursor-pointer border px-4 py-1 rounded-md bg-red-600 text-white border-red-600 hover:opacity-80 active:opacity-30" />
                    <input id="closeForm" type="button" value="Cancel" class="cursor-pointer border px-4 py-1  rounded-md  border-slate-300 hover:border-blue-400 hover:opacity-80 active:opacity-30" />
                </div>

            </form>

        </div>



    </section>

    <script>
        // delete Modal
        const deletePath = "/taskhive/usr/tasks/new";
        const openDelete = document.getElementsByClassName("openDelete");
        const closeOverlay = document.getElementById("closeOverlay");
        const closeForm = document.getElementById("closeForm");
        const deleteOverlay = document.getElementById("deleteOverlay");

        const deleteForm = document.getElementById("deleteForm");
        const taskName = document.getElementById("taskname");

        Array.from(openDelete).forEach((elem) => {
            elem.addEventListener("click", (e) => {
                deleteOverlay.classList.remove("hidden");
                deleteOverlay.classList.add("flex");
                deleteForm.action = `${deletePath}?id=${elem.dataset["id"]}`;
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

        //task status toggle
        const toggleTrigger = Array.from(document.getElementsByClassName("toggleStatus"));
        const toggleStatusContainer = Array.from(document.getElementsByClassName("toggleContainer"));

        //showing toggler
        toggleTrigger.forEach((trigger, index) => {
            trigger.addEventListener("click", (e) => {
                if (toggleStatusContainer[index].classList.contains("hidden")) {
                    toggleStatusContainer[index].classList.replace("hidden", "flex");
                } else {
                    toggleStatusContainer[index].classList.replace("flex", "hidden");
                }
            })
        })

        //handle esc and click when toggleContainer is open
        document.addEventListener("keydown", (event) => {
            if (event.key == "Escape") {
                toggleStatusContainer.forEach(elem => {
                    elem.classList.replace("flex", "hidden")
                })
            } else {
                return;
            }
        })

        // Remove notifications
        const notificationsTags = document.getElementsByClassName('notif');
        setTimeout(() => {
            Array.from(notificationsTags).forEach(elem => elem.classList.add("hidden"));
        }, 5000)
    </script>
</section>