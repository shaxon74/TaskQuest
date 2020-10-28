<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;

class UserController extends Controller
{
    public function index() {

        $tasks = Task::where('user_id', Auth::user()->id)
                ->orderBy('id', 'asc')
                ->get();
        return view('user.index', ['tasks' => $tasks]);
    }
}
