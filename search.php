<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
if (isset($_POST['submit_btn'])) {
	display();
}
function display() {
$search1=isset($_POST['search']) ? $_POST['search'] : ""; 
	if( strlen( $search1 ) <= 1 ) 
		echo "Search term too short"; 
	else 
	{ 
		$conn=mysqli_connect("localhost","root","","bus");
		if(!$conn)
			echo "Connection not established";
		else {
			$query = " SELECT * FROM bus_det WHERE id=$search1 "; 
			$res = mysqli_query($conn,$query);  
			if (mysqli_num_rows($res)<=0)
				echo "Sorry, there are no matching result for <b> $search1.</b>"; 
			else
			{ 
				while( $row = mysqli_fetch_array($res) ) 
				{ 
					$fromplace = $row ['from_place']; 
					$toplace = $row ['to_place']; 
					$stime = $row['from_time'];
					$etime = $row['to_time'];
					$date = $row ['date'];
				echo "<table align='center' class='TFtableCol'><tr><td>BusId</td><td>$search1</td></tr><tr><td>Bus Route</td><td>$fromplace-$toplace</td></tr>
				          <tr><td>Timings</td><td>$stime-$etime</td></tr><tr><td>Date</td><td>$date</td></tr></table>";
				} 
			} 
		} 
	} 
}
 ?>
<html>
<head>
<style type="text/css">
* { margin: 0px; padding: 0px; }
body {
	font-size: 120%;
	background-image:url(img1.png);
	background-repeat:no-repeat;
	background-position:center;
	background-color:Lightblue;
}
a{
    background-color:#F8C471;
    padding: 8px 20px;
    text-decoration:none;
    font-weight:bold;
    border-radius:5px;
    cursor:pointer;
}
.TFtableCol{
		width:30%; 
		border-collapse:collapse; 
		table-layout: fixed;
		margin-top: 40px;
		margin-bottom: 25px;
		margin-left: 450px;
		margin-right: 150px;
	}
	.TFtableCol td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* improve visual readability for IE8 and below */
	.TFtableCol tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD table columns  */
	.TFtableCol tr td:nth-child(odd){ 
		background: #EBDEF0;
	}
	/*  Define the background color for all the EVEN table columns  */
	.TFtableCol tr td:nth-child(even){
		background: #EBDEF0;
	}
form, .content {
	width: 40%;
	margin: 0px auto;
	padding: 20px;
	border: 1px solid #B0C4DE;
	background: white;
	border-radius: 0px 0px 10px 10px;
}
.input-group {
	margin: 10px 0px 10px 0px;
}
.input-group label {
	display: block;
	text-align: left;
	margin: 3px;
}
.input-group input {
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
#searchbar{ 
	margin-left: 15%; 
	padding:15px; 
	border-radius: 10px; 
} 
input[type=text] { 
	width: 30%; 
	-webkit-transition: width 0.15s ease-in-out; 
	transition: width 0.15s ease-in-out; 
} 
input[type=text]:focus { 
	width: 70%; 
} 
#list{ 
	font-size: 1.5em; 
	margin-left: 90px; 
}
#user_type {
	height: 40px;
	width: 98%;
	padding: 5px 10px;
	background: white;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid gray;
}
.button {
	padding: 10px;
	font-size: 15px;
	color: white;
	background: #5F9EA0;
	border: none;
	border-radius: 5px;
}
.error {
	width: 92%; 
	margin: 0px auto; 
	padding: 10px; 
	border: 1px solid #a94442; 
	color: #a94442; 
	background: #f2dede; 
	border-radius: 5px; 
	text-align: left;
}
.success {
	color: #3c763d; 
	background: #dff0d8; 
	border: 1px solid #3c763d;
	margin-bottom: 20px;
}
</style>
</head>
<body>
<h1 align="center"><font color="red" size="10"><b>Check Your Bus</b></font></h1><font size="5"><b>
<a href="home.php" target="_blank">Home</a></b></font>
<form name="f1" method="post" action="search.php">
<label><b><font size="10">Search Your Bus</font></b></label>
<input id="searchbar" type="search" name="search" placeholder="Enter bus no./id">
<input type="submit" name="submit_btn" class="button" placeholder="Submit">
</form>
</body>
</html>