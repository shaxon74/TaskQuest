<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DoneTask;

class DoneTaskController extends Controller
{

    public function post(Request $request) {
        $donetask = DoneTask::firstOrNew([
            'user_id'   => Auth::user()->id,
            'task_id'   => $request->tasks_id,
            'date_limit'=> $request->date_limit,
        ]);
        $donetask->fill([
            'is_done'   => !($donetask->is_done),
            ])->save();
        return response([
            'is_done'   => $donetask->is_done,
        ]);
    }
}
