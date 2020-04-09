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
    public function getTasks()
    {
        $sql = $this->sqlQuery('SELECT * FROM tasks');

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
}
