<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($mails,$pname,$yname,$yemail,$phoneno,$bg,$ur,$city,$message,$v_code){

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
		$mail->addAddress($mails);     //Add a recipient
	
		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Someone Need Your Help';
		$mail->Body    = "Patient Name : $pname<br>Companion Name : $yname<br>Campanion Email Address : $yemail<br>Contact No : $phoneno<br>Blood Group : $bg<br>
		Unit Required : $ur<br>City Name : $city<br>Some Extra Information : $message<br> Thanks For Help<br>
		Click the link below to verify that you help the patient<br>
		<a href='http://localhost/bi/verify1.php?email=$mails&v_code=$v_code'>Verify</a>";
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
		$mail->send();

		echo "<script>alart('Message has been sent')</script>";

		return true;
	}
	catch (Exception $e) {
		return false;
	}
}
//$insert = false;
if(isset($_POST['submit'])){
	$server ='localhost';
	$username = 'root';
	$password =  '';
	$db = 'bi';

	$con = mysqli_connect($server, $username, $password, $db);

	if(!$con){
		die("connection to this database failed due to" . mysqli_connect_error());
	}
	echo "success connecting to the db";

	$mails = $_POST['mails'];
	$pname = $_POST['pname'];
	$yname = $_POST['yname'];
	$yemail = $_POST['yemail'];
	$phoneno = $_POST['phoneno'];
	$bg = $_POST['bg'];
	$ur = $_POST['ur'];	
	$city = $_POST['city'];
	$message = $_POST['message'];
	$v_code=bin2hex(random_bytes(16));

	$sql = "INSERT INTO `rd`(`Email`, `Patient name`, `Your name`, `Your email`, `phone no`, `Blood group`, `Unit required`, `City`, `Message`, `verification_code`, `is_verified`, `Date`) VALUES ('$mails','$pname','$yname','$yemail','$phoneno','$bg','$ur','$city','$message','$v_code','0', CURRENT_TIMESTAMP())";
				
	if(mysqli_query($con,$sql) && sendMail($_POST['mails'],$pname,$yname,$yemail,$phoneno,$bg,$ur,$city,$message,$v_code)){
					
		echo"
		<script>
		alert('Email Sent Successful');
		window.location.href='search.php';
		</script>
		";
	}
	else
	{
		echo"
		<script>
		alert('Server Down');
		window.locaton.href='search.php';
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
	
	$con->close();

}
?>

<?php

	if(isset($_POST['search'])){
		$valueToSearch = $_POST['valueToSearch'];
		$query = "SELECT * FROM `bi` WHERE CONCAT(`Blood Group`) LIKE '%".$valueToSearch."%' AND `is_verified`='1'";
		$search_result = filterTable($query);
	}
	else{
		$query = "SELECT * FROM `bi` WHERE `is_verified`='1'";
		$search_result = filterTable($query);
	}
	function filterTable($query)
	{
		$connect = mysqli_connect("localhost","root","","bi");
		$filter_Result = mysqli_query($connect,$query);
		return $filter_Result;
	}

	
?>
<html>
<head>
	<style>
		body{
			background-color:#f1f1f1;
		}
		.bk{
			background:linear-gradient(to right,rgba(243,195,176,0.1),rgba(243,195,176,0.7));
			BORDER: 0px solid brown;
			border-width:0 0 0 35px;
			margin:0 150px 0 150px;
			padding:30px;
		}
		h1{
			color:#A30000;
			font-family:courier;
			font-size:110%;
			justify-content:center;
			text-align:center;
		}
		p{
			margin:0;
			padding:0;
			justify-content:center;
			text-align:LEFT;
			color:black;
			font-family:courier;
			font-size:150%;
		}
		h2{
			color:#A30000;
			font-family:courier;
		}
		.bk input[type="submit"]{
			align-items:center;
			justify-content:center;
			color:white;
			background:#db6551;
			padding:8px 12px ;
			font-size:13px;
			border:2px solid white;
			border-radius:14px;
			cursor:pointer;
		}
		.submit{
			align-items:center;
			justify-content:center;
			color:white;
			background:#db6551;
			padding:8px 12px ;
			font-size:15px;
			border:2px solid white;
			border-radius:14px;
			cursor:pointer;
		}
		.bk input[type="text"],input[type="email"],input[type="tel"]{
			border:none;
			border-bottom:1px solid #000000;
			background:transparent;
			ontline:none;
			height:40px;
			color:black;
			font-size:16px;
			position: relative;
			left:0%;
		}
		.bk textarea[type="text"]{
			border:none;
			border-bottom:1px solid #000000;
			background:transparent;
			ontline:none;
			height:40px;
			color:black;
			font-size:16px;
			position: relative;
			left:0%;
		}
	</style>
	<link rel="stylesheet" href="navbar.css">
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
	<form action="search.php" method="post">
		<input type="text" name="valueToSearch" placeholder = "Blood Group Search">
		<input type="submit" name="search" Value="Filter" ><br><br>
	<table style="width:"200%" height:"100% border-style:"ridge"" align="top" border="1px solid black" >
		<tr>
			<th><h1>Blood Group</th></h1>
			<th><h1>First Name</th></h1>
			<th><h1>Last Name</th></h1>
			<th><h1>Date of Birth</th></h1>
			<th><h1>Gender</th></h1>
			<th><h1>E-mail</th></h1>
			<th><h1>Phone no</th></h1>
			<th><h1>City</th></h1>
		</tr>
	<?php
		while($rows = mysqli_fetch_array($search_result,MYSQLI_ASSOC))
		{
	?>
		<tr>
			<td><?php echo $rows['Blood Group']; ?></td>
			<td><?php echo $rows['First name']; ?></td>
			<td><?php echo $rows['Last name']; ?></td>
			<td><?php echo $rows['Date of Birth']; ?></td>
			<td><?php echo $rows['Gender']; ?></td>
			<td><?php echo $rows['Email']; ?></td>
			<td><?php echo $rows['Phone']; ?></td>
			<td><?php echo $rows['City']; ?></td>
		</tr>
	<?php
		}
	?>
	
	</table><br> <br>

	<h2><u>Send Request To Donor For Help !</u></h2>

	<p>Email</p>
	<input type="email" name="mails" placeholder="Donor Email" id="mails" ><br><br>
	
	<p>Patient Name</p>
	<input type="text" name="pname" placeholder="Patient Name" id="pname" required onkeyup="jump(this,'ln')" /><br><br>
	
	<p>Your Name</p>
	<input type="text" name="yname" placeholder="Your Name" id="yname" required onkeyup="jump(this,'bg')" /><br><br>
	
	<p>Your Email Address</p>
	<input type="email" name="yemail" placeholder="Email" id="yemail" required ><br><br>
	
	<p>Phone Number</p>
	<input type="tel" name="phoneno" placeholder="12345 67890" id="phoneno" pattern="[0-9]{5} [0-9]{5}" required><br><br>

	<p>Blood Group</p>
	<input type="text" name="bg" placeholder="Blood Group" id="bg" required onkeyup="jump(this,'g')" /><br><br>
	
	<p>Unit Required</p>
	<input type="text" name="ur" placeholder="Unit Required" id="ur" required onkeyup="jump(this,'g')" /><br><br>
	
	<p>City</p>
	<input type="text" name="city" placeholder="City Name" id="city" required><br><br>

	<p>Message</p>
	<textarea type="text" name="message" placeholder="Message For Donor" id="message"  rows="8" cols="30"></textarea><br><br>

	<p><button name="submit" class="submit">Send Request</button></p>

	<!--Email : <input name="mails" type="text" /><br /><br />--
	Subject : <input name="subject" type="text" /><br /><br />
	Message:<br />
	<textarea name="message" rows="15" cols="40"></textarea><br /><br />
	<input name="submit" type="submit" />-->

	</form>	
</body>
</html>



	
