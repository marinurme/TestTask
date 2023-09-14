<?php


class Insurance implements PatientRecord {
    public $insuranceId;
    public $patientId;
    public $insuranceName;
    public $insuranceFromDate;
    public $insuranceToDate;

    function __construct($insuranceId) {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select * from insurance where _id = '$insuranceId'");
        $row = mysqli_fetch_assoc($result);
        $this->insuranceId = $insuranceId;
        $this->patientId = $row['patient_id'];
        $this->insuranceName = $row['iname'];
        $this->insuranceFromDate = $row['from_date'];
        $this->insuranceToDate = $row['to_date'];
    }

    public function getPatientId(): string
    {
        return $this->patientId;
    }

    public function getPatientNumber()
    {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select p.pn from patient p INNER JOIN insurance i on p._id = i.patient_id where i._id = '$this->insuranceId';");
        $row = mysqli_fetch_assoc($result);
        return $row['pn'];
    }

    public function isDateWithinRange($date){
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select case when(to_date is null or DATE_FORMAT(STR_TO_DATE('12-31-09', '%m-%d-%y'), '%Y-%m-%d') <= to_date) and DATE_FORMAT(STR_TO_DATE('12-31-10', '%m-%d-%y'), '%Y-%m-%d') >= from_date
        then 'True' ELSE 'False' end as isValid from insurance;");

    }
}
