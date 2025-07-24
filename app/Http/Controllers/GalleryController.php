<?php

namespace App\Http\Controllers;

use App\Models\Comissions;
use App\Models\User;
use App\Models\Gallery;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\ImageRules;

class GalleryController extends Controller
{
    public function addPicture(int $id){
        $comision = Comissions::findOrFail($id);

        return view('espacioTrabajo.gallery.add_picture', [
            'comision' => $comision
        ]);
    }

    public function addPictureProcess(int $id, ImageRules $req){
        $com_id_fk = $id;

        $inputImgs = $req->pic_route;

        foreach($inputImgs as $image){
            $path = $image->store('gallery', 'public');

            $gallery = new Gallery;
                $gallery->pic_route = $path;
                $gallery->com_id_fk = $com_id_fk;
            $gallery->save();
        }

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '4');
    }

    public function deletePicture(Request $req, int $id){
        $pic_id = $req->pic_id;

        $image = Gallery::findOrFail($pic_id);

        $image->delete($image);

        Storage::disk('public')->delete($image->pic_route);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '4')->with('success.msg', 'La Imagen se elimino exitosamente.');
    }
}
