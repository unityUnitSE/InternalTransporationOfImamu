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
include 'dbconnection.php';

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
<style>
</style>
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
				<a href="BusBwStn.php">Buses Between Stations</a>
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
	
	<div class="main">
		<p class="menu">Book Buses</p>
	</div>
	<div class="tab">
		<p class="menu red">
			Please Check The <a href='Availability.html'>Seat availability</a>
			before Booking !
		</p>
	</div>
	<div class="tab">
        <div class="BookBuses-container">
            <div class="form-container">
                <form id="BookBuses" name="BookBuses" action="BookBuses.php" method="post">
					<div id= "label"><label for="BS_NO">Bus Number</label>
                    <input class="text-input" name="BS_NO" placeholder="Bus Number" type="text">
					<span class="error" id="BS_NO"></span><br><br>
					</div>
                    <button class="menu" type="submit" name="BookBuses">Book Now</button>
                </form>
                <?php
                if (isset($_POST['BookBuses'])) {
                    $stmt = $connection->prepare("select * from history where MAILID = ? and BS_NO = ? and  DATE(DAYDATE) = CURDATE()");
                    $stmt->bind_param("ss",$_SESSION['MAILID'], $_POST['BS_NO']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows == 0) 
					{
                        $stmt = $connection->prepare("insert into history (MAILID,BS_NO) values (?,?)");
                        $stmt->bind_param("ss", $_SESSION['MAILID'],$_POST['BS_NO']);
                        $stmt->execute();
						$stmt = $connection->prepare("select * from history where MAILID = ? and BusID in( select Max(BusID) from history where MAILID = ?)");
						$stmt->bind_param("ss", $_SESSION['MAILID'],$_SESSION['MAILID']);
						$stmt->execute();
						$result = $stmt->get_result();
						$book = $result->fetch_assoc();
						  ?>
                        <span class="error">
                            Your Bokking has been Reservid With Tecket Number ( <?php echo $book['BusID'] ?> ) In Date <?php echo $book['DAYDATE'] ?>
                        </span>
						<?php
                        exit();
                    } 
					else
					{  
				?>
                        <span class="error">
                            Bus Number has been registered before!
                        </span>
						<br>
				<?php
					} 
                }
                ?>
            </div>	
        </div>
    </div>


	<footer>
				<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>
	</footer>

</body>
<script>
    var form = document.getElementById('BookBuses');

    form.addEventListener('submit', function(event) {
        var BS_NOErr = document.getElementById('BS_NO');

        if (document.forms.BookBuses.BS_NO.value === "") {
            BS_NOErr.innerText = 'You must enter Bus Number';
            event.preventDefault();
        }
        else {
            BS_NOErr.innerText = '';
        }
    });
</script>

</html>
