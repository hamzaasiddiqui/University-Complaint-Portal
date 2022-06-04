<?php

    include("connection.php");
    session_start();
    if(isset($_POST['login']))
    {
        $username = $_POST['uname'];
        $password = $_POST['pass'];
        $option = $_POST['select'];
        $_SESSION['select'] = $option;

        $query = "Select * from `user` where `user_email` = '$username' and `user_password` = '$password';";
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
            $id = $data['userID'];
            $userEmail = $data['user_email'];
            $userName = $data['user_name'];
            $userPassword = $data['user_password'];

            $_SESSION['userID'] = $id;
            $_SESSION['user_email'] = $userEmail;
            $_SESSION['user_name'] = $userName;
            $_SESSION['user_password'] = $userPassword;
        }
        if($option == 'Student'){
            $query2 = "SELECT * FROM `student` where `stu_id` = '$id'";
            $run2 = mysqli_query($conn, $query2);
            $row2 = mysqli_num_rows($run2);

            if($row2 < 1){
                ?>
                <script>
                    alert("Username or Password is incorrect !!!");
                    window.open('../Frontend/Login.html', '_self');
                </script>
                <?php
            }
            else{
                $data2 = mysqli_fetch_assoc($run2);
                $_SESSION['batch'] = $data2['batch'];
                $_SESSION['faculty'] = $data2['faculty'];
                $_SESSION['program'] = $data2['program'];
                $_SESSION['hostel'] = $data2['hostel'];
                $_SESSION['room'] = $data2['room'];
                header("location:student.php");
            }
        }
        else if ($option == 'Faculty Member'){
            $query2 = "SELECT * FROM `faculty_member` where `faculty_id` = '$id'";
            $run2 = mysqli_query($conn, $query2);
            $row2 = mysqli_num_rows($run2);

            if($row2 < 1){
                ?>
                <script>
                    alert("Username or Password is incorrect !!!");
                    window.open('../Frontend/Login.html', '_self');
                </script>
                <?php
            }
            else{
                $data2 = mysqli_fetch_assoc($run2);
                $_SESSION['faculty_ID'] = $data2['faculty_ID'];
                $_SESSION['faculty'] = $data2['faculty'];
                $_SESSION['occupation'] = $data2['occupation'];
                $_SESSION['office'] = $data2['office'];
                header("location:faculty_member.php");
            }
        }

        else if($option == 'Labourer'){
            $query2 = "SELECT * FROM `labourer` where `labour_id` = '$id'";
            $run2 = mysqli_query($conn, $query2);
            $row2 = mysqli_num_rows($run2);

            if($row2 < 1){
                ?>
                <script>
                    alert("Username or Password is incorrect !!!");
                    window.open('../Frontend/Login.html', '_self');
                </script>
                <?php
            }
            else{
                $data2 = mysqli_fetch_assoc($run2);
                $_SESSION['faculty'] = $data2['faculty'];
                $_SESSION['hostel'] = $data2['hostel'];
                $_SESSION['service'] = $data2['service'];
                header("location:labourer.php");
            }
        }
    }
?>
