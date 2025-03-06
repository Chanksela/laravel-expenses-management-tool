<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $transactions = $user->transactions()->where('category_id', $categoryId)->get();
        } else {
            $transactions = $user->transactions;
        }

        $totalIncome = $transactions->where('transaction_type', 1)->sum('amount');
        $totalExpense = $transactions->where('transaction_type', 2)->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $categories = Category::all();
        

        return view('transactions.index', compact('categories', 'categoryId', 'transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function create(){
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'transaction_type' => 'required|in:1,2',
        ]);

        auth()->user()->transactions()->create($request->all());

        return redirect()->route('transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'transaction_type' => 'required|in:1,2',
            'category_id' => 'required|exists:categories,id',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = auth()->user()->transactions()->find($id);

        if (!$transaction) {
            return redirect()->route('transactions.index')->with('error', 'Transaction not found!');
        }

        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }

}
