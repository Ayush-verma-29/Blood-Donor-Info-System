<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($email,$v_code){

	require('PHPMailer/Exception.php');
	require('PHPMailer/SMTP.php');
	require('PHPMailer/PHPMailer.php');

	$mail = new PHPMailer(true);

	try {
		//Server settings
		//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'prakharv385@gmail.com';                     //SMTP username
		$mail->Password   = 'agyr uubi ggom atot';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	
		//Recipients
		$mail->setFrom('prakharv385@gmail.com', 'BI Website');
		$mail->addAddress($email);     //Add a recipient
	
		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Email Verification From BI Website';
		$mail->Body    = "Thanks For Registration!<br>
		Click the link below to verify the email address<br>
		<a href='http://localhost/bi/verify.php?email=$email&v_code=$v_code'>Verify</a>";
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
		$mail->send();
		return true;
	}
	catch (Exception $e) {
		return false;
	}
}
$insert = false;
if(isset($_POST['fname'])){
	$server ='localhost';
	$username = 'root';
	$password =  '';
	$db = 'bi';

	$con = mysqli_connect($server, $username, $password, $db);

	if(!$con){
		die("connection to this database failed due to" . mysqli_connect_error());
	}
	echo "success connecting to the db";

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$bg = $_POST['bg'];	
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$phoneno = $_POST['phoneno'];
	$city = $_POST['city'];
	//$sql = "INSERT INTO `bi`.`bi` (`Blood Group`,`First name`, `Last name`, `Date of Birth`, `Gender`, `Email`, `Phone`, `Date`) VALUES ('$bg','$fname', '$lname', '$dob', '$gender', '$email', '$phoneno', CURRENT_TIMESTAMP());";
	//echo $sql;

	if(isset($_POST['btn'])){
		$user_exist_query="SELECT * FROM `bi` WHERE `Email`='$_POST[email]'";
		$result=mysqli_query($con,$user_exist_query);

		if($result){
			if(mysqli_num_rows($result)>0){
				echo "
				<script>
				alert('Email Already Taken');
				window.location.href='registration.php';
				</script>
				";
			}
			else{
				$v_code=bin2hex(random_bytes(16));
				$sql = "INSERT INTO `bi`.`bi` (`Blood Group`,`First name`, `Last name`, `Date of Birth`, `Gender`, `Email`, `Phone`, `City`, `Date`, `verification_code`, `is_verified`) VALUES ('$bg','$fname', '$lname', '$dob', '$gender', '$email', '$phoneno', '$city', CURRENT_TIMESTAMP(), '$v_code', '0')";
			
				if(mysqli_query($con,$sql) && sendMail($_POST['email'],$v_code)){
					echo"
					<script>
					alert('Registration Successful');
					window.location.href='registration.php';
					</script>
					";
				}
				else
				{
					echo"
					<script>
					alert('Server Down');
					window.locaton.href='registration.php';
					</script>
					";
				}
				//*if($con->query($sql) === true)
				//{
					//echo "Successfully inserted";
				//	$insert = true;
				//}
				//else{
				//	echo "ERROR: $sql <br> $con->error";
				//}
			}

		}
	}
	
	$con->close();

}
?>
<html>
<head>
	<style>
		body{
			background-color:#f1f1f1;
			justify-content:center;
			align-items:center;
		}
		h1{
			color:#A30000;
			font-family:courier;
			font-size:300%;
			justify-content:center;
			text-align:center;
		}
		p{
			margin:0;
			padding:0;
			justify-content:center;
			text-align:left;
			color:black;
			font-family:courier;
			font-size:160%;
			position: relative;
			left:39%;
		}
		.bk{
			background:linear-gradient(to right,rgba(243,195,176,0.1),rgba(243,195,176,0.7));
			BORDER: 0px solid brown;
			border-width:0 0 0 25px;
			margin:0 15% 0 15%;
			padding:30px;
		}
		.bk input{
			width :25%;
			margin-bottom:20px;
		}
		.bk input[type="text"],input[type="date"],input[type="list"],input[type="email"],input[type="tel"]{
			border:none;
			border-bottom:1px solid #000000;
			background:transparent;
			ontline:none;
			height:40px;
			color:black;
			font-size:16px;
			position: relative;
			left:39%;
		}
		.btn{
			align-items:center;
			justify-content:center;
			color:white;
			background:#db6551;
			padding:8px 12px ;
			font-size:20px;
			border:2px solid white;
			border-radius:14px;
			cursor:pointer;
		}

	</style>
	<link rel="stylesheet" href="navbar.css">
	<script src="valid.js"></script>
</head>
<body>
<ul>
	<li class="dropdown">
		<a href="javascript:void(0)" class="dropbtn">=</a>
		<div class="dropdown-content">
		 <a href="#">link 1</a>
		 <a href="#">link 2</a>
		 <a href="#">link 3</a>
		</div>

	</li>
	<li><a href="index.html">Home</a></li>
	<li><a href="search.php">Search</a></li>
	<li><a href="request.php">Request</a></li>
	<li><a href="registration.php">Sign Up</a></li>
	<li><a href="ABOUT.HTML">About</a></li>
</ul><br>
	<div class="bk">
	<h1>SIGN-UP</H1>
	<form name="registration" method="post" action="registration.php" onclick="return validate()">
		<p>First Name</p>
		<input type="text" name="fname" placeholder="First Name" id="fname" required onkeyup="jump(this,'ln')" />
		<p>Last Name</p>
		<input type="text" name="lname" placeholder="Last Name" id="lname" required onkeyup="jump(this,'bg')" />
		<p>Blood Group</p>
		<input type="text" name="bg" placeholder="Blood Group" id="bg" required onkeyup="jump(this,'g')" />
		<p>Date Of Birth</p>
		<input type="date" name="dob" placeholder="dd-mm-yyyy" id="dob" required >
		<p>Gender</p>
		<input type="text" list="genders" name="gender" placeholder="gender" id="gender"  required>
			<datalist id="genders">
			<option value="Male">
			<option value="Female">
			<option value="Transgender">
			</datalist>
		<p>Email</p>
		<input type="email" name="email" placeholder="Email" id="email" required >
		<p>phone Number</p>
		<input type="tel" name="phoneno" placeholder="12345 67890" id="phoneno" pattern="[0-9]{5} [0-9]{5}" required>
		<p>City</p>
		<input type="text" name="city" placeholder="City Name" id="city" required>
		<p><center><button name="btn" class="btn">Submit</button></center></p>
		<?php
			if($insert == true){
			echo "<p>Thanks for Submittng</p>";
			}
		?>
	</form>
	</div>
<script>
	window.onload = function(){
	fn.value = "";
	ln.value = "";
	dob.value = "";
	}	
	function jump(field, autoMove){
		if(field.value.length >= field.maxlength){
			document.getElementById(autoMove).focus();
		}
	}
</script>
</body>
</html>
 