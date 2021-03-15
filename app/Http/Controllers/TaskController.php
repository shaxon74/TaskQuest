<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\DoneTask;

class TaskController extends Controller
{
    public function get(Request $request) {
        $tasks     = Task::UserIdEqual(Auth::user()->id)->get();
        $donetasks = DoneTask::UserIdEqual(Auth::user()->id)
                     ->DatelimitThanToday()->get();
        return response([
            'tasks' => $tasks,
            'donetasks' => $donetasks,
        ]);
    }

    public function create(Request $request) {
        $task = new Task();
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;
        unset($form['_token']);
        $task->fill($form)->save();
        return response([
            'message'   => 'add' . $task->name . '!',
        ]);
    }
}
