<?php

    include("connection.php");
    session_start();
    if(isset($_POST['login']))
    {
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        $option = $_POST['select'];
        $_SESSION['select'] = $option;

        $query = "Select * from `admin` where `admin_email` = '$username' and `admin_password` = '$password';";
        $run = mysqli_query($conn, $query);
        $row = mysqli_num_rows($run);
        
        if($row < 1){
            ?>
            <script>
                alert("Username or Password is incorrect !!!");
                window.open('../Frontend/Login.html', '_self');
            </script>
            <?php
        }
        else
        {
            $data = mysqli_fetch_assoc($run);
            $id = $data['admin_ID'];
            $userEmail = $data['admin_email'];
            $userPassword = $data['admin_password'];

            $_SESSION['admin_ID'] = $id;
            $_SESSION['admin_email'] = $userEmail;
            $_SESSION['admin_password'] = $userPassword;

            header("location: admin.php");
        }
    }
?>
