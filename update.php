<?php
include("Connection.php");
$id = $_GET['id'];

$query = "SELECT * FROM student WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <h1 style="text-align: center;">Update Data</h1>
    <div>
    <br>    
    <form action="" method="POST" enctype="multipart/form-data">
       <label>FirstName:</label> 
       <input type="text" value="<?php echo $row['firstname']?>" name="firstname" placeholder="firstname"><br><br>
       
       <label>LastName:</label> 
       <input type="text" value="<?php echo $row['lastname']?>" name="lastname" placeholder="lastname"><br><br>
       
       <label>Email:</label> 
       <input type="text" value="<?php echo $row['email']?>" name="email" placeholder="email"><br><br>
       
       <label>Password:</label> 
       <input type="text" value="<?php echo $row['password']?>" name="password" placeholder="password"><br><br>
       
       <label>Phone:</label> 
       <input type="text" value="<?php echo $row['phone']?>" name="phone" placeholder="phone"><br><br>
       
       <!-- Show Current Image -->
       <label>Current Image:</label>
       <img src="Images/<?php echo $row['image']; ?>" width="100" height="100"><br><br>

       <label>Upload New Image:</label> 
       <input type="file" name="image"><br><br>
       
       <input type="submit" name="updatebtn" value="Update">
       <input type="reset" value="Reset">
       <button><a href="view.php">Back</a></button>
    </form>
    </div>
</body>
</html>

<?php 
if(isset($_POST["updatebtn"])){
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    
   
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $file_name = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "Images/" . $file_name;

        
        if(move_uploaded_file($tempname, $folder)) {
            echo "File uploaded successfully!";
        } else {
            echo "File upload failed!";
            $file_name = $row["image"]; 
        }
    } else {
        $file_name = $row["image"]; 
    }

   
    $query = "UPDATE student SET firstname='$fname', lastname='$lname', email='$email', password='$password', phone='$phone', image='$file_name' WHERE id='$id'";

    $data = mysqli_query($conn, $query);

    if($data){
?>
        <script type="text/javascript">
            alert("Data Updated Successfully");
            window.location.href = "view.php";
        </script>
<?php 
    } else {
?>
        <script type="text/javascript">
            alert("Data Not Updated");
        </script>
<?php 
    }
}
?>
