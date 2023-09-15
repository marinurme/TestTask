<?php
include '../patient/Patient.php';
$currentDate = date('Y-m-d');
$patient = new Patient("000000001");
$patient->printPatientInsuranceAvailability($currentDate);

