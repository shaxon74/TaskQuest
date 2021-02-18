<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\DoneTask;

class AxiosTasksController extends Controller
{
    public function get(Request $request) {
        $tasks     = Task::UserIdEqual(Auth::user()->id)->get();
        $donetasks = DoneTask::UserIdEqual(Auth::user()->id)->with('task')->get();
        return response([
            'tasks' => $tasks,
            'donetasks' => $donetasks,
        ]);
    }

    public function post(Request $request) {
        $donetask = DoneTask::firstOrNew([
            'user_id'   => Auth::user()->id,
            'task_id'  => $request->tasks_id,
            'date_limit'=> $request->date_limit,
        ]);
        $donetask->fill([
            'is_done'   => !($donetask->is_done),
            ])->save();
        return response("OK", 200);
    }
}
