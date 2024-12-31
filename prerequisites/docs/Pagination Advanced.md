## Pagination Advanced


---

### **PHP Code with Filtering, Ordering, and Pagination**
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