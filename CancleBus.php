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
				<a href="AdminSearchBus.php">Search By BusNo</a>
			</p>
		</div>

		<div class="home">
			<p class="menu">
				<a href="AddBuses.php">Add Bus</a>
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
	
	<div class='main'>
		<p class='menu'>Bus Cancellation</p>
	</div>
	<div class="tab">
        <div class="CancleBus-container">
            <div class="form-container">
                <form id="CancleBus" name="CancleBus" action="CancleBus.php" method="post">
					<div id= "label"><label for="BS_NO">Bus Number</label>
                    <input class="text-input" name="BS_NO" placeholder="Bus Number" type="text">
					<span class="error" id="BS_NO"></span><br><br>
					</div>
                    <button class="menu" type="submit" name="CancleBus">Delete</button>
                </form>
                <?php
                if (isset($_POST['CancleBus'])) {
                    $stmt = $connection->prepare("select * from buses where BS_NO = ?");
                    $stmt->bind_param("s", $_POST['BS_NO']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows == 0) 
					{
				?>
                        <span class="error">
                            Bus Number has been registered before!
                        </span>
						<br>
				<?php
                    } 
					else
					{  
						$stmt = $connection->prepare("delete from buses where BS_NO = ?");
						$stmt->bind_param("s", $_POST['BS_NO']);
                        $stmt->execute();
						echo  '<script>
								window.location.href = "ViewBuses.php";
								alert("Inserted Success")
							</script>';
                        exit();

					} 
                }
                ?>
            </div>	
        </div>
    </div>
	<br />
	<footer>
				<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>

	</footer>

</body>
<script>
    var form = document.getElementById('CancleBus');

    form.addEventListener('submit', function(event) {
        var BS_NOErr = document.getElementById('BS_NO');
        if (document.forms.CancleBus.BS_NO.value === "") {
            BS_NOErr.innerText = 'You must enter Bus Number';
            event.preventDefault();
        }
        else {
            BS_NOErr.innerText = '';
        }
    });
</script>

</html>
