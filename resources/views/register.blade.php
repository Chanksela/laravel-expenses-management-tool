<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <h1>Register Page</h1>
  <div>
    <form action="{{route('register.store')}}" method="post">
      @csrf
      <div>
        <label for="email">Email</label>
        <br>
        <input type="email" id="email" name="email" placeholder="Enter your email">
      </div>
       <div>
        <label for="password">Password</label>
        <br>
        <input type="password" id="password" name="password" placeholder="Enter your password">
      </div>
       <div>
        <label for="password_confirmation">Repeat Password</label>
        <br>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat the password">
      </div>
      <button type="submit">Register</button>
    </form>
  </div>
</body>
</html>