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
include ('dbconnection.php');

$stmt = $connection->prepare("select * from admin where MAILID = ?");
$stmt->bind_param("s", $_SESSION['MAILID']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
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
				<a href="UserHome.php">Home</a>
			</p>
		</div>
		<div class="home">
			<p class="menu">
				<a href="UserViewBuses.php">View Buses</a>
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
	<div class="tab">
		<p class="menu">Buses Between Stations</p>
	</div>

	<div class="tab">
        <div class="Busbwstn-container">
            <div class="form-container">
                <form id="Busbwstn" name="Busbwstn" action="Busbwstn.php" method="post">
					<div id= "label"><label>From Station</label>
                    <input class="text-input" name="FROM_STN" placeholder="From Station" type="text">
					<span class="error" id="FROM_STN"></span><br><br>
					</div>
					<div id= "label"><label >To Station</label>
                    <input class="text-input" name="TO_STN" placeholder="To Station" type="text">
					<span class="error" id="TO_STN"></span><br><br>
					</div>
                    <button class="menu" type="submit" name="Busbwstn">Search Bus</button>
                </form>
            </div>	
        </div>    </div>
				<div  class='tab red'>
					<table class='main menu'>
					   
						<tr >
							<th>#</th>
							<th>Bus Number</th>
							<th>Bus Name</th>
							<th>From Station</th>
							<th>To Station</th>
						</tr>
					   
						 <?php
						 if (isset($_POST['Busbwstn'])) {
						// get user available Buses

								$sql = 'select * from buses Where FROM_STN=? or TO_STN=?';
								$stmt = $connection->prepare($sql);
								$stmt->bind_param('ss', $FROM_STN, $TO_STN);
								$FROM_STN = $_POST['FROM_STN'] ? : '';
								$TO_STN = $_POST['TO_STN'] ? : '';

						$stmt->execute();
						$reselt = $stmt->get_result();
						if($reselt->num_rows > 0){
						$i = 0;
							while($row = $reselt->fetch_assoc()){
							?>
								<tr>
									<td><?php echo ($i + 1); ?></td>
									<td><?php echo $row['BS_NO']; ?></td>
									<td><?php echo $row['BS_NAME']; ?></td>
									<td><?php echo $row['FROM_STN']; ?></td>
									<td><?php echo $row['TO_STN']; ?></td>
								</tr>
						<?php 
							$i++
							?>
							<?php 
							}
						 }}?>
					</table>
				</div>

	<br />
	<footer>
				<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>

	</footer>

</body>

</html>