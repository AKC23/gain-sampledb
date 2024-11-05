<?php
// Include the database connection
include('db_connect.php');

// Ensure that $tableName is set to avoid SQL injection vulnerabilities
if (!isset($tableName)) {
    echo "No table selected.";
    exit;
}

// Base SQL query to retrieve the entire table
$sql = "SELECT * FROM " . $conn->real_escape_string($tableName);

// Execute the query
$result = $conn->query($sql);

// Check if there are results and display the table
if ($result && $result->num_rows > 0) {
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead class='thead-dark'><tr>"; // Dark header for contrast
    
    // Fetch field names dynamically
    while ($fieldinfo = $result->fetch_field()) {
        echo "<th>" . htmlspecialchars($fieldinfo->name) . "</th>";
    }
    
    echo "</tr></thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td style='background-color: #f8f9fa;'>" . htmlspecialchars($data) . "</td>"; // Light gray for rows
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
