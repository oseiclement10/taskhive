<?php

use App\Controllers\CategoryController;

use App\Controllers\TaskController;

$categories = CategoryController::fetchUserCategories();

$isEditMode = isset($_GET["mode"]) && $_GET["mode"] == "edit";

$pageHeader = $isEditMode  ? "Edit Task" : "Add New Task ";

$existingTask = [];

if ($isEditMode) {
    $taskId = filter_var($_GET["id"], FILTER_SANITIZE_SPECIAL_CHARS);
    $existingTask = TaskController::getUserTaskById($taskId);
}


function populateForm($fieldName, $isEditMode, $existingTask)
{
    return $isEditMode && isset($existingTask[$fieldName]) ? $existingTask[$fieldName] : "";
}

function populateFormSelect($fieldName, $optionId, $isEditMode, $existingTask)
{
    return $isEditMode && isset($existingTask[$fieldName]) && $existingTask[$fieldName] == $optionId  ? "selected" : "";
}

?>

<section class=" pb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-3xl text-slate-700 ">
            <?php echo $pageHeader ?>
        </h3>
        <a href="/taskhive/usr/tasks" class="text-blue-600 underline"> <-- Go Back</a>
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

    <form class="w-4/6" method="POST" action="/taskhive/usr/tasks/new">
        <input type="hidden" name="form_mode" value="<?php echo $isEditMode ? "edit" : "new" ?>" />
        <input type="hidden" name="task_id" value="<?php echo $isEditMode ? $existingTask["id"] : "" ?>" />

        <label class="block font-semibold text-slate-700 mb-2">Title</label>
        <input required type="text" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task title" name="title" value="<?php echo populateForm("title", $isEditMode, $existingTask) ?>" />

        <label class="block font-semibold text-slate-700 mb-2">Description</label>
        <input required type="text" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task description" name="description" value="<?php echo populateForm("description", $isEditMode, $existingTask) ?>" />

        <label class="block font-semibold text-slate-700 mb-2">Start Datetime</label>
        <input required type="datetime-local" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task start time" name="start_datetime" value="<?php echo populateForm("start_datetime", $isEditMode, $existingTask) ?>" />

        <label class="block font-semibold text-slate-700 mb-2">Due Datetime</label>
        <input required type="datetime-local" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" placeholder="enter task end time" name="due_datetime" value="<?php echo populateForm("due_datetime", $isEditMode, $existingTask) ?>" />


        <label class="block font-semibold text-slate-700 mb-2">Task Category</label>
        <select name="category" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200" value="<?php echo populateForm("category_id", $isEditMode, $existingTask) ?>">
            <option value="" class="text-slate-600"></option>
            <?php foreach ($categories as $category) :  ?>
                <option value="<?php echo $category["id"] ?>" <?php echo populateFormSelect("category_id", $category["id"], $isEditMode, $existingTask) ?>> <?php echo htmlspecialchars($category["name"]); ?> </option>
            <?php endforeach; ?>
        </select>

        <label class="block font-semibold text-slate-700 mb-2">Priority</label>
        <select name="priority" aria-placeholder="select priority" class="bg-amber-50 px-4 py-2 block w-full mb-6 rounded-md border-[1px] border-slate-200">
            <?php ?>
            <option value="" class="text-slate-600"></option>
            <option value="very-high" <?php echo populateFormSelect("priority", "very-high", $isEditMode, $existingTask) ?>>Very High</option>
            <option value="high" <?php echo populateFormSelect("priority", "high", $isEditMode, $existingTask) ?>>High</option>
            <option value="moderate" <?php echo populateFormSelect("priority", "moderate", $isEditMode, $existingTask) ?>>Moderate</option>
            <option value="low" <?php echo populateFormSelect("priority", "low", $isEditMode, $existingTask) ?>>Low</option>
            <option value="very-low" <?php echo populateFormSelect("priority", "very-low", $isEditMode, $existingTask) ?>>Very Low</option>

        </select>


        <div class="flex space-x-3 items-end justify-end ">
            <input type="submit" value="Save Task" name="save-task" class="bg-amber-500 text-white px-4 py-2 rounded-md hover:opacity-70 active:opacity-30" />
            <a href="/taskhive/usr/tasks" class="text-amber-500 bg-white border-[1px] border-amber-300 px-4 py-2 rounded-md hover:opacity-70 active:opacity-30"> Cancel </a>
        </div>
    </form>
    <script>
        const notificationsTags = document.getElementsByClassName('notif');
        setTimeout(() => {
            Array.from(notificationsTags).forEach(elem => elem.classList.add("hidden"));
        }, 5000)
    </script>
</section>