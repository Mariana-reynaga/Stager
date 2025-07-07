<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comissions;
use App\Models\User;

use Illuminate\Support\Str;

use App\Actions\TaskActions;

class TaskController extends Controller
{
    public function markTaskComplete(Request $req, int $id){
        $action = new TaskActions;

        $tasks = $action->getTasks($id);

        $taskComplete = (int) $req->tasks_id; //id of the task i wanna complete

        $tasks[$taskComplete] = [
            'task' => $tasks[$taskComplete]->task,
            'is_complete' => true
        ];

        $action->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        $action->findComission($id)->update(['com_percent' => $action->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function markTaskIncomplete(Request $req, int $id){
        $action = new TaskActions;

        $tasks = $action->getTasks($id);

        $taskComplete = (int) $req->tasks_id; //id of the task i wanna complete

        $tasks[$taskComplete] = [
            'task' => $tasks[$taskComplete]->task,
            'is_complete' => false
        ];

        $action->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        $action->findComission($id)->update(['com_percent' => $action->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function addTaskProcess(Request $req, int $id){
        $action = new TaskActions;

        $tasks = $action->getTasks($id);

        $req->validate(['com_tasks'=>'required'],['com_tasks.required'=>'Las tareas no pueden estar vacias.']);

        $newTasks = collect(explode(', ' , $req->com_tasks ) );

        foreach( $newTasks as $item ){
            $arr = [
                'task'=>$item,
                'is_complete'=>false
            ];

            array_push($tasks, $arr);
        }

        $task_final = Str::replace('" ', '"', json_encode($tasks) );

        $action->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        $action->findComission($id)->update(['com_percent' => $action->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function deleteTask(Request $req, int $id){
        $action = new TaskActions;

        $tasks = $action->getTasks($id);

        $task2delete = (int) $req->tasks_id;

        $tasks = array_filter($tasks, function($key) use ($task2delete) {
            return $key != $task2delete;
        }, ARRAY_FILTER_USE_KEY);

        $tasks = array_values($tasks);

        $action->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        $action->findComission($id)->update(['com_percent' => $action->updatePercent($id)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2')->with('success.msg', 'La tarea se elimino exitosamente.');
    }

    public function moveTaskUp(Request $req, int $id){
        $action = new TaskActions;

        $tasks= $action->moveTask($id, $req->tasks_id, true);

        $action->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }

    public function moveTaskDown(Request $req, int $id){
        $action = new TaskActions;

        $tasks= $action->moveTask($id, $req->tasks_id, false);

        $action->findComission($id)->update(['com_tasks' => json_encode($tasks)]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '2');
    }
}
