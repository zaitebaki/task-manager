<?php

namespace App\Models;

use Core\Model;

class Task extends Model
{
    /**
     * Create instance "Task".
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get tasks data from db.
     *
     * @return array
     */
    public function getTasks(int $pageNumber): array
    {
        $startOffset = ($pageNumber - 1) * 3;
        $orderBy     = "created_at";

        if (isset($_SESSION['orderSort'])) {
            switch ($_SESSION['orderSort']) {
                case 'default':
                    $orderBy = "created_at";
                    break;
                case 'name':
                    $orderBy = "user_name";
                    break;
                case 'status':
                    $orderBy = "done";
                    break;
                default:
                    $orderBy = "created_at";
                    break;
            }
        }
        $sql = $this->sqlQuery("SELECT * FROM tasks order by $orderBy LIMIT $startOffset, 3");

        $resultArray = [];
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                $resultArray[] = [
                    'user_name' => $row['user_name'],
                    'email'     => $row['email'],
                    'text'      => $row['text'],
                    'edited'    => $row['edited'],
                    'done'      => $row['done'],
                ];
            }
        }
        return $resultArray;
    }

    /**
     * Get count tasks on db.
     *
     * @return int
     */
    public function getCountTasks(): int
    {
        $count = 0;
        $sql   = $this->sqlQuery("SELECT COUNT(*) as count FROM tasks");

        $resultArray = [];
        if ($sql->num_rows > 0) {
            while ($row = $sql->fetch_assoc()) {
                $count = $row['count'];
            }
        }
        return $count;
    }
}
