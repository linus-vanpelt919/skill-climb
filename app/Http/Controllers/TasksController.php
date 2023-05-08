<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $task = new Task;
        $task->name = $request->input('name');
        $task->save();
        return response()->json($task);
    }

    public function show(Task $id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    public function update(Request $request, Task $task)
    {
        $task->name = $request->input('name');
        $task->save();
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
