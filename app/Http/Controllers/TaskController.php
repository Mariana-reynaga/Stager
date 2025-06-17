<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comissions;
use App\Models\User;

use Illuminate\Support\Str;

class TaskController extends Controller
{

    public function findComission(int $id){
        $com_info = Comissions::find($id);

        return $com_info;
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

    public function markTaskComplete(Request $req, int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        $taskComplete = (int) $req->tasks_id; //id of the task i wanna complete

        $tasks[$taskComplete] = [
            'task' => $tasks[$taskComplete]->task,
            'is_complete' => true
        ];

        $this->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        $this->findComission($id)->update(['com_percent' => $this->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function markTaskIncomplete(Request $req, int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        $taskComplete = (int) $req->tasks_id; //id of the task i wanna complete

        $tasks[$taskComplete] = [
            'task' => $tasks[$taskComplete]->task,
            'is_complete' => false
        ];

        $this->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        $this->findComission($id)->update(['com_percent' => $this->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function addTaskProcess(Request $req, int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        $req->validate(
            [
                'com_tasks'=>'required'
            ],
            [
                'com_tasks.required'=>'Las tareas no pueden estar vacias.'
            ]
        );

        $newTasks = collect(explode(', ' , $req->com_tasks ) );

        foreach( $newTasks as $item ){
            $arr = [
                'task'=>$item,
                'is_complete'=>false
            ];

            array_push($tasks, $arr);
        }

        $task_final = Str::replace('" ', '"', json_encode($tasks) );

        $this->findComission($id)->update(['com_tasks' => $task_final, 'com_percent' => $this->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function deleteTask(Request $req, int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        $task2delete = (int) $req->tasks_id;

        $tasks = array_filter($tasks, function($key) use ($task2delete) {
            return $key != $task2delete;
        }, ARRAY_FILTER_USE_KEY);

        $tasks = array_values($tasks);

        $this->findComission($id)->update(['com_tasks' => json_encode($tasks), 'com_percent' => $this->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2')->with('success.msg', 'La tarea se elimino exitosamente.');
    }

    public function moveTaskUp(Request $req, int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        $taskToMove = (int) $req->tasks_id;

        $currentTaskPosition = $taskToMove;

        $finalPosition = $taskToMove - 1;

        [$tasks[$currentTaskPosition], $tasks[$finalPosition]] = [$tasks[$finalPosition], $tasks[$currentTaskPosition]];

        $this->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function moveTaskDown(Request $req, int $id){
        $tasks = json_decode($this->findComission($id)->com_tasks);

        $taskToMove = (int) $req->tasks_id;

        $currentTaskPosition = $taskToMove;

        $finalPosition = $taskToMove + 1;

        [$tasks[$currentTaskPosition], $tasks[$finalPosition]] = [$tasks[$finalPosition], $tasks[$currentTaskPosition]];

        $this->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }
}
