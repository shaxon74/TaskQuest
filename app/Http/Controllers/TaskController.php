<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::where('user_id', Auth::user()->id)
                 ->orderBy('id', 'asc')
                 ->get();
        return view('task.index', ['tasks' => $tasks]);
    }
}
