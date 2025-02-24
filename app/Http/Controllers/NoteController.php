<?php

namespace App\Http\Controllers;

use App\Models\Comisiones;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function addNote(int $id){
        $comision = Comisiones::findOrFail($id);

        return view('espacioTrabajo.notes.add-note', [
            'comision' => $comision
        ]);
    }

    public function addNoteProcess(Request $req, int $id){
        $com_info = Comisiones::find($id);

        $notes = json_decode($com_info->com_notes);

        $req->validate(
            [
                'note_title' =>'required | max:30 | min:5',
                'note_content' => 'required | max:150'
            ],
            [
                'note_title.required' => 'El título es requerido.',
                'note_title.max' => 'El título debe tener como maximo 30 caracteres.',
                'note_title.min' => 'El título debe tener como minimo 5 caracteres.',
                'note_content.required'=>'La nota es requerida.',
                'note_title.max' => 'La nota debe tener como maximo 150 caracteres.'
            ]
        );

        $arr = [];

        $arr = [
            'title'=> $req->note_title,
            'note'=> $req->note_content
        ];

        array_unshift($notes, $arr);

        $notes_final = json_encode($notes);

        $com_info->update(['com_notes' => $notes_final]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '3');
    }

    public function deleteNote(Request $req, int $id){
        $com_info = Comisiones::find($id);

        $notes = json_decode($com_info->com_notes);

        $note2delete = (int) $req->note_id;

        // dd($notes);

        $notes = array_filter($notes, function($key) use ($note2delete) {
            return $key != $note2delete;

        }, ARRAY_FILTER_USE_KEY);

        $notes = array_values($notes);

        $notes = json_encode($notes);

        $com_info->update(['com_notes' => $notes]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '3')->with('success.msg', 'La nota se elimino exitosamente.');
    }
}
