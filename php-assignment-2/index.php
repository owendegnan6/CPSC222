<?php
require_once("Student.php");
require_once("Grades.php");

$students = array(
    new student("Lebron", "James", "1001", array("CPSC222" => 98, "CPSC111" => 76, "CPSC333" => 82)),
    new student("Stephen", "Curry", "1005", array("CPSC122" => 88, "CPSC411" => 46, "CPSC323" => 72)),
    new student("Kevin", "Durant", "1009", array("CPSC244" => 68, "CPSC116" => 96, "CPSC345" => 82))
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Grades</title>
</head>
<body>

<h1>Chapters 5 & 6</h1>

<?php
for ($i = 0; $i < count($students); $i++) {

    echo "<table border=1>";
    
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<td>" . $students[$i]->getLastName() . ", " . $students[$i]->getFirstName() . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th>Student ID</th>";
    echo "<td>" . $students[$i]->getIDnumber() . "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<th>Grades</th>";
    echo "<td><ul>";

    foreach ($students[$i]->getClasses() as $course => $grade) {
        echo "<li>$course - $grade " . getLetterGrade($grade) . "</li>";
    }

    echo "</ul></td>";
    echo "</tr>";

    echo "</table><br>";
}
?>

</body>
</html>
