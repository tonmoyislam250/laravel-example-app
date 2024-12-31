<?php

// Pagination settings
$limit = 2; // Records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure the page number is at least 1
$offset = ($page - 1) * $limit;


// Filtering and ordering
$filter = "WHERE name LIKE 'J%'"; // Names starting with 'J'
$orderBy = "ORDER BY id ASC, name ASC"; // Order by id and name

// Query to count total records matching the filter
$totalQuery = "SELECT COUNT(*) AS total FROM users $filter";
$totalResult = $conn->query($totalQuery);


$totalRecords = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);

// Query to fetch filtered and ordered users with pagination
$sql = "SELECT * FROM users $filter $orderBy LIMIT $offset, $limit";
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
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "'>Previous</a> ";
}
for ($i = 1; $i <= $totalPages; $i++) {
    $active = $i == $page ? 'style="font-weight: bold;"' : '';
    echo "<a href='?page=$i' $active>$i</a> ";
}
if ($page < $totalPages) {
    echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
}
echo '</div>';
?>

