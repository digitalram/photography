<?php
$filename1 = 'uploads/attendees_f.csv';
$filename2 = 'uploads/attendees_s.csv';
$filename3 = 'uploads/reviewers.csv';

if (file_exists($filename1)) {
    echo "The file $filename1 exists" . " \n";
} else {
    echo "The file $filename1 does not exist" . "\n";
}

if (file_exists($filename2)) {
    echo "The file $filename2 exists" . "\n";
} else {
    echo "The file $filename2 does not exist" . "\n";
}

if (file_exists($filename3)) {
    echo "The file $filename3 exists" . "\n";
} else {
    echo "The file $filename3 does not exist" . "\n";
}
?>