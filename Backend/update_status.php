<?php
    include("connection.php");
    session_start();
    if(isset($_POST['login'])){
        // $_SESSION["res_ID"] = $_['respondent_ID'];
        // $_SESSION["complaint_ID"] = $data['complaint_ID'];
        $comp_id = $_POST['cmp_id'];
        $query = "Update `resolves` set `status`='Resolved' where `complaint_ID` = '$comp_id'";
        $query2 = "Update `complaint` set `resolve_date`=CURDATE() where `complaint_ID` = '$comp_id'";
        mysqli_query($conn, $query);
        mysqli_query($conn, $query2);

        echo $comp_id;
        ?>
            <script>
                window.open('respondent.php', '_self');
            </script>
        <?php
    }
    
?>