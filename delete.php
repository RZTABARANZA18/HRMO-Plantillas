<?php
include "db_conn.php";

// Check if cos_id is provided
if (!isset($_GET["cos_id"])) {
    header("Location: index.php?msg=No ID provided");
    exit();
}

$cos_id = mysqli_real_escape_string($conn, $_GET["cos_id"]);

$query = "DELETE employees, df FROM employees 
          INNER JOIN df ON employees.cos_id = df.cos_id 
          WHERE employees.cos_id = '$cos_id'";

// Execute the query
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: index.php?msg=Data deleted successfully");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>