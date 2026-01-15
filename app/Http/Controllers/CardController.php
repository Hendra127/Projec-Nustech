<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100'
        ]);

        Card::create([
            'title' => $request->title
        ]);

        return redirect()->back()->with('success', 'Card berhasil dibuat');
    }
    public function destroy($id)
    {
        $card = Card::findOrFail($id);

        // 🔥 hapus semua project dalam card
        $card->newprojects()->delete();

        // 🔥 hapus card
        $card->delete();

        return response()->json([
            'success' => true,
            'message' => 'Card & seluruh data berhasil dihapus'
        ]);
    }
}
