<!DOCTYPE html>
<html>
<head>
    <title>Birthday Formatter</title>
</head>
<body>

<h1>Birthday Formatter</h1>
<form method="post" action="ch7_12.php">
    Month: <input type="text" name="month"><br>
    Day: <input type="text" name="day"><br>
    Year: <input type="text" name="year"><br>
    Hour: <input type="text" name="hour"><br>
    Minute: <input type="text" name="minute"><br>

    AM/PM:
    <select name="ampm">
        <option value="AM">AM</option>
        <option value="PM">PM</option>
    </select><br><br>

    <input type="submit" value="Format Date">
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = htmlspecialchars($_POST['month']);
    $day = htmlspecialchars($_POST['day']);
    $year = htmlspecialchars($_POST['year']);
    $hour = htmlspecialchars($_POST['hour']);
    $minute = htmlspecialchars($_POST['minute']);
    $ampm = htmlspecialchars($_POST['ampm']);
    // convert to 24-hour time
    if ($ampm == "PM" && $hour != 12) {
        $hour += 12;
    }
    if ($ampm == "AM" && $hour == 12) {
        $hour = 0;
    }
    $timestamp = mktime($hour, $minute, 0, $month, $day, $year);
    echo "<p>";
    echo date("l F jS, Y - g:ia", $timestamp);
    echo "</p>";
    echo "<a href='ch7_12.php?iso=" . urlencode($timestamp) . "'>";
    echo "Show date in ISO format";
    echo "</a>";
}
?>
<?php
if (isset($_GET['iso'])) {
    $timestamp = $_GET['iso'];

    echo "<h2>Birthday Formatter</h2>";
    echo date("Y-m-d H:i:s", $timestamp);
}
?>
