<?php

namespace App\Models;

use PDOException;


class Task extends DbConnection
{


    protected $title;
    protected $description;
    protected $priority;
    protected $start_datetime;
    protected $due_datetime;
    protected $category;
    protected $status;
    protected $uid;

    public function __construct($params)
    {
        parent::__construct();
        $this->uid = $_SESSION["uid"];
        $this->title = $params["title"];
        $this->description = $params["description"];
        $this->priority = $params["priority"];
        $this->start_datetime = $params["start_datetime"];
        $this->due_datetime = $params["due_datetime"];
        $this->category = $params["category"];
        $this->status = $params["status"];
    }

    protected function getAllUserTasks()
    {
        $query = "SELECT * FROM tasks where user_id = ? ";
        try {
            $fetchUserTasks = $this->connect()->prepare($query);

            if ($fetchUserTasks->execute([$this->uid])) {
                return $fetchUserTasks->fetchAll();
            } else {
                throw new PDOException("Error fetching taskss");
            }
        } catch (PDOException $err) {
            error_log("Error fetching user tasks" . $err->getMessage());
            return [];
        }
    }

    protected function getUserTaskById($taskId)
    {
        $query = "SELECT * FROM tasks where user_id = ? AND task_id = ? ";
        $fetchUserTasks = $this->connect()->prepare($query);

        if ($fetchUserTasks->execute([$this->uid, $taskId])) {
            return $fetchUserTasks->fetch();
        } else {
            throw new PDOException("Error fetching user tasks");
        }
    }
    protected function createNewTask()
    {
        $query = "INSERT INTO tasks (title,user_id,description,start_datetime,due_datetime,category_id,status) values (?,?,?,?,?,?,?)";
        $connector = $this->connect()->prepare($query);
        return $connector->execute([
            $this->title,
            $this->uid,
            $this->description,
            $this->start_datetime,
            $this->due_datetime,
            $this->category,
            "Pending",
        ]);
    }
}
