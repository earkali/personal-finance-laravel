<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Tüm işlemleri listele.
     */
    public function index()
    {
        $transactions = auth()->user()->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Yeni işlem oluşturma formunu göster.
     */
    public function create()
    {
        $categories = auth()->user()->categories;
        
        return view('transactions.create', compact('categories'));
    }

    /**
     * Yeni işlemi veritabanına kaydet.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
        ]);

        auth()->user()->transactions()->create($validated);

        return redirect()->route('transactions.index')->with('success', 'İşlem başarıyla eklendi.');
    }

    /**
     * İşlemi sil.
     */
    public function destroy(Transaction $transaction)
    {
        // Güvenlik kontrolü
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'İşlem silindi.');
    }
}