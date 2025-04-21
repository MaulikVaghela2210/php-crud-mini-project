<?php 
  include("connection.php");
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
        <?php 
            if(isset($_SESSION['message'])) {
                echo "<p style='color: green; font-weight: bold;'>".$_SESSION['message']."</p>";
                unset($_SESSION['message']); // Remove message after displaying
            }
        ?>
     
    <div><br><br>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Student Form</h1>

        <label>Enter First Name: </label>
        <input type="text" name="firstname" placeholder="Enter First Name" required><br><br>

        <label>Enter Last Name: </label>
        <input type="text" name="lastname" placeholder="Enter Last Name" required><br><br>

        <label>Email: </label>
        <input type="email" name="email" placeholder="Enter Email" required><br><br>

        <label>Password: </label>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>

        <label>Phone: </label>
        <input type="number" name="phone" placeholder="Enter Phone Number" required><br><br>

        <label>Image: </label>
        <input type="file" name="image"><br><br>

        <input type="submit" name="savebtn" value="Save">
        <input type="reset" value="Reset">
        <button><a href="view.php">View Data</a></button>
    </form>
    </div>
</body>
</html>

<?php
if (isset($_POST["savebtn"])) {
    include("connection.php"); 

    
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $file_name = ""; 

    
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $file_name = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "Images/" . $file_name;

        if (move_uploaded_file($tempname, $folder)) {
            echo "File uploaded successfully!";
        } else {
            echo "File upload failed!";
            $file_name = ""; 
        }
    } else {
        echo "No file uploaded or upload error!";
    }

    
    $query = "INSERT INTO student (firstname, lastname, email, password, phone, image) 
              VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$file_name')";

    $data = mysqli_query($conn, $query);

    if ($data) {
        $_SESSION['message'] = "Data Saved Successfully!";
    } else {
        $_SESSION['message'] = "Data Not Saved!";
    }

    header("Location: index.php");
    exit();
}
?>
