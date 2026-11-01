<?php

// Include database connection file
require_once 'config/database.php';

// SQL query to update a record
$sql = "UPDATE grocery_items
        SET price = ?, stock_quantity = ?
        WHERE item_id = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Execute update query
$stmt->execute([
    25.00,
    150,
    1
]);

// Display success message
echo "Record updated successfully!";

?>