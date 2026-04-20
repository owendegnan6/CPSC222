<?php
session_start();

function sanitize($str)
{
    return preg_replace('/[^a-zA-Z0-9]/', '', $str);
}

if (isset($_GET['logout']))
{
    session_destroy();
    header("Location: ch13.php");
    exit();
}

$error = "";

if (isset($_POST['username']) && isset($_POST['password']))
{
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    if ($username == "admin" && $password == "password")
    {
        $_SESSION['username'] = $username;
    }
    else
    {
        $error = "Invalid login...";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php
if (isset($_SESSION['username']))
{
    echo "<h1>Hello, " . $_SESSION['username'] . "</h1>";
    echo "<a href='?logout=true'>Logout</a>";
}
else
{
    if ($error != "")
    {
        echo "<p>$error</p>";
    }
?>

<form method="post" action="">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>

<?php
}
?>

</body>
</html>
