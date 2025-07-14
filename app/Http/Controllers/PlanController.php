<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use App\Models\User;

use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function selectPlan(){
        $plans = Plans::all();

        return view('plan.select_plan', [
            'plans' => $plans
        ]);
    }
}
