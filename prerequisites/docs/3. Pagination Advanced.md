## Pagination Advanced


---

## **PHP Code with Filtering, Ordering, and Pagination**
```php
<?php
.
.
.

// Filtering and ordering
$filter = "WHERE name LIKE 'J%'"; // Names starting with 'J'
$orderBy = "ORDER BY id ASC, name ASC"; // Order by id and name

// Query to count total records matching the filter
$totalQuery = "SELECT COUNT(*) AS total FROM users $filter";

.
.
.

// Query to fetch filtered and ordered users with pagination
$sql = "SELECT * FROM users $filter $orderBy LIMIT $offset, $limit";
$result = $conn->query($sql);

?>
```

---

### **Key Points of the Implementation**

1. **Filtering by Name:**
   ```php
   $filter = "WHERE name LIKE 'J%'";
   ```
   - The `LIKE 'J%'` condition filters rows where `name` starts with the letter "J".
   - Modify this condition if you need different filters.

2. **Ordering by `id` and `name`:**
   ```php
   $orderBy = "ORDER BY id ASC, name ASC";
   ```
   - `id ASC`: Orders the rows by `id` in ascending order.
   - `name ASC`: For rows with the same `id`, it further orders them by `name`.

3. **Pagination Logic:**
   - `$limit` determines how many rows are displayed per page.
   - `$offset` determines the starting point for the SQL query.

4. **Total Record Count:**
   - The query:
     ```php
     SELECT COUNT(*) AS total FROM users $filter
     ```
     - Counts only rows matching the filter (`name LIKE 'J%'`).

5. **Pagination Links:**
   - Generates "Previous" and "Next" buttons.
   - Highlights the active page number using bold styling.

6. **Fallback for No Results:**
   - If there are no matching records, display:
     ```php
     No matching records found.
     ```

---

### **Output Example**

#### Database Table: `users`

| id  | name       |
|------|------------|
| 1    | John Doe   |
| 2    | Jane Roe   |
| 3    | Alice Smith|
| 4    | Jack Frost |

---

#### Filtered Output (Page 1)

| ID | Name       |
|----|------------|
| 1  | Jack Frost |
| 2  | Jane Roe   |
| 3  | John Doe   |

#### Pagination Links
```
1 2 3 Next
```

---


## **Enhancement of the Pagination Code**

The code implements a user search and pagination system for a `users` table. One can search the user by partial name, select order of table and how many items should be shown on table

---

### **1. Retrieving Filters and Inputs**
```php
$search = $_GET['search'] ?? ''; // Search query
$orderByField = $_GET['order_by'] ?? 'id'; // Field to order by
$orderDirection = $_GET['direction'] ?? 'ASC'; // Order direction (ASC/DESC)
$limit = (int)($_GET['limit'] ?? 10); // Number of records per page
$page = (int)($_GET['page'] ?? 1); // Current page
$page = max($page, 1); // Ensure page is at least 1
```
- Retrieves user inputs from the query parameters (`$_GET`).
  - `search`: Filter users by name.
  - `order_by`: Field to sort the data (`id` or `name`).
  - `direction`: Sorting order (`ASC` or `DESC`).
  - `limit`: Number of records per page (default: 10).
  - `page`: Current page number (default: 1).
- Ensures `page` is at least 1 to avoid invalid offsets.

---

### **2. Applying Filters and Ordering**
```php
$filter = !empty($search) ? "WHERE name LIKE '%" . $conn->real_escape_string($search) . "%'" : "";
$orderDirection = strtoupper($orderDirection) === 'DESC' ? 'DESC' : 'ASC';
```
- **Filter:** If the `search` input is not empty, adds a `WHERE` clause to filter rows where `name` contains the search query.
- **Sanitization:** Prevents SQL injection by escaping the search string using `real_escape_string`.
- **Order Direction Validation:** Ensures only valid values (`ASC` or `DESC`) are used.

---

### **3. Total Record Count**
```php
$totalQuery = "SELECT COUNT(*) AS total FROM users $filter";
$totalResult = $conn->query($totalQuery);
$totalRecords = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $limit);
```
- Counts the total number of records that match the filter using `COUNT(*)`.
- Calculates the total number of pages by dividing the total records by the number of records per page (`limit`).

---

### **4. Fetching Filtered and Paginated Records**
```php
$sql = "SELECT * FROM users $filter ORDER BY $orderByField $orderDirection LIMIT $offset, $limit";
$result = $conn->query($sql);
```
- Fetches records matching the filter, ordered by the selected field and direction, and limits the results based on the current page and offset.

---

### **5. Search and Filter Form**
```html
<form method="GET">
    <label for="search">Search by Name:</label>
    <input type="text" id="search" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Enter name">
    
    <label for="order_by">Order By:</label>
    <select id="order_by" name="order_by">
        <option value="id" <?= $orderByField === 'id' ? 'selected' : '' ?>>ID</option>
        <option value="name" <?= $orderByField === 'name' ? 'selected' : '' ?>>Name</option>
    </select>
    
    <label for="direction">Direction:</label>
    <select id="direction" name="direction">
        <option value="ASC" <?= $orderDirection === 'ASC' ? 'selected' : '' ?>>Ascending</option>
        <option value="DESC" <?= $orderDirection === 'DESC' ? 'selected' : '' ?>>Descending</option>
    </select>
    
    <label for="limit">Records Per Page:</label>
    <select id="limit" name="limit">
        <option value="5" <?= $limit === 5 ? 'selected' : '' ?>>5</option>
        <option value="10" <?= $limit === 10 ? 'selected' : '' ?>>10</option>
        <option value="20" <?= $limit === 20 ? 'selected' : '' ?>>20</option>
        <option value="50" <?= $limit === 50 ? 'selected' : '' ?>>50</option>
    </select>
    
    <button type="submit">Filter</button>
</form>
```
- A user-friendly form allows the user to:
  - Search for names.
  - Select the ordering field (`id` or `name`).
  - Choose the sorting direction (`ASC` or `DESC`).
  - Set the number of records per page.

---

### **6. Displaying Records**
```php
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No matching records found</td>
        </tr>
    <?php endif; ?>
</table>
```
- Displays results in a table with two columns (`id` and `name`).
- If no records are found, a message is displayed instead.

---

### **7. Pagination Links**
```php
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">Previous</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="<?= $i === $page ? 'active' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
    <?php if ($page < $totalPages): ?>
        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next</a>
    <?php endif; ?>
</div>
```
- **Previous Link:** Navigates to the previous page if applicable.
- **Page Numbers:** Displays links for all pages. The active page is highlighted.
- **Next Link:** Navigates to the next page if applicable.

---

### **Key Features**
1. **Search Functionality:**
   - Allows filtering by name using the search bar.
2. **Dynamic Sorting:**
   - Users can sort results by `id` or `name` in ascending or descending order.
3. **Pagination:**
   - Provides navigation links for multi-page results.
4. **User-Friendly Inputs:**
   - Uses dropdowns for ordering and limit selection.

---

### **Example Usage**

#### Query Parameters:
- `?search=John&order_by=name&direction=ASC&limit=10&page=2`
  - Search for users with names containing "John."
  - Order results by `name` in ascending order.
  - Display 10 records per page, starting from page 2.

#### Output (HTML Table):

| ID  | Name       |
|-----|------------|
| 1   | John Doe   |
| 2   | Jane Roe   |

---
