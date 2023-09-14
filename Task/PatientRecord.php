<?php

interface PatientRecord
{
    public function getPatientId();

    public function getPatientNumber();
}

class Patient implements PatientRecord
{
    public $patientId;
    public $patientNumber;

    public $patientFirstName;
    public $patientLastName;

    public $patientDateOfBirth;


    function __construct($patientNumber)
    {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select * from patient where pn = '$patientNumber'");
        $row = mysqli_fetch_assoc($result);
        $this->patientNumber = $patientNumber;
        $this->patientId = $row['_id'];
        $this->patientFirstName = $row['first'];
        $this->patientLastName = $row['last'];
        $this->patientDateOfBirth = $row['dob'];
    }

    public function getPatientId(): int
    {
        return $this->patientId;
    }

    public function getPatientNumber(): int
    {
        return $this->patientNumber;
    }

    public function getPatientFullName(): string
    {
        return $this->patientFirstName . "\t" . $this->patientLastName;
    }
}

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

    public function getPatientId()
    {
        // TODO: Implement getPatientId() method.
    }

    public function getPatientNumber()
    {
        // TODO: Implement getPatientNumber() method.
    }
}
$patient = new Patient('000000002');
$patientId = $patient -> getPatientId();
print $patientId;
?>