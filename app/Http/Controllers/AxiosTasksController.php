<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DoneTask;

class AxiosTasksController extends Controller
{
    public function get(Request $request) {
        $data = [
            'user_id'    => Auth::user()->id,
            'tasks_id'   => $request->tasks_id,
            'date_limit' => $request->date_limit,
        ];
        return App\DoneTask::scopeUserTaskDateEqual($data)->get();
    }

    public function post(Request $request) {
        $donetask = DoneTask::firstOrNew([
            'user_id'   => Auth::user()->id,
            'tasks_id'  => $request->tasks_id,
            'date_limit'=> $request->date_limit,
        ]);
        $donetask->fill([
            'is_done'   => !($donetask->is_done),
            ])->save();
        return response("OK", 200);
    }
}
