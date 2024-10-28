<?php
include "db_conn.php";

$search = ''; // Search connection
if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
}

$sql = "SELECT * FROM `books`";
if ($search) {
    $sql .= " WHERE `Title` LIKE '%$search%' OR `ISBN` LIKE '%$search%'";
}
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./css/style.css">

  <title>Skills Test CRUD Application</title>

  <style>
    /* Styles for alert */
    .alert {
      position: relative;
      padding: 1rem;
      margin-bottom: 1rem;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #f8d7da;
      color: #721c24;
    }
    
    .alert .close-btn {
      position: absolute;
      top: 0.5rem;
      right: 0.5rem;
      background: none;
      border: none;
      color: #721c24;
      font-size: 1.2rem;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <span class="navbar-brand">Skills Test CRUD Application</span>
    <form action="" method="post">
      <button type="submit" name="logout" class="logout-btn">...</button>
      </form>
  </nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert">
      ' . $msg . '
      <button type="button" class="close-btn">&times;</button>
    </div>';
    }
    ?>
    <a href="add-books.php" class="add-btn">Add Books</a>

    <!-- Search Form -->
    <form action="" method="post" class="search-form">
      <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by title or ISBN" />
      <button type="submit" class="search-btn">Search</button>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>ISBN</th>
          <th>Title</th>
          <th>Copyright</th>
          <th>Edition</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
              <td><?php echo $row["ISBN"] ?></td>
              <td><?php echo $row["Title"] ?></td>
              <td><?php echo $row["Copyright"] ?></td>
              <td><?php echo $row["Edition"] ?></td>
              <td><?php echo $row["Price"] ?></td>
              <td><?php echo $row["Quantity"] ?></td>
              <td><?php echo $row["Total"] ?></td>
              <td>
                  <a href="update.php?id=<?php echo $row["ISBN"] ?>" class="edit-link">Edit</a>
                  <a href="delete.php?id=<?php echo $row["ISBN"] ?>" class="delete-link">Delete</a>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "<tr><td colspan='8' class='text-center'>Book not found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add event listener to all close buttons
      const closeButtons = document.querySelectorAll('.close-btn');
      closeButtons.forEach(button => {
        button.addEventListener('click', function() {
          const alertBox = this.parentElement;
          alertBox.style.display = 'none';
        });
      });
    });
  </script>
</body>

</html>
