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
        // dd($request->all());
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->category_id = 4;
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
        $task->title = $request->title;
        $task->description = $request->description;
        $task->save();
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
