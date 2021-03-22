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
            'task_id'   => $request->taskId,
            'date_limit'=> $request->dateLimit,
        ]);
        $donetask->fill([
            'is_done'   => !($donetask->is_done),
            ])->save();
        return response([
            'isDone'   => $donetask->is_done,
        ]);
    }
}
