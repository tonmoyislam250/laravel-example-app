# Pagination Basi

---

### Add Pagination Code

```php
<?php

// Pagination settings
$limit = 10; // Records per page
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
```

---

### Explanation

1. **Pagination Logic:**
   - `$limit` determines how many records to display per page.
   - `$page` is the current page number (default is 1).
   - `$offset` calculates where the SQL query should start fetching records. For example: When someone want to visit, `page 3`, and `limit is 2`, then `offset` will be `(3-1)*2`. So that, database query will ignore first `4 results` and show `next 2`.

2. **Calculate Total Pages:**
   - Use `COUNT(*)` to get the total number of records.
   - Divide the total records by `$limit` to determine the number of pages.
   - `$fetch_assoc()` is a method in PHP's MySQLi (MySQL Improved) extension used to fetch the next row of a result set as an associative array. Each call to fetch_assoc() retrieves one row from the result set.

3. **SQL Query with LIMIT:**
   - Use `LIMIT $offset, $limit` to fetch the records for the current page.

4. **Pagination Links:**
   - Loop through the total pages and create links for each page.
   - Highlight the active page with bold styling.

5. **Table UI:**
   - Display users in an HTML table with proper headers and styling.

---

### Example Output

#### Table UI
```
+----+----------+
| ID | Name     |
+----+----------+
| 1  | John Doe |
| 2  | Jane Roe |
+----+----------+
```

#### Pagination Links
```
1 2 3 4 5
```

---

### Enhancements

1. **Styling:**
   Add CSS for better visuals.
   ```html
   <style>
       table {
           width: 50%;
           border-collapse: collapse;
           margin: 20px auto;
       }
       th, td {
           border: 1px solid #ddd;
           padding: 8px;
           text-align: center;
       }
       th {
           background-color: #f4f4f4;
       }
       a {
           margin: 0 5px;
           text-decoration: none;
           color: blue;
       }
       a[style] {
           font-weight: bold;
           color: black;
       }
   </style>
   ```

2. **Add "Next" and "Previous" Links:**
   ```php
   if ($page > 1) {
       echo "<a href='?page=" . ($page - 1) . "'>Previous</a> ";
   }
   if ($page < $totalPages) {
       echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
   }
   ```

3. **Responsive Design:**
   Wrap the table in a div with `overflow-x: auto` for mobile devices.


## REFERENCES
1. https://www.w3schools.com/mysql/mysql_limit.asp
2. https://www.w3schools.com/php/php_ref_mysqli.asp
3. https://www.w3schools.com/php/php_arrays_associative.asp
4. https://www.php.net/manual/en/mysqli-result.num-rows.php