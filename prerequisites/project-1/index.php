<?php
  include 'db.php';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "ID: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
      }
  } else {
      echo "0 results";
  }

?>

<?php include 'templates/header.php'; ?>

<h2>Dynamic Content Here</h2>

<?php include 'templates/footer.php'; ?>
