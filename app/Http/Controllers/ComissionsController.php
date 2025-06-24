<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comissions;
use App\Models\PaymentMethod;
use App\Models\SocialMedia;
use App\Models\User;
use App\Models\Gallery;
use App\Models\PaymentCurrency;

use Illuminate\Support\Facades\Storage;
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
        $currency = PaymentCurrency::all();

        return view('espacioTrabajo.create-com',[
            'social_media'=> $social_media,
            'metodos_pagos' => $metodos_pagos,
            'currency' => $currency
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
                'currency_id_fk'=> 'required',
                'com_price' =>'required | integer | min:1',
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
                'currency_id_fk.required'=> 'La comisión necesita una moneda.',
                //
                'com_price.required'=> 'La comisión necesita un precio.',
                'com_price.min'=> 'La comisión no puede costar 0.',
                //
                'payment_fk.required'=>'La comisión necesita un método de pago.',
                //
                'com_tasks.required'=>'Las tareas no pueden estar vacias.'
            ]
        );

        $comision = new Comissions();
            $comision->user_id_fk           = auth()->user()->user_id;
            $comision->com_title            = $req->com_title;
            $comision->com_description      = $req->com_description;
            $comision->social_fk            = $req->social_fk;
            $comision->payment_fk           = $req->payment_fk;
            $comision->currency_id_fk       = $req->currency_id_fk;
            $comision->com_price            = $req->com_price;
            $comision->com_client           = $req->com_client;
            $comision->com_due              = $req->com_due;
            $comision->com_tasks            = $task_final;
            $comision->is_complete          = false;
        $comision->save();

        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
    }

    public function editComision(int $id){
        $social_media = SocialMedia::all();
        $metodos_pagos = PaymentMethod::all();
        $comision = Comissions::findOrFail($id);
        $currency = PaymentCurrency::all();

        return view('espacioTrabajo.edit-com',[
            'comision'=> $comision,
            'social_media'=> $social_media,
            'metodos_pagos' => $metodos_pagos,
            'currency' => $currency
        ]);
    }

    public function editComisionProcess(int $id, Request $req){
        $req->validate(
            [
                'com_title' => 'required | max:30 | min:5',
                'com_description'=>'required | max:150 | min:10',
                'social_fk'=>'required',
                'com_client'=>'required | max:30',
                'com_due'=>'required | after_or_equal:'.now()->format('Y-m-d'),
                'currency_id_fk'=> 'required',
                'com_price' =>'required | integer | min:1',
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
                'social_fk.required'=>'La comisión necesita un método de contacto.',
                //
                'com_client.required'=>'La comisión necesita el usuario del cliente.',
                'com_client.max' => 'El usuario debe tener como máximo 30 caracteres.',
                //
                'com_due.required'=> 'La comisión necesita una fecha de entrega.',
                'com_due.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.',
                //
                'currency_id_fk.required'=> 'La comisión necesita una moneda.',
                //
                'com_price.required'=> 'La comisión necesita un precio.',
                'com_price.min'=> 'La comisión no puede costar 0.',
                //
                'payment_fk.required'=>'La comisión necesita un método de pago.',
            ]
        );

        $input = $req->except('_token', '_method');

        $comision = Comissions::findOrFail($id);

        $comision->update($input);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function uploadReciept(int $id){
        $comision_dets = Comissions::find($id);

        return view('espacioTrabajo.reciept.upload_reciept', ['comision'=> $comision_dets]);
    }

    public function uploadRecieptProcess(int $id, Request $req){
        $comision = Comissions::findOrFail($id);

        $req->validate(
            [
                'com_reciept' => 'required',
                'com_reciept.*'=>'mimes:pdf,jpg,png | max:2048'
            ],
            [
                'com_reciept.required'=>'El recibo es requerido.',
                'com_reciept.*.mimes'=>'El recibo debe ser de tipo pdf, png o jpg.',
                'com_reciept.*.max'=>'El recibo debe ser como maximo 2MB.'
            ]
        );

        $reciept = $req->com_reciept;

        if ($comision->com_reciept != null) {
            Storage::disk('public')->delete($comision->com_reciept);

            $path = $reciept->store('reciepts', 'public');

            $comision->update(['com_reciept'=>$path]);

        }else{
            $path = $reciept->store('reciepts', 'public');

            $comision->update(['com_reciept'=>$path, 'is_payed'=>true]);
        }

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function downloadReciept(int $id){
        $comision = Comissions::findOrFail($id);

        return Storage::disk('public')->download($comision->com_reciept);
    }

    public function deleteReciept(int $id){
        $comision = Comissions::findOrFail($id);

        Storage::disk('public')->delete($comision->com_reciept);

        $comision->update(['com_reciept'=>null, 'is_payed'=>false]);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function completeComisionProcess(int $id){
        $comision = Comissions::findOrFail($id);

        // $tasks = json_decode($comision->com_tasks);

        // foreach($tasks as $key => $item){
        //     $tasks[$key] = [
        //         'task' => $item->task,
        //         'is_complete' => true
        //     ];
        // }
                                        // 'com_tasks' => json_encode($tasks)
        $comision->update(['is_complete'=>true, 'com_percent'=>100]);

        return redirect()->route('espacio.completas', ['user_id'=>auth()->user()->user_id]);
    }

    public function incompleteComissionProcess(int $id){
        $comision = Comissions::findOrFail($id);

        $task_completed = 0;

        $tasks = json_decode($comision->com_tasks);

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

        $comision->update(['is_complete'=>false, 'com_percent'=>$percent]);
        
        return redirect()->route('espacio.trabajo', ['user_id'=>auth()->user()->user_id]);
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

}
