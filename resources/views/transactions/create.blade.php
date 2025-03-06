<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Transaction</title>
</head>
<body>
    <h1>Add New Transaction</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('transactions.store')}}" method="POST">
        @csrf
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
        <br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" step="0.01" required>
        <br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <br>

        <label for="transaction_type">Transaction Type:</label>
        <select id="transaction_type" name="transaction_type" required>
            <option value="1">Income</option>
            <option value="2">Expense</option>
        </select>
        <br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <br>

        <button type="submit">Save Transaction</button>
    </form>

    <br>
    <a href="{{ route('transactions.index') }}">Back to Transactions</a>
</body>
</html>
