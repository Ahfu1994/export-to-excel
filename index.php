<?php
    //Load the database config file
    include_once "dbConfig.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Export to excel file</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Members List</h2>
        <div class="row">
            <!-- Export link -->
            <div class="col-md-12 head">
                <div class="float-end">
                    <!-- href="export.php" -->
                    <a id="export-file" href="export_v2.php">Export</a>
                </div>
            </div>

            <!-- Data list table -->
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Movie ID</th>
                        <th>Booking ID</th>
                        <th>User ID</th>
                        <th>Create Time</th>
                        <th>Pay Status</th>
                        <th>Booking Seat</th>
                        <th>Movie Round</th>
                        <th>Booking Money</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Fetch records from database
                    $result = $db->query('SELECT * FROM booking ');
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $data[] = $row;
                    ?>
                        <tr>
                            <td><?= '#'.$row['id']?></td>
                            <td><?= $row['movie_id']?></td>
                            <td><?= $row['booking_id']?></td>
                            <td><?= $row['user_id']?></td>
                            <td><?= $row['create_time']?></td>
                            <td><?= $row['pay_status']?></td>
                            <td><?= $row['booking_seat']?></td>
                            <td><?= $row['movie_round'] ?></td>
                            <td><?= $row['booking_money']?></td>
                        </tr>
                    <?php
                        }
                    }else{
                        echo "No member found";
                    }
                    ?>
                   
                </tbody>

            </table>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>