<?php

namespace App\Http\Controllers;

use App\Models\Comissions;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function addNote(int $id){
        $comision = Comissions::findOrFail($id);

        return view('espacioTrabajo.notes.add-note', [
            'comision' => $comision
        ]);
    }

    public function addNoteProcess(Request $req, int $id){
        $com_info = Comissions::find($id);

        $notes = json_decode($com_info->com_notes);

        $req->validate(
            [
                'title' =>'required | max:30 | min:5',
                'note' => 'required | max:300'
            ],
            [
                'title.required' => 'El título es requerido.',
                'title.max' => 'El título debe tener como maximo 30 caracteres.',
                'title.min' => 'El título debe tener como minimo 5 caracteres.',
                ///////////
                'note.required'=>'La nota es requerida.',
                'note.max' => 'La nota debe tener como maximo 300 caracteres.'
            ]
        );

        $arr = [];

        $arr = [
            'title'=> $req->title,
            'note'=> $req->note
        ];

        array_unshift($notes, $arr);

        $notes_final = json_encode($notes);

        $com_info->update(['com_notes' => $notes_final]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '3');
    }

    public function editNote(Request $req, int $id){
        $com_info = Comissions::find($id);

        $notes = json_decode($com_info->com_notes);

        $noteID = $req->noteId;

        $note2edit = $notes[$noteID];

        return view('espacioTrabajo.notes.edit-note', [
            'comision' => $com_info,
            'noteId'   => $noteID,
            'noteDets' => $note2edit
        ]);
    }

    public function editNoteProcess(Request $req, int $id){
        $com_info = Comissions::find($id);

        $notes = json_decode($com_info->com_notes);

        $req->validate(
            [
                'title' => 'required | max:30 | min:5',
                'note'  => 'required | max:300'
            ],[
                'title.required' => 'El título es requerido.',
                'title.max' => 'El título debe tener como maximo 30 caracteres.',
                'title.min' => 'El título debe tener como minimo 5 caracteres.',
                //////////
                'note.required'=>'La nota es requerida.',
                'note.max' => 'La nota debe tener como maximo 300 caracteres.'
            ]
        );

        $notes[$req->noteId] = [
            'title' => $req->title,
            'note'  => $req->note
        ];

        $notes_final = json_encode($notes);

        $com_info->update(['com_notes' => $notes_final]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '3');
    }

    public function deleteNote(Request $req, int $id){
        $com_info = Comissions::find($id);

        $notes = json_decode($com_info->com_notes);

        $note2delete = (int) $req->note_id;

        $notes = array_filter($notes, function($key) use ($note2delete) {
            return $key != $note2delete;

        }, ARRAY_FILTER_USE_KEY);

        $notes = array_values($notes);

        $notes = json_encode($notes);

        $com_info->update(['com_notes' => $notes]);

        return redirect()->route('espacio.details', ['id'=>$id])->with('tabNum', '3')->with('success.msg', 'La nota se elimino exitosamente.');
    }
}
