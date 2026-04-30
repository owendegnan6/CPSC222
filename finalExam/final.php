<?php
session_start();

echo "<h1>CPSC222 Final Exam</h1>";

$error = "";

/*
-------------------------
LOGIN CHECK
-------------------------
*/

if (isset($_POST['username'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $lines = file("auth.db");

    foreach ($lines as $line) {
        $parts = explode("\t", trim($line));

        if ($parts[0] == $user && $parts[1] == $pass) {
            $_SESSION['username'] = $user;
        }
    }

    if (!isset($_SESSION['username'])) {
        $error = "Invalid username or password";
    }
}

/*
-------------------------
IF NOT LOGGED IN
-------------------------
*/

if (!isset($_SESSION['username'])) {

    if ($error != "") {
        echo "<p style='color:red;'>$error</p>";
    }

    echo "<form method='post'>
    Username: <input type='text' name='username'><br>
    Password: <input type='password' name='password'><br>
    <input type='submit' value='Login'>
    </form>";

    echo "<hr>";
    echo date("Y-m-d h:i:s A");

    exit();
}

/*
-------------------------
LOGGED IN
-------------------------
*/

$user = $_SESSION['username'];

echo "<p>Welcome, $user! (<a href='final_logout.php'>Log Out</a>)</p>";

$page = "";

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

/*
-------------------------
DASHBOARD
-------------------------
*/

if ($page == "") {

    echo "<p>Dashboard options:</p>";
    echo "<ul>";
    echo "<li><a href='final.php?page=1'>User list</a></li>";
    echo "<li><a href='final.php?page=2'>Group list</a></li>";
    echo "<li><a href='final.php?page=3'>Syslog</a></li>";
    echo "</ul>";
}

/*
-------------------------
USER LIST
-------------------------
*/

elseif ($page == "1") {

    echo "<p><a href='final.php'>Back to Dashboard</a></p>";
    echo "<h3>User list</h3>";
    echo "<table border='1'>";

    $lines = file("/etc/passwd");

    foreach ($lines as $line) {
        $parts = explode(":", trim($line));

        echo "<tr>";
        foreach ($parts as $p) {
            echo "<td>$p</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

/*
-------------------------
GROUP LIST
-------------------------
*/

elseif ($page == "2") {

    echo "<p><a href='final.php'>Back to Dashboard</a></p>";
    echo "<h3>Group list</h3>";
    echo "<table border='1'>";

    $lines = file("/etc/group");

    foreach ($lines as $line) {
        $parts = explode(":", trim($line));

        echo "<tr>";
        foreach ($parts as $p) {
            echo "<td>$p</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

/*
-------------------------
SYSLOG
-------------------------
*/

elseif ($page == "3") {

    echo "<p><a href='final.php'>Back to Dashboard</a></p>";
    echo "<h3>Syslog</h3>";
    echo "<table border='1'>";

    $lines = @file("/var/log/syslog");

    if ($lines) {
        foreach ($lines as $line) {
            echo "<tr><td>$line</td></tr>";
        }
    } else {
        echo "<tr><td>Cannot read syslog</td></tr>";
    }

    echo "</table>";
}

/*
-------------------------
HIDDEN PAGE (EXTRA CREDIT)
-------------------------
*/

elseif ($page == "999") {

    echo "<p><a href='final.php'>Back to Dashboard</a></p>";
    echo "<h3>About the Author</h3>";

    echo "<p>My name is Owen Degnan. I am a student at Saint Francis University studying computer science. I enjoy coding, working out, and following sports. After college, I hope to pursue a career in software development or cybersecurity.</p>";

    echo "<p><img src='https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/Portrait_Placeholder.png/150px-Portrait_Placeholder.png'></p>";
}

/*
-------------------------
INVALID PAGE
-------------------------
*/

else {
    echo "<p><a href='final.php'>Back to Dashboard</a></p>";
    echo "<p>Invalid page</p>";
}

/*
-------------------------
FOOTER
-------------------------
*/

echo "<hr>";
echo date("Y-m-d h:i:s A");
?>
