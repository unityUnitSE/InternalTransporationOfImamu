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
use 'dbconnection.php';

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
<style>
</style>
</head>
<body>
	<header>
		<h1 class="hd">INTERNAL TRANSPORTATION OF IMAMU</h1>
		<div class="home">
			<p class="menu">
				<a href="UserViewBuses.php">View Buses</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="BusBwStn.php">Buses Between Stations</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="BookBuses.php">Ticket Booking History</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="SearchBuses.php">Search By BusNo</a>
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
			<div  class='tab red'>

            <table class='main menu'>
               
                <tr >
                    <th >#</th>
                    <th>Book Number</th>
                    <th>Bus Number</th>
                    <th>From Station</th>
                    <th>To Station</th>
                    <th>Book Date</th>
                </tr>
               
                <?php
				// get user available Buses
				$stmt = $connection->prepare("select * from history join buses on buses.BS_NO = history.BS_NO Where MAILID=?;");
				$stmt->bind_param("s", $_SESSION['MAILID']);
				$stmt->execute();
				$reselt = $stmt->get_result();
				if($reselt->num_rows > 0){
				$i = 0;
					while($row = $reselt->fetch_assoc()){
					?>
                        <tr>
                            <td><?php echo ($i + 1); ?></td>
                            <td><?php echo $row['BusID']; ?></td>
                            <td><?php echo $row['BS_NO']; ?></td>
                            <td><?php echo $row['FROM_STN']; ?></td>
                            <td><?php echo $row['TO_STN']; ?></td>
                            <td><?php echo $row['DAYDATE']; ?></td>
                        </tr>
                <?php 
					$i++
					?>
					<?php 
					}
				}?>
            </table>
	</div>


	<footer>
				<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>

	</footer>
	</body>
</html>
