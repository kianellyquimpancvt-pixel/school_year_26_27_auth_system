<?php

// Include database connection file
require_once 'config/database.php';

// SQL query to retrieve all records
$sql = "SELECT * FROM grocery_items";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Fetch all records from the table
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display all records
echo "<pre>";
print_r($items);
echo "</pre>";

?>