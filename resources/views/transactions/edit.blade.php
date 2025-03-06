@extends('layouts.app')
@section('title', 'Edit Transactions')
@section('content')

    <h1>Edit Transaction</h1>

    <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" value="{{ old('description', $transaction->description) }}" required>
        
        <br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" value="{{ old('amount', $transaction->amount) }}" required>

        <br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="{{ old('date', $transaction->date) }}" required>

        <br>

        <label for="transaction_type">Type:</label>
        <select id="transaction_type" name="transaction_type">
            <option value="1" {{ $transaction->transaction_type == 1 ? 'selected' : '' }}>Income</option>
            <option value="2" {{ $transaction->transaction_type == 2 ? 'selected' : '' }}>Expense</option>
        </select>

        <br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <br>

        <button type="submit">Update Transaction</button>
    </form>

    <br>

    <a href="{{ route('transactions.index') }}">Back to Transactions</a>
@endsection
