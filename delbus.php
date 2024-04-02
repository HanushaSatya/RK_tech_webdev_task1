<?php
$db = mysqli_connect('localhost', 'root', '');
mysqli_select_db($db, "bus") or die ("no database");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete Bus</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Delete Bus</h2>
	</div>
	<form method="post" action="delbus.php">
		<div class="input-group">
			<label>Bus Number</label>
			<input type="number" name="busid" >
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="delbus_btn">Submit</button>
		</div>
	</form>
</body>
</html>
<?php
$bid=isset($_POST['busid']) ? $_POST['busid'] : "";
$tid=isset($_POST['delbus_btn']) ? getBusById($bid) : "";
if ($bid==$tid) {
	delbus($bid);
}
else if($bid==""){
	echo "<b><font color='red'>Please Enter Bus Id</font></b>";
}
else {
	echo "<b><font color='red'>Bus doesn't Exists</font></b>";
}
function delbus($bid) {
	global $db,$bid;
	$query="DELETE FROM bus_det WHERE id = '$bid'";
	$result = mysqli_query($db, $query);
	if($result) {
		echo "<br><b><font color='green'>Bus details DELETED successfully !!</font></br></br>";
	}
}
function getBusById($bid){
	global $db,$bid;
	$query = "SELECT id FROM bus_det WHERE id = '$bid'";
	$result = mysqli_query($db, $query) or die(mysql_error());
	$id = mysqli_fetch_assoc($result);
	return $id;
}
?>