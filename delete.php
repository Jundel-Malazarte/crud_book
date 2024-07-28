<?php
include "db_conn.php";

if (isset($_GET['id'])) {
  $isbn = mysqli_real_escape_string($conn, $_GET['id']);
  
  // Make sure the table name matches your database schema
  $sql = "DELETE FROM `books` WHERE `ISBN` = '$isbn'";
  
  if (mysqli_query($conn, $sql)) {
      header("Location: index.php?msg=Book deleted successfully");
      exit();
  } else {
      header("Location: index.php?msg=Error deleting book: " . mysqli_error($conn));
      exit();
  }
} else {
  header("Location: index.php?msg=No book ID provided");
  exit();
}
