<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions()
            ->with('category')
            ->orderBy('date', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = auth()->user()->categories;
        return view('transactions.create', compact('categories'));
    }

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

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) abort(403);
        
        $categories = auth()->user()->categories;
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) abort(403);

        $validated = $request->validate([
            'amount' => 'required|numeric',
            'description' => 'nullable|string|max:255',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) abort(403);

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}