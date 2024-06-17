<?php

namespace App\Controllers;

use App\Models\Task;

use Exception;

const TASKFORMROUTE = "/taskhive/usr/tasks/new";
const TASKPAGE = "/taskhive/usr/tasks";

class TaskController extends Task
{

    public function __construct($params)
    {
        parent::__construct($params);
    }

    protected function validateFields()
    {
        $errors = [];

        if (empty($this->title)) {
            array_push($errors, "title is required");
        }
        if (empty($this->description)) {
            array_push($errors, "description is required");
        }
        if (empty($this->start_datetime)) {
            array_push($errors, "start_datetime is required");
        }
        if (empty($this->due_datetime)) {
            array_push($errors, "due_datetime is required");
        }

        if (empty($this->category)) {
            array_push($errors, "category is required");
        }

        if (empty($this->priority)) {
            array_push($errors, "priority is required");
        }

        return $errors;
    }

    public function saveNew()
    {
        $errors = $this->validateFields();
        if (count($errors) > 0) {
            $_SESSION["taskFormValues"] = [
                "title" => $this->title,
                "description" => $this->description,
                "priority" => $this->priority,
                "start_datetime" => $this->start_datetime,
                "due_datetime" => $this->due_datetime,
                "category" => $this->category,
                "status" => $this->status,
            ];
            $errorStr = implode("_", $errors);
            header("Location: " . TASKFORMROUTE . "$?errors=$errorStr");
        } else {
            try {
                $this->createNewTask();
                header("Location: " . TASKFORMROUTE . "?success=Added Task Successfully");
            } catch (Exception $e) {
                $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
                header("Location: " . TASKFORMROUTE . "?errors=$errorMessage");
            }
        }
    }

    public function updateTask($taskId)
    {
        $errors = $this->validateFields();
        if (count($errors) > 0) {
            $_SESSION["taskFormValues"] = [
                "title" => $this->title,
                "description" => $this->description,
                "priority" => $this->priority,
                "start_datetime" => $this->start_datetime,
                "due_datetime" => $this->due_datetime,
                "category" => $this->category,
                "status" => $this->status,
            ];
            $errorStr = implode("_", $errors);
            header("Location: " . TASKFORMROUTE . "$?errors=$errorStr");
        } else {
            try {
                $this->updateTaskDetails($taskId);
                header("Location: " . TASKFORMROUTE . "?mode=edit&id=$taskId&success=Updated task successfully");
            } catch (Exception $e) {
                $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
                header("Location: " . TASKFORMROUTE . "?mode=edit&id=$taskId" . "&errors=$errorMessage");
            }
        }
    }

    public static function removeTask($taskId)
    {
        try {
            parent::deleteTaskById($taskId);
            header("Location: " . TASKPAGE . "?success=Removed Task Successfully");
        } catch (Exception $e) {
            $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
            header("Location: " . TASKPAGE . "?errors=$errorMessage");
        }
    }

    public static function updateTaskStatus($taskId, $status)
    {
        try {
            parent::changeTaskStatus($taskId, $status);
            header("Location: " . TASKPAGE . "?success=Updated Status successfully");
        } catch (Exception $e) {
            $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
            header("Location: " . TASKPAGE . "?erros=$errorMessage");
        }
    }

    
    public static function getDashboardData()
    {
        function countCompleted($arr){
            return count(array_filter($arr,function($elem){
                return $elem["status"] == "Completed";
            }));
        }

        $results = [];
        try {
            $results["today"] = parent::getTasksDueToday();
            $results["completed_today"] = countCompleted($results["today"]);
            $results["today"] = count($results["today"]);

            $results["this_week"] = parent::getTasksDueThisWeek();
            $results["completed_this_week"] = countCompleted($results["this_week"]);
            $results["this_week"] = count($results["this_week"]);

            $results["this_month"] = parent::getTasksDueThisMonth();
            $results["completed_this_month"] = countCompleted($results["this_month"]);
            $results["this_month"] = count($results["this_month"]);

            $results["upcoming_tasks"] = parent::getUpcomingTasks();
            return $results;
        } catch (Exception $err) {
            echo $err->getMessage();
        }
    }
}
