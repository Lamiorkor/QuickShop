<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickShop - Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login_and_register_view.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="../actions/register_action.php" name="SignUpForm" method="POST" id="SignUpForm">
                <label for="chk" aria-hidden="true">Sign Up</label>
                <input type="text" name ="name" placeholder="Enter Name" pattern="[A-Za-z ]+" required="">
                <input type="email" name ="email" placeholder="Enter email"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required="">
                <input type="password" id="password" name ="password" placeholder="Enter Password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required="">
                <input type="password" id="passwordRetype" name="passwordRetype" placeholder="Retype Password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required>
                <button type="submit" name="signup">Sign Up</button>
            </form>
        </div>

        <div class="login">
            <form action="../actions/login_action.php" name="LoginForm" method="POST" id="LoginForm">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name ="email" placeholder="Enter your email"  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required="">
                <input type="password" name ="password" placeholder="Enter your password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required="">
                <button type="submit" name="login" value="login">Login</button>
            </form>
        </div>

    </div>
</body>
</html>