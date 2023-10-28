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
				<a href="CancleBus.php">Delete Bus </a>
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
		<p class="menu">Update Buses</p>
	</div>
	<div class="tab">
        <div class="UpdateBus-container">
            <div class="form-container">
                <form id="UpdateBus" name="UpdateBus" action="AdminUpdateBus.php" method="post">
					<div id= "label"><label for="OldBS_NO">Bus Number</label>
                    <input class="text-input" name="OldBS_NO" placeholder="Bus Number" type="text">
					<span class="error" id="OldBS_NO"></span><br><br>
					</div>
					<br>
					<br>
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
                    <button class="menu" type="submit" name="UpdateBus">Update</button>
                </form>
                <?php
				 if (isset($_POST['UpdateBus'])) {
                    $stmt = $connection->prepare("select * from buses where BS_NO = ?");
                    $stmt->bind_param("s", $_POST['OldBS_NO']);
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
						$sql = 'Update buses set BS_NAME=?,FROM_STN=?,TO_STN=? where BS_NO=?';
						$stmt = $connection->prepare($sql);
						$stmt->bind_param('sssi', $BS_NAME, $FROM_STN, $TO_STN, $OldBS_NO);
						$BS_NAME = $_POST['BS_NAME'] ?: '';
						$FROM_STN = $_POST['FROM_STN'] ?: '';
						$TO_STN = $_POST['TO_STN'] ?: '';
						$OldBS_NO = $_POST['OldBS_NO'] ?: '';

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
    var form = document.getElementById('UpdateBus');

    form.addEventListener('submit', function(event) {
        var OldBS_NOErr = document.getElementById('OldBS_NO');
var OldBS_NOErr = document.getElementById('OldBS_NO');
		
        var BS_NAMEErr = document.getElementById('BS_NAME');
        var FROM_STNErr = document.getElementById('FROM_STN');
        var TO_STNErr = document.getElementById('TO_STN');

        if (document.forms.UpdateBus.OldBS_NO.value === "") {
            OldBS_NOErr.innerText = 'You must enter Bus Number';
            event.preventDefault();
        }
        else {
            OldBS_NOErr.innerText = '';
        }


        if (document.forms.UpdateBus.BS_NAME.value === "") {
            BS_NAMEErr.innerText = 'You must enter Bus Name';
            event.preventDefault();
        } else {
            BS_NAMEErr.innerText = '';
        }
		
        if (document.forms.UpdateBus.FROM_STN.value === "") {
            FROM_STNErr.innerText = 'You must enter Bus From Station';
            event.preventDefault();
        } else {
            FROM_STNErr.innerText = '';
        }

        if (document.forms.UpdateBus.TO_STN.value === "") {
            TO_STNErr.innerText = 'You must enter Bus To Station';
            event.preventDefault();
        } else {
            TO_STNErr.innerText = '';
        }


    });

</script>
</html>
