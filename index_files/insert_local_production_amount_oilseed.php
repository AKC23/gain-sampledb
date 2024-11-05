<?php
// insertlocal_production_amount_oilseed.php

// Include the database connection
include('db_connect.php');

// SQL query to drop the 'local_production_amount_oilseed' table if it exists
$dropTableSQL = "DROP TABLE IF EXISTS local_production_amount_oilseed";

// Execute the query to drop the table
if ($conn->query($dropTableSQL) === TRUE) {
    echo "Table 'local_production_amount_oilseed' dropped successfully.<br>";
} else {
    echo "Error dropping table 'local_production_amount_oilseed': " . $conn->error . "<br>";
}

// SQL query to create the 'local_production_amount_oilseed' table with foreign keys
$createTableSQL = "
    CREATE TABLE local_production_amount_oilseed (
        DataID INT PRIMARY KEY AUTO_INCREMENT,
        FoodTypeID INT,
        RawCrops INT,
        VehicleID INT,
        ConvertedUnit VARCHAR(50),
        CValue DECIMAL(10, 3),
        StartYear VARCHAR(50),
        EndYear VARCHAR(50),
        AccessedDate VARCHAR(50),
        Source VARCHAR(100),
        Link VARCHAR(255),
        DataType VARCHAR(50), 
        Process VARCHAR(100),
        FOREIGN KEY (FoodTypeID) REFERENCES FoodType(FoodTypeID) ON DELETE SET NULL ON UPDATE CASCADE,
        FOREIGN KEY (VehicleID) REFERENCES FoodVehicle(VehicleID) ON DELETE SET NULL ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

// Execute the query to create the table
if ($conn->query($createTableSQL) === TRUE) {
    echo "Table 'local_production_amount_oilseed' created successfully.<br>";
} else {
    echo "Error creating table 'local_production_amount_oilseed': " . $conn->error . "<br>";
}

// Path to your uploaded CSV file
$csvFile = 'local_production_amount_oilseed.csv';  // Update with the exact path of your CSV file

// Open the CSV file for reading
if (($handle = fopen($csvFile, "r")) !== FALSE) {

    // Skip the header row
    fgetcsv($handle);

    // Prepare the SQL statement with placeholders for all columns
    $stmt = $conn->prepare("INSERT INTO local_production_amount_oilseed (FoodTypeID, RawCrops, VehicleID, ConvertedUnit, CValue, StartYear, EndYear, AccessedDate, Source, Link, DataType, Process) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === FALSE) {
        echo "Error preparing statement: " . $conn->error . "<br>";
    } else {
        // Read through each line of the CSV file
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Check if there are enough columns in the CSV row
            if (count($data) < 17) { // Assuming there are at least 17 columns in your CSV
                echo "Error: Not enough data in row.<br>";
                continue; // Skip to the next row
            }

            // Extract relevant columns from the CSV data
            $foodTypeID = (int) trim($data[1]); // FoodTypeID
            $rawCrops = (int) trim($data[3]); // Raw Crops ID
            $vehicleID = (int) trim($data[5]); // VehicleID
            $convertedUnit = trim($data[7]); // Converted Unit
            $CValue = (float) trim($data[9]); // CValue
            $startYear = trim($data[10]); // Start Year
            $endYear = trim($data[11]); // End Year
            $accessedDate = trim($data[12]); // Accessed Date
            $source = trim($data[13]); // Source
            $link = trim($data[14]); // Link
            $dataType = trim($data[15]); // DataType
            $processData = trim($data[16]); // Process

            // Bind parameters
            $stmt->bind_param("iiisssssssss", $foodTypeID, $rawCrops, $vehicleID, $convertedUnit, $CValue, $startYear, $endYear, $accessedDate, $source, $link, $dataType, $processData);

            // Execute the query
            if ($stmt->execute() === TRUE) {
                echo "Data inserted successfully.<br>";
            } else {
                echo "Error inserting data: " . $stmt->error . "<br>";
            }
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the file after reading
    fclose($handle);
} else {
    echo "Error: Could not open CSV file.";
}

// Close the database connection
$conn->close();

?>
