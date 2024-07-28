<?php
include "db_conn.php";

$error_msg = '';

if (isset($_POST['submit'])) {
    $ISBN = $_POST['ISBN'];
    $Title = $_POST['Title'];
    $Copyright = $_POST['Copyright'];
    $Edition = $_POST['Edition'];
    $Price = $_POST['Price'];
    $Quantity = $_POST['Quantity'];

    // Check for duplicate ISBN
    $check_sql = "SELECT * FROM `books` WHERE `ISBN` = '$ISBN'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $error_msg = "Error: Duplicate ISBN. This ISBN already exists.";
    } else {
        $sql = "INSERT INTO `books` (`ISBN`, `Title`, `Copyright`, `Edition`, `Price`, `Quantity`) 
                VALUES ('$ISBN', '$Title', '$Copyright', '$Edition', '$Price', '$Quantity')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: index.php?msg=New Book created successfully");
        } else {
            $error_msg = "Failed: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/addbooks.css">

    <title>PHP CRUD Application</title>
</head>

<body>
    <nav class="navbar">
        Skills Test CRUD Application
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New Book</h3>
            <p class="text-muted">Complete the form below to add a new book</p>
        </div>

        <?php if ($error_msg != ''): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="add-books.php" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="ISBN">ISBN:</label>
                    <input type="text" id="ISBN" name="ISBN" required>
                </div>
                <div class="form-group">
                    <label for="Title">Title:</label>
                    <input type="text" id="Title" name="Title" required>
                </div>
                <div class="form-group">
                    <label for="Copyright">Copyright:</label>
                    <input type="text" id="Copyright" name="Copyright" required>
                </div>
                <div class="form-group">
                    <label for="Edition">Edition:</label>
                    <input type="text" id="Edition" name="Edition" required>
                </div>
                <div class="form-group">
                    <label for="Price">Price:</label>
                    <input type="text" id="Price" name="Price" required>
                </div>
                <div class="form-group">
                    <label for="Quantity">Quantity:</label>
                    <input type="text" id="Quantity" name="Quantity" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Validation -->
    <script>
        function validateForm() {
            var isbn = document.forms["add-books"]["ISBN"].value;
            var title = document.forms["add-books"]["Title"].value;
            var copyright = document.forms["add-books"]["Copyright"].value;
            var edition = document.forms["add-books"]["Edition"].value;
            var price = document.forms["add-books"]["Price"].value;
            var quantity = document.forms["add-books"]["Quantity"].value;

            if (isbn == "" || title == "" || copyright == "" || edition == "" || price == "" || quantity == "") {
                alert("All fields are required.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>
