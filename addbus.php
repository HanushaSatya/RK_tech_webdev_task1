<?php 
$db = mysqli_connect('localhost', 'root', '');
mysqli_select_db($db, "bus") or die ("no database");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Bus</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
	<h2>Add Bus</h2>
</div>
<form method="post" action="addbus.php">
	<?php echo display_error(); ?>
	<div class="input-group">
		<label>Bus Id</label>
		<input type="number" name="busid">
	</div>
	<div class="input-group">
		<label>From Place</label>
		<input type="text" name="placef">
	</div>
	<div class="input-group">
		<label>To Place</label>
		<input type="text" name="placet">
	</div>
	<div class="input-group">
		<label>From Time</label>
		<input type="time" name="timef">
	</div>
	<div class="input-group">
		<label>To Time</label>
		<input type="time" name="timet">
	</div>
	<div class="input-group">
		<label>Date</label>
		<input type="date" name="date">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="addbus_btn">Add Bus</button>
	</div>
</form>
</body>
</html>
<?php
$errors=array();
$bid=isset($_POST['busid']) ? $_POST['busid'] : "";
$fplace=isset($_POST['placef']) ? $_POST['placef'] : "";
$tplace=isset($_POST['placet']) ? $_POST['placet'] : "";
$ftime=isset($_POST['timef']) ? $_POST['timef'] : "";
$ttime=isset($_POST['timet']) ? $_POST['timet'] : "";
$date=isset($_POST['date']) ? $_POST['date'] : "";
$tid=isset($_POST['addbus_btn']) ? getBusById($bid) : "";
if ($tid=="") {
	addbus();
}
else{
	echo "<br><b><font color='red'>Bus already Exists!<a href='delbus.php'>Delete</a> it first to add</font></br></br>";
}
function addbus() {
	global $db,$bid,$fplace,$tplace,$ftime,$ttime,$date,$errors;
	if (empty($bid)) { 
		array_push($errors, "Bus Id is required"); 
	}
	if (empty($fplace)) { 
		array_push($errors, "From Place is required"); 
	}
	if (empty($tplace)) { 
		array_push($errors, "To Place is required"); 
	}
	if (empty($ftime)) { 
		array_push($errors, "From Time is required"); 
	}
	if (empty($ttime)) { 
		array_push($errors, "To Time is required"); 
	}
	if (empty($date)) { 
		array_push($errors, "Date is required"); 
	}
	if (count($errors) == 0) {
		$query = "INSERT INTO bus_det (id, from_place, to_place, from_time, to_time, date) 
					 VALUES('$bid', '$fplace', '$tplace', '$ftime','$ttime','$date')";
		mysqli_query($db,$query);
		//$_SESSION['success']  = "New Bus successfully added!!";
		echo "<br><b><font color='green'>New Bus successfully ADDED!!</font></br></br>";
		//	header('location:home.php');
	}
}
function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}
function getBusById($bid){
	global $db,$bid;
	$query = "SELECT id FROM bus_det WHERE id = '$bid'";
	$result = mysqli_query($db, $query) or die(mysql_error());
	$id = mysqli_fetch_assoc($result);
	return $id;
}