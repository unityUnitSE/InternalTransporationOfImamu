<?php
session_start();

?>
<?php
if (!isset($_SESSION['MAILID'])) {
?>
    <div class="common-container">
        <h1>Unauthorized Access!</h1>
        <p>
            You are not authorized to access this page.
            Please <a href="index.php">click here</a> to login first.
        </p>
    </div>
<?php
    exit();
}
use 'dbconnection';

$stmt = $connection->prepare("select * from admin where MAILID = ?");
$stmt->bind_param("s", $_SESSION['MAILID']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="ISO-8859-1">
<title>E-Buses</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1 class="hd">INTERNAL TRANSPORTATION OF IMAMU</h1>
		<div class="home">
			<p class="menu">
				<a href="AdminHome.php">Home</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="ViewBuses.php">View Buses</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="AddBuses.php">Add Bus</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="CancleBus.php">Delete Bus </a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="AdminUpdateBus.php">Update Bus Details</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="index.php">Logout</a>
			</p>
		</div>
	</header>
	
	<div >
		<h1 class="main">Hey <?php echo $user['FNAME'] ?> <?php echo $user['LNAME'] ?> ! Welcome</h1>
	</div>
	<div class="main">
		<p class="menu">Search Buses</p>
	</div>
	<form action="adminsearchBus" class="tab red" method="post">
		<br /> BusNumber: <input type="text" name="Busnumber"><br />
		<br /> <input type="submit" value=" SEARCH Bus "><br />
	</form>
	<br />
	<footer>
				<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>
	</footer>
</body>
</html>
