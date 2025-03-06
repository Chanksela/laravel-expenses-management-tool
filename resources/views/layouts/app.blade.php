<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expenses Manager - @yield('title')</title>
  <style>
    nav {
    padding: 10px;
    }
    nav div{
      display: flex;
      align-items: center;
    }
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: space-between;
    }

    nav li {
      margin: 0 10px;
    }

    nav a {
      color: black;
      text-decoration: none;
      font-weight: bold;
      padding: 5px 10px;
    }

    nav a:hover {
      background-color: #555;
      border-radius: 5px;
      color:white
    }

    nav form button {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }

    nav form button:hover {
      background-color: #d32f2f;
      border-radius: 5px;
    }

    nav p {
      margin: 0;
    }
    </style>
</head>
<body>
  <nav>
    <ul>
      <div>
        <li><a href="{{route('transactions.index')}}">Transactions</a></li>
        <li> <a href="{{route('transactions.create')}}">Add new expense</a></li>
      </div>

      <div>
        <li><p>Hello, {{ Auth::user()->first_name}}</p></li>
        <li>  
          <form action="{{route('login.logout')}}" method="post">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>
      </div>

    </ul>
  </nav>
  <main>
    @yield('content')
  </main>
</body>
</html>