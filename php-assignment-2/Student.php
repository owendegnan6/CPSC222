<?php
class student {

    private $firstName;
    private $lastName;
    private $studentId;
    private $classes;

    function __construct($fn, $ln, $id, $c) {
        $this->setFirstName($fn);
        $this->setLastName($ln);
        $this->setStudentId($id);
        $this->setClasses($c);
    }

    function setFirstName($fn) {
        $this->firstName = $fn;
    }

    function setLastName($ln) {
        $this->lastName = $ln;
    }

    function setStudentId($id) {
        $this->studentId = $id;
    }

    function setClasses($c) {
        $this->classes = $c;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getIDnumber() {
        return $this->studentId;
    }

    function getClasses() {
        return $this->classes;
    }
}
?>
