<!DOCTYPE html>
<html>
<head>
    <title>Payroll Calculator</title>
</head>
<body>

<h2>Payroll Calculator</h2>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Hours Worked: <input type="number" step="0.1" name="hours"><br><br>
    Hourly Rate: <input type="number" step="0.01" name="rate"><br><br>
    Federal Tax Rate (%): <input type="number" step="0.1" name="fed"><br><br>
    State Tax Rate (%): <input type="number" step="0.1" name="state"><br><br>
    <input type="submit" value="Calculate">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $hours = $_POST["hours"];
    $rate = $_POST["rate"];
    $fedRate = $_POST["fed"] / 100;
    $stateRate = $_POST["state"] / 100;

    $gross = $hours * $rate;
    $fedTax = $gross * $fedRate;
    $stateTax = $gross * $stateRate;
    $totalDeduction = $fedTax + $stateTax;
    $netPay = $gross - $totalDeduction;

    if ($gross < 11600) {
        $bracket = "10%";
    } elseif ($gross < 47150) {
        $bracket = "12%";
    } elseif ($gross < 100525) {
        $bracket = "22%";
    } else {
        $bracket = "24%+";
    }

    echo "<h3>Payroll Summary</h3>";

    echo "<table border='1'>
            <tr><th>Category</th><th>Amount</th></tr>
            <tr><td>Employee Name</td><td>$name</td></tr>
            <tr><td>Hours Worked</td><td>$hours</td></tr>
            <tr><td>Hourly Rate</td><td>$$rate</td></tr>
            <tr><td>Gross Pay</td><td>$" . number_format($gross, 2) . "</td></tr>
            <tr><td>Federal Withholding</td><td>$" . number_format($fedTax, 2) . "</td></tr>
            <tr><td>State Withholding</td><td>$" . number_format($stateTax, 2) . "</td></tr>
            <tr><td>Total Deductions</td><td>$" . number_format($totalDeduction, 2) . "</td></tr>
            <tr><td>Net Pay</td><td>$" . number_format($netPay, 2) . "</td></tr>
            <tr><td>Tax Bracket</td><td>$bracket</td></tr>
          </table>";
}
?>

</body>
</html>
