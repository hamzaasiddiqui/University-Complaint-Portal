<?php
    include("connection.php");
    session_start();
    if(isset($_POST['login'])){
        // $_SESSION["res_ID"] = $_['respondent_ID'];
        // $_SESSION["complaint_ID"] = $data['complaint_ID'];
        $comp_id = $_POST['cmp_id'];
        $res_id = $_POST['select'];
        $query3 = "INSERT INTO `resolves` VALUES('$res_id', '$comp_id', 'Unresolved');";
        mysqli_query($conn, $query3);
        ?>
            <script>
                alert("RESPONDENT ID ASSIGNED SUCCESSFULLY");
                window.open('admin.php', '_self');
            </script>
        <?php
    }
    
?>