<?php
include 'PatientRecord.php';
include '../insurance/Insurance.php';

class Patient implements PatientRecord
{
    public int $patientId;
    public string $patientNumber;
    public string $patientFirstName;
    public string $patientLastName;
    public string $patientDateOfBirth;

    function __construct($patientNumber)
    {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select * from mysql.patient where pn = '$patientNumber'");
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

    public function getPatientInsuranceRecords(): array
    {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select _id from mysql.insurance where patient_id = '$this->patientId';");
        $insuranceRecords = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $insurance = new Insurance($row['_id']);
            $insuranceRecords[] = $insurance;
        }
        return $insuranceRecords;
    }

    public function printPatientInsuranceAvailability($date): void
    {
        $connection = mysqli_connect('localhost', 'root', 'rootpassword');
        mysqli_select_db($connection, 'mysql');
        $result = mysqli_query($connection, "select p.pn, concat(p.first,' ',p.last) as FirstLast, i.iname, case 
        when DATE_FORMAT(STR_TO_DATE('$date', '%m-%d-%y'), '%Y-%m-%d') between i.from_date and i.to_date then 'Yes' ELSE 'No' end as isValid
        from mysql.patient p INNER JOIN mysql.insurance i on p._id = i.patient_id order by p.pn asc;");
        while ($row = mysqli_fetch_assoc($result)) {
            print "{$row['pn']}, {$row['FirstLast']}, {$row['iname']}, {$row['isValid']}\n";
        }
    }
}
