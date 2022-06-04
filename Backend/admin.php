<?php
session_start();
include("connection.php");
// if(!isset($_SESSION['id'])){
//     header("location:../Frontend/login.html");
// }
?>


<head>
    <title>UCP</title>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand">UCP</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="../Frontend/home.html">Home<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="../Frontend/Login.html">Login<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="#">Admin<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="../Frontend/respondent.html">Respondent<span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" id="about" href="../Frontend/home.html">Logout<span class="sr-only">(current)</span></a>
            </div>
        </div>
    </nav>
    <table class="table text-light" style="background-color: #0a6756c7;">
        <tr>
            <td>ID: <?php echo $_SESSION['admin_ID']?></td>
            <td>EMAIL: <?php echo $_SESSION['admin_email']?></td>
        </tr>
    </table>

    <table class="table" style="margin-top: 50px;">
    <thead class="thead-dark">
        <tr>
            <th>LIST OF UNASSIGNED COMPLAINTS</th>
        </tr>
        <tr>
            <th scope="col">Complaint ID</th>
            <th scope="col">Issue Date</th>
            <th scope="col">Resolve Date</th>
            <th scope="col">Complaint Type</th>
            <th scope="col">Description</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>

    <?php
    $query = "SELECT `complaint_ID`, `issue_date`, `resolve_date`, `complaint_type`, `description`
            FROM `complaint`
            WHERE `complaint_ID` NOT IN
            (
                SELECT `complaint_ID`
                FROM `resolves`
            )";
    $query2 = "select `respondent_ID` from `respondent`;";
    $run = mysqli_query($conn, $query);
    $row = mysqli_num_rows($run);
    if($row < 1){
        echo "<tbody>
                <tr>
                <td>NO RECORD FOUND</td>
                </tr>";
    }
    else{
        
        while($data = mysqli_fetch_assoc($run)){
            ?> 
                <form method="post" action="submit_resid.php">
                <tr>
                    <td><?php echo $data['complaint_ID']?></td>
                    <td><?php echo $data['issue_date']?></td>
                    <td><?php echo $data['resolve_date']?></td>
                    <td><?php echo $data['complaint_type']?></td>
                    <td><?php echo $data['description']?></td>
                    <td><select class="form-control" name="select">
                        <?php
                            $run2 = mysqli_query($conn, $query2);
                            while($data2 = mysqli_fetch_assoc($run2)){
                                ?>
                                <option><?php echo $data2['respondent_ID']?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </td>
                    <td>
                        <input name="cmp_id" type="hidden" value="<?php echo $data['complaint_ID']; ?>"/>
                        <input type = "submit" name = "login" value = "Assign Respondent" style = " width : 100%; height : 40px; border: none;
                        outline: none; padding: 10px 20px; border-radius: 50px; color: #fff; background: #000; margin-bottom: 50px; box-shadow: 0 3px 20px 0 #0000003b;cursor: pointer;" />
                        
                    </td>
                </tr>
                </form>
            <?php
            
        }
    }
    ?>
    
    <table class="table" style="margin-top: 50px;">
    <thead class="thead-dark">
        <tr>
            <th>LIST OF ASSIGNED COMPLAINTS</th>
        </tr>
        <tr>
            <th scope="col">Complaint ID</th>
            <th scope="col">Issue Date</th>
            <th scope="col">Resolve Date</th>
            <th scope="col">Complaint Type</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
        </tr>
    </thead>

    <?php
    $query = "SELECT `complaint`.`complaint_ID`, `complaint`.`issue_date`, `complaint`.`resolve_date`, `complaint`.`complaint_type`, `complaint`.`description`, `resolves`.`status`
            FROM `complaint` JOIN `resolves`
            ON `complaint`.`complaint_ID` = `resolves`.`complaint_ID`
            WHERE `complaint`.`complaint_ID` IN
            (
                SELECT `complaint_ID`
                FROM `resolves`
            )";
    $run = mysqli_query($conn, $query);
    $row = mysqli_num_rows($run);
    if($row < 1){
        echo "<tbody>
                <tr>
                <td>NO RECORD FOUND</td>
                </tr>";
    }
    else{
        while($data = mysqli_fetch_assoc($run)){
            ?> 
                <tr>
                    <td><?php echo $data['complaint_ID']?></td>
                    <td><?php echo $data['issue_date']?></td>
                    <td><?php echo $data['resolve_date']?></td>
                    <td><?php echo $data['complaint_type']?></td>
                    <td><?php echo $data['description']?></td>
                    <td><?php echo $data['status']?></td>
                </tr>
            <?php
        }
    }
    ?>
</body>
