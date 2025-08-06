<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Hanya ambil task milik user yang login
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('todolist', compact('tasks'));
    }

    public function store(Request $request)
    {
        try {
            Task::create([
                'title' => $request->title,
                'status' => 'todo',
                'user_id' => Auth::id(), // Simpan ID user yang membuat
            ]);
            return redirect()->back()->with('success', 'Task berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan task.');
        }
    }

    public function move(Request $request, $id)
    {
        // Hanya ubah task milik user login
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->status = $request->status;
        $task->save();
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        // Hanya update task milik user login
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->title = $request->title;
        $task->save();
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        // Hanya hapus task milik user login
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->delete();
        return response()->json(['success' => true]);
    }
}
