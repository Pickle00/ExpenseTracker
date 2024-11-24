<?php
require_once 'includes/connection.php';

// Original query with subquery to select distinct categories from today's expenses
$sql = "SELECT * 
        FROM expenses 
        WHERE category IN (
            SELECT DISTINCT category 
            FROM expenses 
            WHERE date = CURDATE()
        ) AND date = CURDATE()";

// Execute the query
$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error);
}

// Initialize an array to store the fetched data
$data = [];

// Check if there are results
if ($result && $result->num_rows > 0) {
    // Fetch each row and add it to the data array
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    // If no records are found for today, output a message
    echo "No records found for today.";
}

// Function to sort the data in descending order based on the amount
function bubbleSortDescending(&$array)
{
    $n = count($array);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($array[$j]['amount'] < $array[$j + 1]['amount']) {
                // Swap the elements
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
}

// Sort the data array from highest to lowest by the 'amount' field
bubbleSortDescending($data);

// Print sorted data
foreach ($data as $row) {
    echo "ID: " . $row["eid"] . " - UserId: " . $row["uid"] . " - Category: " . $row["category"] . " - Amount: " . $row["amount"] . " - Date: " . $row["date"] . " - Note: " . $row["note"] . "<br>";
}

// Close the database connection
$conn->close();
