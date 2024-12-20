<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comisiones;
use App\Models\MetodoPago;
use App\Models\RedesSociales;


class ComisionesController extends Controller
{
    public function workspace(){
        $incompletas = Comisiones::all()->where('is_complete', false)->sortBy('com_entrega');

        return view('espacioTrabajo.index',[
            'coms_incompletas' => $incompletas
        ]);
    }

    public function workspaceComplete(){
        $completas = Comisiones::all()->where('is_complete', true);

        return view('espacioTrabajo.coms-completas', [
            'coms_completas' => $completas
        ]);
    }

    public function comisionDetail(int $id){
        $comision_dets = Comisiones::find($id);

        return view('espacioTrabajo.coms-detalles', [
            'comision'=> $comision_dets
        ]);
    }

    public function createComision(){
        $redes_sociales = RedesSociales::all();
        $metodos_pagos = MetodoPago::all();

        return view('espacioTrabajo.create-com',[
            'redes_sociales'=> $redes_sociales,
            'metodos_pagos' => $metodos_pagos
        ]);
    }

    public function createComisionProcess(Request $req){
        $req->validate(
            [
                'com_title' => 'required | max:30 | min:5',
                'com_description'=>'required | max:150 | min:10',
                'social_fk'=>'required',
                'com_client'=>'required | max:30',
                'com_entrega'=>'after_or_equal:tomorrow',
                'pagos_fk'=>'required'
            ], #mensajes de error
            [
                'com_title.required'=>'La comisión necesita un titulo.',
                'com_title.max'=>'El titulo debe tener como máximo 30 caracteres.',
                'com_title.min' => 'El titulo debe tener como minimo 5 caracteres.',
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
                'com_entrega.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.',
                //
                'pagos_fk.required'=>'Se tiene que elegir un metodo de pago'
            ]
        );

        $input= $req->all([]);

        $comision = Comisiones::create($input);

        return redirect()->route('espacio.trabajo');
    }

    public function editComision(int $id){
        $redes_sociales = RedesSociales::all();
        $metodos_pagos = MetodoPago::all();
        $comision = Comisiones::findOrFail($id);

        return view('espacioTrabajo.edit-com',[
            'comision'=> $comision,
            'redes_sociales'=> $redes_sociales,
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
                'com_entrega'=>'after_or_equal:tomorrow',
                'pagos_fk'=>'required'
            ], #mensajes de error
            [
                'com_title.required'=>'La comisión necesita un titulo.',
                'com_title.max'=>'El titulo debe tener como máximo 30 caracteres.',
                'com_title.min' => 'El titulo debe tener como minimo 5 caracteres.',
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
                'com_entrega.after_or_equal'=> 'La fecha de entrega no puede ser antes de hoy.',
                //
                'pagos_fk.required'=>'Se tiene que elegir un metodo de pago'
            ]
        );

        $input = $req->except('_token', '_method');

        $comision = Comisiones::findOrFail($id);

        $comision->update($input);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function completeComisionProcess(Request $req, int $id){

        $comision = Comisiones::findOrFail($id);

        $comision->update(['is_complete'=>true]);

        return redirect()->route('espacio.completas');
    }

    public function deleteComision(int $id){
        $comision = Comisiones::findOrFail($id);

        $comision->delete($comision);

        return redirect()->route('espacio.trabajo');
    }

    public function comisionDetails(){
        return view('espacioTrabajo.coms-detalles');
    }
}
