<?php

use App\Models\Task;

class TaskController extends Task
{

    private $title;
    private $description;
    private $priority;
    private $start_datetime;
    private $due_datetime;
    private $category;
    private $status;

    public function __construct($params)
    {
        $this->title = $params["title"];
        $this->description = $params["description"];
        $this->priority = $params["priority"];
        $this->start_datetime = $params["start_datetime"];
        $this->due_datetime = $params["due_datetime"];
        $this->category = $params["category"];
        $this->status = $params["status"];
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

    protected function save()
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
            header("Location: ./tasks?errors=$errorStr");
        } else {
            try {
                $this->createNewTask($this);
                header("Location: ./tasks?success=success");
            } catch (Exception $e) {
                $errorMessage = str_replace(["\r", "\n"], "", $e->getMessage());
                header("Location: ./tasks?errors=$errorMessage");
            }
        }
    }
}
