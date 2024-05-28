<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- staff dashboard-->
    <h1>Staff</h1>

    <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <input type="submit" value="Logout">
                </form>
    
</body>
</html>