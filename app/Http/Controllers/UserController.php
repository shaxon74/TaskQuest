<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Task;

class UserController extends Controller
{
    public function index() {

        $tasks = Task::UserIdEqual(Auth::user()->id)
                ->get();
        return view('user.index', ['tasks' => $tasks]);
    }
}
