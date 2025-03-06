<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  <h1>Login Page</h1>

  <form action="{{route('login.authenticate')}}" method="post">
    @csrf
    <div>
      <label for="email">Email</label>
      <br>
      <input type="email" id="email" name="email" placeholder="Email">
       @if($errors->has('email'))
        <div style="color: red;">
          @foreach($errors->get('email') as $message)
            <p>{{ $message }}</p>
          @endforeach
        </div>
      @endif
    </div>
    <div>
      <label for="password">Password</label>
      <br>
      <input type="password" id="password" name="password" placeholder="Password">
    </div>
    <button type="submit">Login</button>
  </form>
  <p>Not a user? <a href="{{route('register.index')}}">Register here</a></p>

</body>
</html>