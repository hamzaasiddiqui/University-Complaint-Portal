<head>
    <title>UCP</title>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<?php
session_start();
// if(isset($_SESSION['userID']))
// {
// 	echo "";
// }
// else
// {
// 	header('location:login.php');
// }
?>
<head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand">UCP</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="../Frontend/home.html">Home<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link active" href="#">Login<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link " href="../Frontend/admin.html">Admin<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="../Frontend/respondent.html">Respondent<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" id="about" href="../Frontend/home.html">Logout<span class="sr-only">(current)</span></a>
        </div>
    </div>
    </nav>

    <table class="table text-light" style="background-color: #0a6756c7; ">
        <tr>
            <td>USERNAME: <?php echo $_SESSION['user_name']?></td>
            <td>EMAIL: <?php echo $_SESSION['user_email']?></td>
        </tr>
        <tr>
            <td>BATCH: <?php echo $_SESSION['batch']?></td>
            <td>FACULTY: <?php echo $_SESSION['faculty']?></td>
        </tr>
        <tr>
            <td>PROGRAM: <?php echo $_SESSION['program']?></td>
            <td>HOSTEL: <?php echo $_SESSION['hostel']?> (ROOM:<?php echo $_SESSION['room']?>)</td>
        </tr>
    </table>

<?php
	include('connection.php');
?>
	
	<form action = "lodge_complain.php" method = "post" enctype = "multipart/form-data" style="margin-top: 50px;">
	<table border = "1" width = "50%" align = "center" cellpadding = "6px" cellspacing = "0px" bgcolor = " #067567 " style = "margin-top : -20px;">
		<tr>
			<td align = "center">complaint ID</td> <td><input type = "text" name = "complaint_id" style = "width : 53%; " placeholder = "Complaint ID" required /></td>
		</tr>
		<tr>
			<td align = "center">Issue Date</td> <td><input type = "text" name = "issue_date" style = "width : 53%; " placeholder = "YYYY-MM-DD" required  /></td>
		</tr>
		
		<tr>
            <td align = "center">Complaint Type
                <td>
                    <select class="form-control" name="select">
                        <option>Hostel</option>
                        <option>Academic</option>
                        <option>Medical</option>
                        <option>Food & Utility</option>
                        <option>Others</option>
                    </select>
                </td>
            </td>
        </tr>
		<tr>
            <td align = "center" >Description</td> <td><input type = "text" name = "description" style = "width : 53%; " placeholder = "Description" required  /></td>
		</tr>
	</table>
    <input type="submit" value="submit" name="submit">
	</form>
	</div>
</body>


<?php
	
	if(isset($_POST['submit']))
	{
		$complaint_id = $_POST['complaint_id'];      
        $issue_date = $_POST['issue_date'];
        $resolve_date = $_POST['resolve_date'];
        $complaint_type = $_POST['complaint_type'];
        $description = $_POST['description'];
		
		
		$qry = "INSERT INTO `complaint`
				VALUES ('$complaint_id', '$issue_date', '$resolve_date', '$_POST[select]', '$description',  '$_SESSION[userID]')";
		$run = mysqli_query($conn, $qry);
		if($run == True and $_SESSION['select'] == 'Student')
		{
			?>
			<script>
				alert("Data Inserted Successfully! Please wait for admin to assign your complaint to a respondent.");
				window.open('student.php', '_self');
			</script>
			<?php
		}
        else if($run == True and $_SESSION['select'] == 'Faculty Member'){
            ?>
			<script>
				alert("Data Inserted Successfully! Please wait for admin to assign your complaint to a respondent.");
				window.open('faculty_member.php', '_self');
			</script>
			<?php

        }
        else if($run == True and $_SESSION['select'] == 'Labourer'){
            ?>
			<script>
				alert("Data Inserted Successfully! Please wait for admin to assign your complaint to a respondent.");
				window.open('labourer.php', '_self');
			</script>
			<?php

        }
		
	}
?>