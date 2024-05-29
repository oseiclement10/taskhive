<?php

namespace App\Models;

use PDOException;


class Task extends DbConnection
{



    public function __construct()
    {
        parent::__construct();
    }

    protected function getAllUserTasks($uid)
    {
        $query = "SELECT * FROM tasks where user_id = ? ";
        try {
            $fetchUserTasks = $this->connect()->prepare($query);

            if ($fetchUserTasks->execute([$uid])) {
                return $fetchUserTasks->fetchAll();
            } else {
                throw new PDOException("Error fetching taskss");
            }
        } catch (PDOException $err) {
            error_log("Error fetching user tasks" . $err->getMessage());
            return [];
        }
    }

    protected function getUserTaskById($uid, $taskId)
    {
        $query = "SELECT * FROM tasks where user_id = ? AND task_id = ? ";
        try {
            $fetchUserTasks = $this->connect()->prepare($query);

            if ($fetchUserTasks->execute([$uid, $taskId])) {
                return $fetchUserTasks->fetch();
            } else {
                throw new PDOException("Error fetching user tasks");
            }
        } catch (PDOException $err) {
            error_log("Error fetching user tasks" . $err->getMessage());
            return;
        }
    }
    protected function createNewTask($properties)
    {
    }
}
