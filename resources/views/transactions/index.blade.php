<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
</head>
<body>
  <h1>Dashboard</h1>
  <p>Hello, {{ Auth::user()->first_name}}</p>

  <form action="{{route('login.logout')}}" method="post">
    @csrf
    <button type="submit">Logout</button>
  </form>

  <a href="{{route('transactions.create')}}">Add new expense</a>


    <h1>My Transactions</h1>

    <form method="GET" action="{{ route('transactions.index') }}">
        <select name="category_id" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $categoryId ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>

    
    <div class="summary">
        <p><strong>Total Income:</strong> <span class="income">${{ number_format($totalIncome, 2) }}</span></p>
        <p><strong>Total Expenses:</strong> <span class="expenses">${{ number_format($totalExpense, 2) }}</span></p>
        <p><strong>Remaining Balance:</strong> <span class="balance">${{ number_format($balance, 2) }}</span></p>
    </div>

    @if ($transactions->isEmpty())
        <p>No transactions found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>${{ number_format($transaction->amount, 2) }}</td>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->transaction_type == 1 ? 'Income' : 'Expense' }}</td>
                        <td>{{ $transaction->category->name ?? 'N/A' }}</td>
                        <td><a href="{{ route('transactions.edit', $transaction->id) }}">Edit</a></td>
                        <td>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
  
</body>
</html>
