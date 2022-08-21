<?php

	if(isset($_POST['search'])){
		$valueToSearch = $_POST['valueToSearch'];
		$query = "SELECT * FROM `rd` WHERE CONCAT(`Blood Group`) LIKE '%".$valueToSearch."%' AND `is_verified`='0'";
		$search_result = filterTable($query);
	}
	else{
		$query = "SELECT * FROM `rd` WHERE `is_verified`='0'";
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
<div class="bk"><h1>Pending Request</h1>
	<form action="search.php" method="post">
		<input type="text" name="valueToSearch" placeholder = "Blood Group Search">
		<input type="submit" name="search" Value="Filter" ><br><br>
	<table style="width:"200%" height:"100% border-style:"ridge"" align="top" border="1px solid black" >
		<tr>
			<th><h1>Patient Name</th></h1>
			<th><h1>Companion Name</th></h1>
			<th><h1>Campanion Email</th></h1>
			<th><h1>Contact No</th></h1>
			<th><h1>Blood Group</th></h1>
			<th><h1>Unit Required</th></h1>
			<th><h1>City Name</th></h1>
			<th><h1>Message</th></h1>
            <th><h1>Date</th></h1>
		</tr>
	<?php
		while($rows = mysqli_fetch_array($search_result,MYSQLI_ASSOC))
		{
	?>
		<tr>
			<td><?php echo $rows['Patient name']; ?></td>
			<td><?php echo $rows['Your name']; ?></td>
			<td><?php echo $rows['Your email']; ?></td>
			<td><?php echo $rows['phone no']; ?></td>
			<td><?php echo $rows['Blood group']; ?></td>
			<td><?php echo $rows['Unit required']; ?></td>
			<td><?php echo $rows['City']; ?></td>
			<td><?php echo $rows['Message']; ?></td>
            <td><?php echo $rows['Date']; ?></td>
		</tr>
	<?php
		}
	?>
	
	</table>
	</form>	
</body>
</html>
