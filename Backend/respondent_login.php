<?php

    include("connection.php");
    session_start();
    if(isset($_POST['login']))
    {
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        $query = "Select * from `respondent` where `respondent_email` = '$username' and `respondent_password` = '$password';";
        $run = mysqli_query($conn, $query);
        $row = mysqli_num_rows($run);
        
        if($row < 1){
            ?>
            <script>
                alert("Username or Password is incorrect !!!");
                window.open('../Frontend/Respondent.html', '_self');
            </script>
            <?php
        }
        else
        {
            $data = mysqli_fetch_assoc($run);
            $id = $data['respondent_ID'];
            $userEmail = $data['respondent_email'];

            $_SESSION['respondent_ID'] = $id;
            $_SESSION['respondent_email'] = $userEmail;

            header("location: respondent.php");
        }
    }
?>
