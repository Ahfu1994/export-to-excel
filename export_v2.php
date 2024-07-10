<?php

// Load the database configuration file 
include_once 'dbConfig.php'; 
 
// Include XLSX generator library 
require_once 'PhpXlsxGenerator.php'; 

$fileName = "members-data_" . date('YmdHis') . ".xls";

// Define column names 
$excelData[] = array('Game ID', 'Game Name', 'Start Date', 'End Date');
$excelData[] = array('123456', '555', '2024-07-11 12:00:00', '2024-07-11 12:00:00');

$excelData[] = array('Movie ID', 'Booking ID', 'User ID', 'Create Time', 'Pay Status', 'Booking Seat', 'Movie Round', 'Booking Money');

$query = $db->query("SELECT * FROM booking "); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['movie_id'], $row['booking_id'], 
                          $row['user_id'], $row['create_time'], $row['pay_status'], 
                          $row['booking_seat'], $row['movie_round'], 
                          $row['booking_money']); 

        $excelData[] = $lineData;
    } 
}

// Export data to excel and download as xlsx file 
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray( $excelData ); 
$xlsx->downloadAs($fileName); 
 
exit

?>