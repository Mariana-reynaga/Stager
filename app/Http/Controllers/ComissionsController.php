<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comissions;
use App\Models\PaymentMethod;
use App\Models\SocialMedia;
use App\Models\User;
use App\Models\Gallery;

use Illuminate\Support\Str;

class ComissionsController extends Controller
{
    public function workspace(int $user_id){
        $user = User::find($user_id);

        $user_id = $user->user_id;

        $incompletas = Comissions::all()->where('user_id_fk', $user_id )->where('is_complete', false)->sortBy('com_due');

        return view('espacioTrabajo.index',[
            'coms_incompletas' => $incompletas,
            'user' => $user
        ]);
    }

    public function workspaceComplete(int $user_id){
        $user = User::find($user_id);

        $user_id = $user->user_id;

        $completas = Comissions::all()->where('user_id_fk', $user_id )->where('is_complete', true);

        return view('espacioTrabajo.coms-completas', [
            'coms_completas' => $completas,
            'user' => $user
        ]);
    }

    public function comisionDetail(int $id){
        $comision_dets = Comissions::find($id);

        // dd($comision_dets);

        $tasks = json_decode($comision_dets->com_tasks);

        $notes = json_decode($comision_dets->com_notes);

        $gallery_imgs = Gallery::all()->where('com_id_fk', $id);

        return view('espacioTrabajo.coms-detalles', [
            'comision'=> $comision_dets,
            'tareas'  => $tasks,
            'notas'   => $notes,
            'gallery' => $gallery_imgs
        ]);
    }

    public function createComision(){
        $social_media = SocialMedia::all();
        $metodos_pagos = PaymentMethod::all();

        return view('espacioTrabajo.create-com',[
            'social_media'=> $social_media,
            'metodos_pagos' => $metodos_pagos
        ]);
    }

    public function createComisionProcess(Request $req){
        $tasks_array = [];

        $task = collect(explode(', ' , $req->com_tasks ) );

        foreach( $task as $item ){
            $tasks_array[] = [
                'task' => $item,
                'is_complete' => false
            ];
        }

        $task_final = Str::replace('" ', '"', json_encode($tasks_array) );

        $req->validate(
            [
                'com_title' => 'required | max:30 | min:5',
                'com_description'=>'required | max:150 | min:10',
                'social_fk'=>'required',
                'com_client'=>'required | max:30',
                'com_due'=>'required | after_or_equal:'.now()->format('Y-m-d'),
                'payment_fk'=>'required',
                'com_tasks'=>'required'
            ], #mensajes de error
            [
                'com_title.required'=>'La comisión necesita un título.',
                'com_title.max'=>'El título debe tener como máximo 30 caracteres.',
                'com_title.min' => 'El título debe tener como minimo 5 caracteres.',
                //
                'com_description.required'=>'La comisión necesita una descripción.',
                'com_description.max'=> 'La descripción debe tener como máximo 150 caracteres.',
                'com_description.min'=> 'La descripción debe tener como minimo 10 caracteres.',
                //
                'social_fk.required'=>'La comisión necesita un método de contacto.',
                //
                'com_client.required'=>'La comisión necesita el usuario del cliente.',
                'com_client.max' => 'El usuario debe tener como máximo 30 caracteres.',
                //
                'com_due.required'=> 'La comisión necesita una fecha de entrega.',
                'com_due.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.',
                //
                'payment_fk.required'=>'La comisión necesita un método de pago.',
                //
                'com_tasks.required'=>'Las tareas no pueden estar vacias.'
            ]
        );

        $comision = new Comissions();
            $comision->user_id_fk       = auth()->user()->user_id;
            $comision->com_title        = $req->com_title;
            $comision->com_description  = $req->com_description;
            $comision->social_fk        = $req->social_fk;
            $comision->payment_fk         = $req->payment_fk;
            $comision->com_client       = $req->com_client;
            $comision->com_due      = $req->com_due;
            $comision->com_tasks        = $task_final;
            $comision->is_complete      = false;

        $comision->save();

        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
    }

    public function editComision(int $id){
        $social_media = SocialMedia::all();
        $metodos_pagos = PaymentMethod::all();
        $comision = Comissions::findOrFail($id);

        return view('espacioTrabajo.edit-com',[
            'comision'=> $comision,
            'social_media'=> $social_media,
            'metodos_pagos' => $metodos_pagos
        ]);
    }

    public function editComisionProcess(int $id, Request $req){
        $req->validate(
            [
                'com_title' => 'required | max:30 | min:5',
                'com_description'=>'required | max:150 | min:10',
                'social_fk'=>'required',
                'com_client'=>'required | max:30',
                'com_due'=>'after_or_equal:'.now()->format('Y-m-d'),
                'payment_fk'=>'required'
            ], #mensajes de error
            [
                'com_title.required'=>'La comisión necesita un título.',
                'com_title.max'=>'El título debe tener como máximo 30 caracteres.',
                'com_title.min' => 'El título debe tener como minimo 5 caracteres.',
                //
                'com_description.required'=>'La comisión necesita una descripción.',
                'com_description.max'=> 'La descripción debe tener como máximo 150 caracteres.',
                'com_description.min'=> 'La descripción debe tener como minimo 10 caracteres.',
                //
                'social_fk.required'=>'Es requerido elegir un metodo de contacto.',
                //
                'com_client.required'=>'Es requerido un nombre de usuario del cliente.',
                'com_client.max' => 'El usuario debe tener como máximo 30 caracteres.',
                //
                'com_due.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.',
                //
                'payment_fk.required'=>'Se tiene que elegir un metodo de pago'
            ]
        );

        $input = $req->except('_token', '_method');

        $comision = Comissions::findOrFail($id);

        $comision->update($input);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function completeComisionProcess(Request $req, int $id){

        $comision = Comissions::findOrFail($id);

        $tasks = json_decode($comision->com_tasks);

        foreach($tasks as $key => $item){
            $tasks[$key] = [
                'task' => $item->task,
                'is_complete' => true
            ];
        }

        $comision->update(['is_complete'=>true, 'com_tasks' => json_encode($tasks), 'com_percent'=>100]);

        return redirect()->route('espacio.completas', ['user_id'=>auth()->user()->user_id]);
    }

    public function deleteComision(int $id){
        $comision = Comissions::findOrFail($id);

        $photos = Gallery::all()->where('com_id_fk', $id);

        foreach($photos as $item){
            $picture = Gallery::findOrFail($item->pic_id);
            $picture->delete($item->pic_id);
        }

        $comision->delete($comision);

        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
    }

    public function comisionDetails(){
        return view('espacioTrabajo.coms-detalles',);
    }
}
