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
     * @return mixed
     */
    public function getTasks(int $pageNumber): array
    {
        $startOffset = ($pageNumber - 1) * 3;
        $endOffset   = $startOffset + 3;
        $sql         = $this->sqlQuery("SELECT * FROM tasks order by created_at LIMIT $startOffset, $endOffset");

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
     * Get tasks data from db.
     *
     * @return mixed
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
