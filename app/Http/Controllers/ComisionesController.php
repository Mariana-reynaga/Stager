<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comisiones;
use Illuminate\Support\Facades\DB;

class ComisionesController extends Controller
{
    // Traigo todas las comms incompletas
    public function workSpace(){
        $allIncomplete = DB::table('comisiones')->where('is_complete', false)->get();

        return view('workspace.index', [
            'all_comisiones' => $allIncomplete
        ]);
    }

    // Traer Comisiones Completas
    public function completedWorkspace(){
        $allComplete = DB::table('comisiones')->where('is_complete', true)->get();

        return view('workspace.completed-index', [
            'all_comisiones'=>$allComplete
        ]);
    }

    // Subir Comisión
    public function crearComision(){
        return view('workspace.createCommForm',);
    }

    public function processNewComision(Request $req){
        $req->validate([
            'comm_title'=> 'required | max:30 | min:5',
            'comm_short_desc'=> 'required | min:10 | max:150 ',
            'comm_client_social'=> 'required',
            'comm_client'=> 'required | max:100',
            'due_date'=> 'after_or_equal:tomorrow',
        ],[
            'comm_title.required' => 'La comisión necesita un titulo.',
            'comm_title.max' => 'El titulo debe tener como máximo 30 caracteres.',
            'comm_title.min' => 'El titulo debe tener como minimo 5 caracteres.',
            //
            'comm_short_desc.required'=> 'La comisión necesita una descripción.',
            'comm_short_desc.min'=> 'La descripción debe tener como minimo 10 caracteres.',
            'comm_short_desc.max'=> 'La descripción debe tener como máximo 150 caracteres.',
            //
            'comm_client_social.required'=>'Es requerido elegir un metodo de contacto.',
            //
            'comm_client.required'=>'Es requerido un nombre de usuario del cliente.',
            'comm_client.max' => 'El usuario debe tener como máximo 100 caracteres.',
            //
            'due_date.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.'
        ]);

        $input = $req->all([]);

        $comission = Comisiones::create($input);

        return redirect()
            ->route('workspace');
    }
}
