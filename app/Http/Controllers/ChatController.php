<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Ambil semua chat
    public function fetch()
    {
        // Pastikan reply_to_name dan reply_to_message ikut dikirim
        $chats = Chat::orderBy('created_at', 'asc')->get([
            'id', 'sender_name', 'sender_type', 'message', 'reply_to_name', 'reply_to_message', 'created_at'
        ]);

        return response()->json($chats);
    }

    // Simpan chat ke DB
    public function send(Request $request)
    {
        // Ambil JSON body
        $data = $request->json()->all(); // 🔹 gunakan ini jika fetch pakai JSON

        $request->validate([
            'message' => 'required|string'
        ]);

        $senderName = auth()->check() && auth()->user()->role === 'admin'
            ? auth()->user()->name
            : $data['sender_name'] ?? 'Guest';

        $senderType = auth()->check() && auth()->user()->role === 'admin' ? 'admin' : 'guest';

        Chat::create([
            'sender_name' => $senderName,
            'sender_type' => $senderType,
            'message' => $data['message'],
            'reply_to_name' => $data['reply_to_name'] ?? null,
            'reply_to_message' => $data['reply_to_message'] ?? null
        ]);

        return response()->json(['success' => true]);
    }

}
