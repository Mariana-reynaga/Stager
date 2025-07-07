<?php

namespace App\Actions;

use App\Models\Comissions;

class TaskActions
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function findComission(int $id){
        $com_info = Comissions::find($id);

        return $com_info;
    }

    public function getTasks(int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        return $tasks;
    }

    public function updatePercent(int $id){
        $task_completed = 0;

        $tasks = json_decode($this->findComission($id)->com_tasks);

        $tasks_length = count($tasks);

        foreach($tasks as $item){
            if($item->is_complete === true){
                $task_completed ++;
            }
        }

        if ($tasks_length === 0) {
            $percent = 0;
        }else{
            $percent = ceil(($task_completed / $tasks_length) * 100);
        }

        return $percent;
    }

    public function moveTask(int $id, int $taskId, bool $movement){
        $tasks = $this->getTasks($id);

        $taskToMove = $taskId; //el id de la tarea que quiero mover

        $currentTaskPosition = $taskToMove; //la posicion actual

        if ($movement === true) {
            $finalPosition = $taskToMove - 1; //la posición final
        }else{
            $finalPosition = $taskToMove + 1; //la posición final
        }

        [$tasks[$currentTaskPosition], $tasks[$finalPosition]] = [$tasks[$finalPosition], $tasks[$currentTaskPosition]];

        return $tasks;
    }
}
