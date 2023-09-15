<?php


class Insurance implements PatientRecord {
    public int $insuranceId;
    public int $patientId;
    public string $insuranceName;
    public string $insuranceFromDate;
    public string $insuranceToDate;

    function __construct($insuranceId) {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select * from mysql.insurance where _id = '$insuranceId'");
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
        $result = mysqli_query($connection, "select p.pn from mysql.patient p INNER JOIN mysql.insurance i on p._id = i.patient_id where i._id = '$this->insuranceId';");
        $row = mysqli_fetch_assoc($result);
        return $row['pn'];
    }

    public function isDateWithinRange($date){
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select case when(to_date is null or DATE_FORMAT(STR_TO_DATE('$date', '%m-%d-%y'), '%Y-%m-%d') <= to_date) 
                    and DATE_FORMAT(STR_TO_DATE('$date', '%m-%d-%y'), '%Y-%m-%d') >= from_date
        then 'True' ELSE 'False' end as isValid from mysql.insurance;");

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['isValid'];
        } else {
            return false;
        }
    }
}
