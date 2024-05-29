<?php

namespace App\Controllers;

use App\Models\Task;
use Exception;

const TASKFORMROUTE = "/taskhive/usr/tasks/new";
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

    public function save()
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
                $this->createNewTask(get_object_vars($this));
                header("Location: " . TASKFORMROUTE . "success=success");
            } catch (Exception $e) {
                $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
                header("Location: " . TASKFORMROUTE . "?errors=$errorMessage");
            }
        }
    }
}
