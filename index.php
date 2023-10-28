<?php
session_start();

?>

<?php
include 'dbconnection.php';
?>


<html lang="en">

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<h1 class="hd">INTERNAL TRANSPORTATION OF IMAMU</h1>
		<div class="tab hd">
			<span class="menu"> <a href="AdminLogin.php"> Login as Admin</a> </span> 
			<span class="menu"> <a href="UserRegister.php">New User Register</a>
		</div>
	</header>
	<table class="tab brown hd">
		<tr>
			<td>User Login</td>
		</tr>
	</table>
    <div class="tab hd">
        <div class="login-container">
            <div class="form-container">
                <form id="login" name="login" action="index.php" method="post">
                    <div id= "label">
					<span><label>Username</label></span> 
                    <span> <input class="text-input" name="MAILID" placeholder="User Name" type="text"></span> 
					<span class="error" id="MAILID"></span>				
                    </div>
					<br>
					<div id= "label">
					<span> <label>Password</label> 
                    <input class="text-input" type="Password" name="PWORD" placeholder="Password"></span> 
					<span class="error" id="PWORD"></span>
                    </div>
					<br>
					<button class="btn" type="submit" name="login">Login</button>
                </form>
				<?php
				if (isset($_POST['login'])) 
				{
					$MAILID = $_POST['MAILID'];
					$PWORD = $_POST['PWORD'];
					$sql = "select * from admin where MAILID = '$MAILID' and PWORD = '$PWORD'";  
					$result = mysqli_query($connection , $sql);  
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
					$count = mysqli_num_rows($result);  
					if($count == 1)
					{  
						$_SESSION['MAILID'] = $row['MAILID'];
						echo	'<script>
								 window.location.href = "UserHome.php";
								 </script>';
						exit();
					}  
					else
					{  
						echo	'<script>
								 window.location.href = "error.html";
								 </script>';
					}     
				}
				?>
            </div>
        </div>
    </div>
    <script>
        var form = document.getElementById('login');
        form.addEventListener('submit', function(event) 
		{
            var MAILIDErr = document.getElementById('MAILID');
            var PWORDErr = document.getElementById('PWORD');
            if (document.forms.login.MAILID.value === "") 
			{
                MAILIDErr.innerText = 'You must enter an username';
                event.preventDefault();
            } 
			else 
			{
                MAILIDErr.innerText = '';
            }
            if (document.forms.login.PWORD.value === "") 
			{
                PWORDErr.innerText = 'You must enter a password';
                event.preventDefault();
            } 
			else 
			{
                PWORDErr.innerText = '';
            }
        });
    </script>
	<footer>
		<a href=“mailto:CSRimamuBuss@gmail.com>customer service </a><br><a> CSRimamuBuss@gmail.com</a>
	</footer>
</body>
</html>
