<?php
// Include the database connection
include('db_connect.php');

// Ensure that $tableName is set and valid
if (!isset($tableName)) {
    echo "No table selected.";
    exit;
}

// Base SQL query to retrieve the entire table securely
$sql = "SELECT * FROM " . $conn->real_escape_string($tableName);

// Execute the query
$result = $conn->query($sql);

// Check if there are results and display the table
if ($result && $result->num_rows > 0) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead class='thead-dark'><tr>";
    
    // Fetch field names dynamically
    $fieldTypes = [];
    while ($fieldinfo = $result->fetch_field()) {
        $fieldTypes[$fieldinfo->name] = $fieldinfo->type;
        echo "<th>" . htmlspecialchars($fieldinfo->name) . "</th>";
    }
    
    echo "</tr></thead><tbody>";

    // Display data rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $field => $data) {
            // Apply alignment based on column type
            $alignStyle = '';
            if ($fieldTypes[$field] == MYSQLI_TYPE_LONG) { // Integer values (assuming ID is integer)
                $alignStyle = "text-align: center;";
            } elseif (is_numeric($data)) { // Any numeric values (align right)
                $alignStyle = "text-align: right;";
            } else { // Default alignment for text (align left)
                $alignStyle = "text-align: left;";
            }
            echo "<td style='background-color: #f8f9fa; $alignStyle'>" . htmlspecialchars($data) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='alert alert-warning'>No records found in the selected table.</div>";
}

// Close the database connection
$conn->close();
?>