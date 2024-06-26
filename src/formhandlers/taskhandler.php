<?php

use App\Controllers\TaskController;

if (isset($_SESSION["taskFormValues"])) {
    unset($_SESSION["taskFormValues"]);
}

if (isset($_POST["save-task"])) {
    if ($_POST["form_mode"] == "new") {
        $taskController = new TaskController($_POST);
        $taskController->saveNew();
        return;
    }

    if ($_POST["form_mode"] == "edit") {
        $taskController = new TaskController($_POST);
        $taskController->updateTask($_POST["task_id"]);
        return;
    }
} else if (isset($_POST["delete_task"])) {
    $taskId = $_GET["id"];
    TaskController::removeTask($taskId);
    return;
} else if (isset($_POST["update_status"])) {
    $taskId = $_POST["task_id"];
    $status = $_POST["update_status"];
    TaskController::updateTaskStatus($taskId, $status);
} else {
    header("Location: ./task/newtask?errors=create new task here");
}
