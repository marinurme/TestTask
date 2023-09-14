<?php
include 'Patient.php';

$patient = new Patient("000000001");
$patientvv = $patient->printPatientInsuranceAvailability('06-02-09');
print $patientvv;

?>