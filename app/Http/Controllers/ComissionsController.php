<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comissions;
use App\Models\PaymentMethod;
use App\Models\SocialMedia;
use App\Models\User;
use App\Models\Gallery;
use App\Models\PaymentCurrency;

use App\Http\Requests\ComissionRules;
use App\Http\Requests\ImageRules;
use App\Actions\TaskActions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use DateTime;

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

        $is_Passed = $comision_dets->com_due < new DateTime('now');

        return view('espacioTrabajo.coms-detalles', [
            'comision'=> $comision_dets,
            'is_Passed' => $is_Passed,
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

    public function createComisionProcess(ComissionRules $req){
        $tasks_array = [];

        $task = collect(explode(', ' , $req->com_tasks ) );

        foreach( $task as $item ){
            $tasks_array[] = [
                'task' => $item,
                'is_complete' => false
            ];
        }

        $task_final = Str::replace('" ', '"', json_encode($tasks_array) );

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

    public function editComisionProcess(int $id, ComissionRules $req){
        $input = $req->except('_token', '_method');

        $comision = Comissions::findOrFail($id);

        $comision->update($input);

        return redirect()->route('espacio.details', ['id'=>$id]);
    }

    public function uploadReciept(int $id){
        $comision_dets = Comissions::find($id);

        return view('espacioTrabajo.reciept.upload_reciept', ['comision'=> $comision_dets]);
    }

    public function uploadRecieptProcess(int $id, ImageRules $req){
        $comision = Comissions::findOrFail($id);

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

        $comision->update(['is_complete'=>true, 'com_percent'=>100]);

        return redirect()->route('espacio.completas', ['user_id'=>auth()->user()->user_id]);
    }

    public function incompleteComissionProcess(int $id){
        $comision = Comissions::find($id);

        $action = new TaskActions;

        $percent = $action->updatePercent($id);

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
