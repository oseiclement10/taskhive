<?php

namespace App\Models;

use PDOException;
use App\Models\Category;

const format = "Y-m-d H:i:s";

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
        $this->uid = $_SESSION["uid"];
        $this->title = $params["title"];
        $this->description = $params["description"];
        $this->priority = $params["priority"];
        $this->start_datetime = $params["start_datetime"];
        $this->due_datetime = $params["due_datetime"];
        $this->category = $params["category"];
        $this->status = $params["status"];
    }

    public static function getAllUserTasks()
    {
        $query = "SELECT * FROM tasks where user_id = ? ";
        try {
            $fetchUserTasks = self::connect()->prepare($query);

            if ($fetchUserTasks->execute([$_SESSION["uid"]])) {
                return array_map(function ($elem) {
                    $category = Category::fetchUserCategoryByCategoryId($elem["category_id"]);
                    $elem["category"] = $category["name"];
                    return $elem;
                }, $fetchUserTasks->fetchAll());
            } else {
                throw new PDOException("Error fetching taskss");
            }
        } catch (PDOException $err) {
            error_log("Error fetching user tasks" . $err->getMessage());
            return [];
        }
    }

    public static function getUserTaskById($taskId)
    {
        $query = "SELECT * FROM tasks where user_id = ? AND id = ? ";
        $fetchUserTasks = self::connect()->prepare($query);

        if ($fetchUserTasks->execute([$_SESSION["uid"], $taskId])) {
            return $fetchUserTasks->fetch();
        } else {
            throw new PDOException("Error fetching user tasks");
        }
    }

    public static function deleteTaskById($taskId)
    {
        $query = "DELETE FROM tasks where id = ?";
        $connector = self::connect()->prepare($query);

        if ($connector->execute([$taskId])) {
            return true;
        } else {
            throw new PDOException("Error deleting user tasks");
        }
    }

    protected function createNewTask()
    {
        $query = "INSERT INTO tasks (title,user_id,description,start_datetime,due_datetime,category_id,priority,status) values (?,?,?,?,?,?,?,?)";
        $connector = self::connect()->prepare($query);
        return $connector->execute([
            $this->title,
            $this->uid,
            $this->description,
            $this->start_datetime,
            $this->due_datetime,
            $this->category,
            $this->priority,
            "Pending",
        ]);
    }

    protected function updateTaskDetails($taskId)
    {

        $query = "UPDATE tasks set title = ?, description = ?, start_datetime = ?, due_datetime = ?, category_id = ?, priority = ? where id = ? ";


        $connector = self::connect()->prepare($query);

        return $connector->execute([
            $this->title,
            $this->description,
            $this->start_datetime,
            $this->due_datetime,
            $this->category,
            $this->priority,
            $taskId,
        ]);
    }

    public static function changeTaskStatus($taskId, $status)
    {
        $query = "UPDATE tasks set status = ? where id = ?";
        $connector = self::connect()->prepare($query);

        return $connector->execute([
            $status,
            $taskId,
        ]);
    }

    public static function getUpcomingTasks()
    {
        $today = date(format, strtotime("today 00:00:00"));
        $query = "SELECT * FROM tasks where user_id = ? and due_datetime > ? LIMIT 4";
        $fetchUserTasks = self::connect()->prepare($query);

        if ($fetchUserTasks->execute([$_SESSION["uid"], $today])) {
            return $fetchUserTasks->fetchAll();
        } else {
            throw new PDOException("Error fetching user tasks");
        }
    }

    public static function getTasksDueToday()
    {

        $dawn = date(format, strtotime("today 00:00:00"));
        $lateNight = date(format, strtotime("today 23:59:59"));

        $query = "SELECT * FROM TASKS where user_id = ? AND due_datetime between ? and ?";

        $connector = parent::connect()->prepare($query);


        if ($connector->execute([
            $_SESSION["uid"],
            $dawn,
            $lateNight
        ])) {
            return  $connector->fetchAll();
        } else {
            return 0;
        }
    }

    public static function getTasksDueThisWeek()
    {

        $start = date(format, strtotime("monday this week 00:00:00"));
        $end = date(format, strtotime("sunday this week 23:59:59"));

        $query = "SELECT * FROM TASKS where user_id = ? AND due_datetime between ? and ?";

        $connector = parent::connect()->prepare($query);


        if ($connector->execute([
            $_SESSION["uid"],
            $start,
            $end
        ])) {
            return  $connector->fetchAll();
        } else {
            return 0;
        }
    }

    public static function getTasksDueThisMonth()
    {

        $start = date(format, strtotime("first day of this month 00:00:00"));
        $end = date(format, strtotime("last day of this month 23:59:59"));

        $query = "SELECT * FROM TASKS where user_id = ? AND due_datetime between ? and ?";

        $connector = parent::connect()->prepare($query);


        if ($connector->execute([
            $_SESSION["uid"],
            $start,
            $end
        ])) {
            return  $connector->fetchAll();
        } else {
            return 0;
        }
    }
}
