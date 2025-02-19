<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comisiones;
use App\Models\User;

use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function markTaskComplete(Request $req, int $id){
        $com_info = Comisiones::find($id);

        $tasks = json_decode($com_info->com_tasks);

        $taskComplete = (int) $req->tasks_id; //id of the task i wanna complete

        $tasks[$taskComplete] = [
            'task' => $tasks[$taskComplete]->task,
            'is_complete' => true
        ];

        $com_info->update(['com_tasks' => json_encode($tasks)]);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function markTaskIncomplete(Request $req, int $id){
        $com_info = Comisiones::find($id);

        $tasks = json_decode($com_info->com_tasks);

        $taskComplete = (int) $req->tasks_id; //id of the task i wanna complete

        $tasks[$taskComplete] = [
            'task' => $tasks[$taskComplete]->task,
            'is_complete' => false
        ];

        $com_info->update(['com_tasks' => json_encode($tasks)]);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function addTask(int $id){
        $comision = Comisiones::findOrFail($id);

        return view('espacioTrabajo.tasks.add-task', [
            'comision' => $comision
        ]);
    }

    public function addTaskProcess(Request $req, int $id){
        $com_info = Comisiones::find($id);

        $tasks = json_decode($com_info->com_tasks);

        $new_tasks = [];

        $req->validate(
            [
                'com_tasks'=>'required'
            ],
            [
                'com_tasks.required'=>'Las tareas no pueden estar vacias.'
            ]
        );

        $newTasks = collect(explode(',' , $req->com_tasks ) );

        foreach( $newTasks as $item ){
            $arr = [
                'task'=>$item,
                'is_complete'=>false
            ];

            array_push($tasks, $arr);
        }

        $task_final = Str::replace('" ', '"', json_encode($tasks) );

        $com_info->update(['com_tasks' => $task_final]);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function deleteTask(Request $req, int $id){
        $com_info = Comisiones::find($id);

        $tasks = json_decode($com_info->com_tasks);

        $task2delete = (int) $req->tasks_id;

        $tasks = array_filter($tasks, function($key) use ($task2delete) {
            return $key != $task2delete;
        }, ARRAY_FILTER_USE_KEY);

        $tasks = array_values($tasks);

        $tasks = json_encode($tasks);

        $com_info->update(['com_tasks' => $tasks]);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }
}
