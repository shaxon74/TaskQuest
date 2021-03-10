<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::UserIdEqual( Auth::user()->id)
                 ->get();
        return view('task.index', ['tasks' => $tasks]);
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
