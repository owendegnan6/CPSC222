<?php
session_start();

$error = "";

/*
========================================
AUTHENTICATION
========================================
*/

function read_auth_file() {
    $users = [];

    if (file_exists("auth.db")) {
        $lines = file("auth.db", FILE_IGNORE_NEW_LINES);

        foreach ($lines as $line) {
            $parts = explode("\t", trim($line));

            if (count($parts) == 2) {
                $users[$parts[0]] = $parts[1];
            }
        }
    }

    return $users;
}

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $users = read_auth_file();

    if (isset($users[$username]) && $users[$username] == $password) {
        $_SESSION['username'] = $username;
        header("Location: final.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}

/*
========================================
HEADER + FOOTER
========================================
*/

function page_header() {
    echo "<h1>CPSC222 Final Exam</h1>";
}

function page_footer() {
    echo "<hr>";
    echo date("Y-m-d h:i:s A");
}

/*
========================================
LOGIN PAGE
========================================
*/

if (!isset($_SESSION['username'])) {
    page_header();

    if ($error != "") {
        echo "<p style='color:red;'>$error</p>";
    }

    echo "
    <form method='post'>
        Username: <input type='text' name='username'><br>
        Password: <input type='password' name='password'><br>
        <input type='submit' name='login' value='Login'>
    </form>
    ";

    page_footer();
    exit();
}

$username = $_SESSION['username'];
$page = isset($_GET['page']) ? $_GET['page'] : "";

/*
========================================
DASHBOARD
========================================
*/

if ($page == "") {
    page_header();

    echo "<h3>Welcome, $username! 
    (<a href='final_logout.php'>Log Out</a>)</h3>";

    echo "<p>Dashboard:</p>";
    echo "<ul>";
    echo "<li><a href='final.php?page=1'>User list</a></li>";
    echo "<li><a href='final.php?page=2'>Group list</a></li>";
    echo "<li><a href='final.php?page=3'>Syslog</a></li>";
    echo "</ul>";

    page_footer();
    exit();
}

/*
========================================
REPORT PAGES
========================================
*/

page_header();

echo "<h3>Welcome, $username! 
(<a href='final_logout.php'>Log Out</a>)</h3>";

echo "<p><a href='final.php'>&lt; Back to Dashboard</a></p>";

if ($page == "1") {

    echo "<h3>User list</h3>";
    echo "<table border='1'>";

    $lines = file("/etc/passwd");

    foreach ($lines as $line) {
        $parts = explode(":", trim($line));

        echo "<tr>";
        foreach ($parts as $part) {
            echo "<td>$part</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

} elseif ($page == "2") {

    echo "<h3>Group list</h3>";
    echo "<table border='1'>";

    $lines = file("/etc/group");

    foreach ($lines as $line) {
        $parts = explode(":", trim($line));

        echo "<tr>";
        foreach ($parts as $part) {
            echo "<td>$part</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

} elseif ($page == "3") {

    echo "<h3>Syslog</h3>";
    echo "<table border='1'>";

    $lines = @file("/var/log/syslog");

    if ($lines) {
        foreach (array_slice($lines, 0, 50) as $line) {
            echo "<tr><td>" . htmlspecialchars($line) . "</td></tr>";
        }
    } else {
        echo "<tr><td>Cannot read syslog file.</td></tr>";
    }

    echo "</table>";

} else {
    echo "<p>Invalid page</p>";
}

page_footer();
?>

