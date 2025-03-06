<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
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

    public function store(TransactionRequest $request){
        auth()->user()->transactions()->create($request->validated());

        return redirect()->route('transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $transaction->update($request->validated());

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
