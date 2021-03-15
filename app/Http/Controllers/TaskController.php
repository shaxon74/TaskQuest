<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\DoneTask;

class TaskController extends Controller
{
    public function get(Request $request) {
        $req   = $request->reqDoneTasks;
        $tasks = Task::UserIdEqual(Auth::user()->id)->get();
        if ($req == 'true') {
            $donetasks = DoneTask::UserIdEqual(Auth::user()->id)
            ->DatelimitThanToday()->get();
            $response = [
                'tasks' => $tasks,
                'donetasks' => $donetasks,
            ];
        } else {
            $response = [
                'tasks' => $tasks,
            ];
        }

        return $response;
    }

    public function create(Request $request) {
        $task = new Task();
        $form = $request->all();
        $form['user_id'] = Auth::user()->id;
        unset($form['_token']);
        $task->fill($form)->save();
        return response([
            'message'   => 'Add task >> [' . $task->name . ']',
        ]);
    }
}
