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

    public function crearComision(){
        return view('workspace.createCommForm');
    }

    public function processNewComision(Request $req){
        $req->validate([
            'comm_title'=> 'required | max:50 | min:10',
            'comm_short_desc'=> 'required | min:10 | max:150 ',
            'comm_client_social'=> 'required',
            'comm_client'=> 'required | max:100',
            'due_date'=> 'after_or_equal:tomorrow',
        ]);

        $input = $req->all([]);

        $comission = Comisiones::create($input);

        return redirect()
            ->route('workspace');
    }
}
