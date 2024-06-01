<?php

use App\Controllers\TaskController;

if (isset($_SESSION["taskFormValues"])) {
    unset($_SESSION["taskFormValues"]);
}

if (isset($_POST["save-task"])) {
    $taskController = new TaskController($_POST);
    $taskController->saveNew();
} else {
    header("Location: ./task/newtask?errors=create new task here");
}
