<?php

// Include database connection file
require_once 'config/database.php';

// SQL query to retrieve a single record
$sql = "SELECT * FROM grocery_items WHERE item_id = 1";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Fetch only one record
$item = $stmt->fetch(PDO::FETCH_ASSOC);

// Display the record
echo "<pre>";
print_r($item);
echo "</pre>";

?>