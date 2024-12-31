<?php

// Pagination settings
$limit = 2; // Records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure the page number is at least 1
$offset = ($page - 1) * $limit;

// Fetch total record count
$totalQuery = "SELECT COUNT(*) AS total FROM users";
$totalResult = $conn->query($totalQuery);

$totalRecords = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

// Fetch users for the current page
$sql = "SELECT * FROM users LIMIT $offset, $limit";
$result = $conn->query($sql);

// Display the users in a table

echo '<h2>User Table</h2>';

echo '<table border="1" cellpadding="10">';
echo '<tr><th>ID</th><th>Name</th></tr>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td></tr>";
    }
} else {
    echo '<tr><td colspan="2">No records found</td></tr>';
}
echo '</table>';

// Render pagination links
echo '<div style="margin-top: 20px;">';
for ($i = 1; $i <= $totalPages; $i++) {
    $active = $i == $page ? 'style="font-weight: bold;"' : '';
    echo "<a href='?page=$i' $active>$i</a> ";
}
echo '</div>';
?>

