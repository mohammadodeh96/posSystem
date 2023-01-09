<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../resources/css/login_styles.css">
    <title>Login</title>
</head>

<body id="login-body">
    <main>
        <div id="container-div">

            <h1 id="login">Login</h1>
            <h3 id="pos">Point Of Sales</h3>
            <form method="POST" action="/authenticate">

                <?php if (!empty($_SESSION) && isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                    <div id="alert-box" role='alert'>
                        <?= $_SESSION['error'] ?>
                    </div>
                <?php
                    $_SESSION['error'] = null;
                endif; ?>

                <div>
                    <label for="admin-username""></label>
        <span id=" input-span">Username</span>
                        <span id="star">*</span>
                        <input type="text" id="admin-username" name="username" required>
                </div>
                <div>
                    <label for="admin-password"></label>
                    <span id="input-span">Password</span>
                    <span id="star">*</span>
                    <input type="password" id="admin-username" name="password" required>
                </div>
                <div>
                    <input type="checkbox" id="remember-me" name="remember_me">
                    <label id="remember-me-text" for="remember-me">Remember Me</label>
                </div>
                <button id="form-submit" type="submit">Login</button>
            </form>
        </div>
    </main>
</body>

</html>