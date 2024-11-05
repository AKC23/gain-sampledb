<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAIN Database Display</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9ecef;
        }

        .center-title {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .current-time {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 1.2em;
            color: #6c757d;
        }

        .card {
            margin-top: 20px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="center-title">GAIN Database Display</h1>

        <!-- Display Current Date and Time -->
        <div class="current-time">
            <?php
            date_default_timezone_set('Asia/Dhaka'); // Adjust as needed
            echo "Current Date and Time: " . date('F j, Y, g:i a');
            ?>
        </div>

        <div class="card">

            <!-- Dropdown Form to select the table -->
            <?php include('display_dropdown.php'); ?>

            <?php

            // include('insert_local_production_amount_oilseed.php'); 
            // include('insert_import_edible_oil.php'); 

            // include('insert_import_amount_oilseeds.php');
            // include('insert_import_edible_oil.php');
            // include('insert_total_supply_amount_edible_oil.php');

            //include('insert_producer_skus_price.php');
            //include('insert_producers_brand_name.php');
            //include('insert_producers_supply.php');

            //include('insert_importer_skus_price.php'); 
            //include('insert_importers_brand_name.php');          
            //include('insert_importers_supply.php');

            //include('insert_distribution_channels.php');

            //include('insert_rawcrops.php');
            //include('insert_foodtype.php');
            //include('insert_foodvehicle.php');

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['tableName'])) {
                $tableName = $_POST['tableName'];
                echo "<h2 class='text-center'>Data Table: " . htmlspecialchars($tableName) . "</h2>";

                // Include display_table.php to show the filtered data
                include('display_table.php');
            } else {
                echo "<p class='text-center'>Select a table to display data.</p>";
            }
            ?>

            <!-- Form for inserting data -->

        </div>
    </div>

    <!-- Bootstrap and jQuery scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>