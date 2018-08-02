<!DOCTYPE html>
<head>
    <?php
    require_once("functions.php");
    session_start();
    if(isset($_SESSION['login'])){
        header('location: index.php');
    }
    ?>
    
    <title>CHPC Login</title>
</head>

<body>
    <fieldset class="login_field">
        <legend>Login below</legend>
        <form method="POST" action="loginhandler.php">
            <label>Username</label><br>
            <input type="text" name="username" id="username" class="username"><br><br>
            <label>Password</label><br>
            <input type="password" name="password" id="password" class="password"><br>
            <input type="submit" name="loginsubmit" id="loginsubmit" class="submit">
        </form>
    </fieldset>

</body>

