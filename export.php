<?php 
// Load the database configuration file 
include_once 'dbConfig.php'; 

// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

// Excel file name for download 
$fileName = "members-data_" . date('YmdHis') . ".xls";

// Column display event game
$head_event_detail = array('Game ID', 'Game Name', 'Start Date', 'End Date');
$event_data = array('123456', '555', '2024-07-11 12:00:00', '2024-07-11 12:00:00');
array_walk($event_data, 'filterData'); 
$excelData = implode("\t", array_values($head_event_detail)) . "\n"; 
$excelData .= implode("\t", array_values($event_data)) . "\n"; 



// Column names 
$fields = array('Movie ID', 'Booking ID', 'User ID', 'Create Time', 'Pay Status', 'Booking Seat', 'Movie Round', 'Booking Money'); 

// Display column names as first row 
$excelData .= implode("\t", array_values($fields)) . "\n"; 

$query = $db->query("SELECT * FROM booking "); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['movie_id'], $row['booking_id'], 
                          $row['user_id'], $row['create_time'], $row['pay_status'], 
                          $row['booking_seat'], $row['movie_round'], 
                          $row['booking_money']); 

        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;









?>