<?php

// Include database connection file
require_once 'config/database.php';

// SQL query to delete a record
$sql = "DELETE FROM grocery_items WHERE item_id = ?";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Delete record with item_id = 11
$stmt->execute([11]);

// Display success message
echo "Record deleted successfully!";

?>