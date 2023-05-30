<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        // $tasks = Task::with('category')->get();
        $tasks = Task::all();
        $categories = Category::all();
        return response()->json(['tasks' => $tasks, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
         // 入力検証を追加
         $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|integer',
        ]);

        $task = new Task;
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->category_id = $validatedData['category_id'];
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
        // 入力検証を追加
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            // 'category_id' => 'required|integer',
        ]);

        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        // $task->category_id = $validatedData['category_id'];
        $task->category_id = $task->category_id;
        $task->save();
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
