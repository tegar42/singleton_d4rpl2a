<?php
include_once("db_connection.php");

// Membuat instance Pertama
$database = new DatabaseConnection();
var_dump($database->connect());

// Insert a transaction
$query = "INSERT INTO transactions (date, description, amount, category) VALUES ('2024-05-01', 'Lunch with colleagues', 35.00, 'Food')";
$database->executeQuery($query);

$query = "INSERT INTO transactions (date, description, amount, category) VALUES ('2024-05-01', 'Mobile phone bill', 45.00, 'Utilities')";
$database->executeQuery($query);

// Update a transaction
$query = "UPDATE transactions SET amount = 40.00, description = 'Lunch with colleagues' WHERE description = 'Lunch with colleagues'";
$database->executeQuery($query);

// Delete a transaction
$query = "DELETE FROM transactions WHERE description = 'Mobile phone bill'";
$database->executeQuery($query);

// Membuat instance Kedua
$database2 = new DatabaseConnection();
var_dump($database2->connect());

$query = "INSERT INTO transactions (date, description, amount, category) VALUES ('2024-05-11', 'Grocery shopping', 50.00, 'Food')";
$database2->executeQuery($query);

// Delete a transaction
$query = "DELETE FROM transactions WHERE transaction_id >= 4";
$database->executeQuery($query);

// Display data transaction
$query = "SELECT * FROM transactions";
$result = $database->executeQuery($query);

if ($result) {
    echo "<h2>Transactions:</h2>";
    echo "<table border='1' style='border-collapse:collapse;'>
            <tr>
                <th>Transaction ID</th>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
            </tr>";

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['transaction_id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>$" . number_format($row['amount'], 2) . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No transactions found.";
}
