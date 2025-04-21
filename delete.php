<?php
include("Connection.php");
$id = $_GET['id'];

$query = "DELETE FROM student WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if($result){
?>
    <script type="text/javascript">
            alert("Data Deleted Successfully");
            window.open("http://localhost/phpcrud/view.php","_self");
    </script>

    <?php 
    }
    else
    {
    ?>

    <script type="text/javascript">
            alert("Data Not Delete Try Again!");
            window.open("http://localhost/phpcrud/view.php","_self");
    </script>

    
    <?php
    }
    ?>