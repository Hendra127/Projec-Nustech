<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('todolist', compact('tasks'));
    }

    public function store(Request $request)
    {
        try {
            Task::create([
                'title' => $request->title,
                'status' => 'todo'
            ]);
            return redirect()->back()->with('success', 'Task berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan task.');
        }
    }

    public function move(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $request->status;
        $task->save();
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['success' => true]);
    }
}
