<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DoneTask;

class AxiosTasksController extends Controller
{
    public function post(Request $request) {
        $user_id = Auth::user()->id;
        // $donetask = new DoneTask();
        $test1 = $request->tasks_id;
        $donetask = DoneTask::firstOrNew([
            'user_id'  => $user_id,
            'tasks_id'  => $request->tasks_id,
            'date_limit'=> $request->date_limit,
        ]);
        $donetask->fill([
            // 'user_id'   => $user_id,
            // 'tasks_id'  => $request->tasks_id,
            // 'date_limit'=> $request->date_limit,
            'is_done'   => !($donetask->is_done),
            ])->save();
        return response("OK", 200);
    }
}
