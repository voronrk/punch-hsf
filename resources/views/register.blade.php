<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="name" name="name" placeholder="User name">
        <input type="password" name="password" placeholder="Password">
        <input type="number" name="role_id" placeholder="Роль">
        <button type="submit">Login</button>
    </form>
</body>
</html>