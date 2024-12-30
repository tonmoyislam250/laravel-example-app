<?php
  include 'db.php';

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

?>

<?php include 'templates/header.php'; ?>

<h2>Dynamic Content Here</h2>

<?php include 'templates/user-table.php'; ?>

<?php include 'templates/footer.php'; ?>
