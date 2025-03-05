<?php

namespace App\Http\Controllers;

use App\Models\Comisiones;
use App\Models\User;
use App\Models\Gallery;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function addPicture(int $id){
        $comision = Comisiones::findOrFail($id);

        return view('espacioTrabajo.gallery.add_picture', [
            'comision' => $comision
        ]);
    }

    public function addPictureProcess(int $id, Request $req){
        $com_id_fk = $id;

        $inputImgs = $req->pic_route;

        $req->validate(
            [
                'pic_route' => 'required',
                'pic_route.*'=>'mimes:png,jpg,jpeg | max:2048'
            ],
            [
                'pic_route.required'=>'La imagen es requerida.',
                'pic_route.*.mimes'=>'La imagen debe ser de tipo png, jpg o jpeg.',
                'pic_route.*.max'=>'La imagen debe ser como maximo 2MB.'
            ]
        );

        foreach($inputImgs as $image){
            $path = $image->store('gallery', 'public');

            $gallery = new Gallery;
                $gallery->pic_route = $path;
                $gallery->com_id_fk = $com_id_fk;
            $gallery->save();
        }

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '4');
    }
}
