<?php
include("Connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link rel="stylesheet" href="mystyle.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <button><a href="./index.php">Home</a></button><br>
    <div>
    <table border="1px" cellpadding="10" cellspacing="2">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Image</th>
            <th colspan="2">Actions</th>
        </tr>
    <br>
    <?php 
        $query = "SELECT * FROM student";
        $result = mysqli_query($conn, $query);
        $data = mysqli_num_rows($result);
        if ($data) {
            while ($row = mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td><?php echo $row['firstname'] ?></td>
                    <td><?php echo $row['lastname'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['password'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td>
                        <img src="Images/<?php echo $row['image']; ?>" alt="Student Image" width="100" height="100">
                    </td>
                    <td><a href="update.php?id=<?php echo $row['id']?>">Edit</a></td>
                    <td><a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)">Delete</a></td>
                </tr>


                <?php
            }
        }
        else {
        ?> 
        <tr>
            <td>No Data Found</td>
        </tr>
        <?php

            }
        ?>
     
        
    </table>
    </div>




    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Data will be deleted permanently!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `delete.php?id=${id}`;
            }
        })
    }
</script>
   
</body>
</html>