<?php
$connection = mysqli_connect('localhost', 'root', 'rootpassword');
$db = mysqli_select_db($connection,'mysql');
$result = mysqli_query($connection, 'select p.pn, p.last, p.first, i.iname, i.from_date, i.to_date
from patient p INNER JOIN insurance i on p._id = i.patient_id order by i.from_date, p.last asc');
while ($row = mysqli_fetch_assoc($result)) {
    echo "{$row['pn']}, {$row['last']}, {$row['first']}, {$row['iname']}, {$row['from_date']}, {$row['to_date']}\n";
}
$statistics = mysqli_query($connection, 'select last, first from patient');
$fullName = implode('')
?>


