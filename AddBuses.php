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
include_once'dbconnection.php';

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
	<div class='main'>
		<p class='menu'> Add Buses </p>
	</div>
	<div class="tab">
        <div class="AddBuses-container">
            <div class="form-container">
                <form id="AddBuses" name="AddBuses" action="AddBuses.php" method="post">
					<div id= "label"><label for="BS_NO">Bus Number</label>
                    <input class="text-input" name="BS_NO" placeholder="Bus Number" type="text">
					<span class="error" id="BS_NO"></span><br><br>
					</div>
					<div id= "label"><label for ="BS_NAME">Bus Name</label>
					<input class="text-input" name="BS_NAME" placeholder="Bus Name" type="text">
					<span class="error" id="BS_NAME"></span><br><br>
					</div>
					<div id= "label"><label for ="FROM_STN">From Station</label>
					<input class="text-input" name="FROM_STN" placeholder="From Station" type="text">
					<span class="error" id="FROM_STN"></span><br><br>
					</div>
					<div id= "label"><label for ="TO_STN">To Station</label>
					<input class="text-input" name="TO_STN" placeholder="To Station" type="text">
					<span class="error" id="TO_STN"></span><br><br>
					</div>
                    <button class="menu" type="submit" name="AddBuses">Register</button>
                </form>
                <?php
                if (isset($_POST['AddBuses'])) {
                    $stmt = $connection->prepare("select * from buses where BS_NO = ?");
                    $stmt->bind_param("s", $_POST['BS_NO']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows == 0) 
					{
                        $stmt = $connection->prepare("insert into buses (BS_NO,BS_NAME,FROM_STN,TO_STN) values (?,?,?,?)");
                        $stmt->bind_param("ssss", $_POST['BS_NO'], $_POST['BS_NAME'], $_POST['FROM_STN'],$_POST['TO_STN']);
                        $stmt->execute();
						echo  '<script>
								window.location.href = "ViewBuses.php";
								alert("Inserted Success")
							</script>';
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

	<br />
	<footer>
		<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>
	</footer>
</body>
<script>
    var form = document.getElementById('AddBuses');

    form.addEventListener('submit', function(event) {
        var BS_NOErr = document.getElementById('BS_NO');
        var BS_NAMEErr = document.getElementById('BS_NAME');
        var FROM_STNErr = document.getElementById('FROM_STN');
        var TO_STNErr = document.getElementById('TO_STN');

        if (document.forms.AddBuses.BS_NO.value === "") {
            BS_NOErr.innerText = 'You must enter Bus Number';
            event.preventDefault();
        }
        else {
            BS_NOErr.innerText = '';
        }

        if (document.forms.AddBuses.BS_NAME.value === "") {
            BS_NAMEErr.innerText = 'You must enter Bus Name';
            event.preventDefault();
        } else {
            BS_NAMEErr.innerText = '';
        }
		
        if (document.forms.AddBuses.FROM_STN.value === "") {
            FROM_STNErr.innerText = 'You must enter Bus From Station';
            event.preventDefault();
        } else {
            FROM_STNErr.innerText = '';
        }

        if (document.forms.AddBuses.TO_STN.value === "") {
            TO_STNErr.innerText = 'You must enter Bus To Station';
            event.preventDefault();
        } else {
            TO_STNErr.innerText = '';
        }

    });
</script>

</html>
