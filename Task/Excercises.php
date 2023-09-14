<?php

//Exercise 2 a)
$connection = getWantedPatientsInfo();

function getWantedPatientsInfo(): mixed
{
    list($connection, $result) = getDataFromPatientTable();
    $row = fetchWantedRows($result);
    return $connection;
}
function getDataFromPatientTable(): array
{
    $connection = mysqli_connect('localhost', 'root', 'rootpassword');
    mysqli_select_db($connection, 'mysql');
    $result = mysqli_query($connection, 'select p.pn, p.last, p.first, i.iname, i.from_date, i.to_date
    from patient p INNER JOIN insurance i on p._id = i.patient_id order by i.from_date, p.last asc');
    return array($connection, $result);
}

function fetchWantedRows(mixed $result): array|null|false
{
    while ($row = mysqli_fetch_assoc($result)) {
        echo "{$row['pn']}, {$row['last']}, {$row['first']}, {$row['iname']}, {$row['from_date']}, {$row['to_date']}\n";
    }
    return $row;
}

//Exercise 2 b)

createStatisticsAboutLetterOccurrenceInFullNames($connection);
function createStatisticsAboutLetterOccurrenceInFullNames(mixed $connection): void
{
    $fullNames = getFullNames($connection);
    list($joinedNames, $joinedNamesLength) = joinFullNames($fullNames);
    $usedCharsArray = getUsedCharsArray($joinedNames);
    getLettersOccurrenceInNames($usedCharsArray, $joinedNames, $joinedNamesLength);
}

function getFullNames(mixed $connection): array
{
    $fullName = mysqli_query($connection, 'select CONCAT(UPPER(first),UPPER(last)) as full_name from patient');
    $fullNames = [];
    while ($row = mysqli_fetch_array($fullName)) {
        $fullNames[] = $row['full_name'];
    }
    return $fullNames;
}

function joinFullNames(array $fullNames): array
{
    $joinedNames = join("", $fullNames);
    $joinedNamesLength = strlen($joinedNames);
    return array($joinedNames, $joinedNamesLength);
}
function getUsedCharsArray(mixed $joinedNames): array
{
    $usedChars = count_chars($joinedNames, 3);
    $usedCharsArray = str_split($usedChars);
    return $usedCharsArray;
}
function getLettersOccurrenceInNames(array $usedCharsArray, mixed $joinedNames, mixed $joinedNamesLength): void
{
    foreach ($usedCharsArray as $char) {
        $count = substr_count($joinedNames, $char, 0, null);
        $charPercentage = $count / $joinedNamesLength * 100;
        print $char . "\t" . $count . "\t" . round($charPercentage, 2) . "%" . "\n";
    }

}
?>


