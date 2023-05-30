<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class UserController extends Controller
{
    public function myPage()
{
        $tasks = Task::with('category')->orderBy('category_id')->get();
        return response()->json(['tasks' => $tasks]);
}
}
