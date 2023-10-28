<?php
session_start();

?>
<link rel="stylesheet" href="style.css">
<?php
use 'dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
</head>

<body>
	<header>
		<h1 class="hd">INTERNAL TRANSPORTATION OF IMAMU</h1>
		<div class="tab">
			<span class="menu"> 
				<a href="index.php">Login as User</a>
			</span> 
			<span class="menu"> 
				<a href="AdminLogin.php">Login as Admin</a>
			</span>
		</div>
	</header>
	<table class="tab">
		<tr>
			<td>New User Registration</td>
		</tr>
	</table>
    <div class="tab">
        <div class="UserRegister-container">
            <div class="form-container">
                <form id="UserRegister" name="UserRegister" action="UserRegister.php" method="post">
					<div id= "label"><label for="MAILID">Email</label>
                    <input class="text-input" name="MAILID" placeholder="Email" type="text">
					<span class="error" id="MAILID"></span><br><br>
					</div>
                    <div id= "label"><label for="PWORD">Password</label>
                    <input class="text-input" type="password" name="PWORD" placeholder="Password">
					<span class="error" id="PWORD"></span><br><br>
					</div>
					<div id= "label"><label for="confirmPWORD">Confirm Password</label>
                    <input class="text-input" type="password" name="confirmPWORD" placeholder="Password">
					<span class="error" id="confirmPWORD"></span><br><br>
					</div>
					<div id= "label"><label for ="FNAME">First Name</label>
					<input class="text-input" name="FNAME" placeholder="First Name" type="text">
					<span class="error" id="FNAME"></span><br><br>
					</div>
					<div id= "label"><label for ="LNAME">Last Name</label>
					<input class="text-input" name="LNAME" placeholder="Last Name" type="text">
					<span class="error" id="LNAME"></span><br><br>
					</div>
					<div id= "label"><label for ="ADDR">Address</label>
					<input class="text-input" name="ADDR" placeholder="Address" type="text">
					<span class="error" id="ADDR"></span><br><br>
					</div>
					<div id= "label"><label for ="PHNO">Phone</label>
					<input class="text-input" name="PHNO" placeholder="Phone" type="text">
					<span class="error" id="PHNO"></span><br><br>
					</div>
                    <button class="menu" type="submit" name="UserRegister">Register</button>
                </form>
                <?php
                if (isset($_POST['UserRegister'])) {
                    $stmt = $connection->prepare("select * from admin where MAILID = ?");
                    $stmt->bind_param("s", $_POST['MAILID']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows == 0) 
					{
                        $stmt = $connection->prepare("insert into admin (MAILID,PWORD,FNAME,LNAME,ADDR,PHNO) values (?,?,?,?,?,?)");
                        $stmt->bind_param("ssssss", $_POST['MAILID'], $_POST['PWORD'], $_POST['FNAME'], $_POST['LNAME'], $_POST['ADDR'], $_POST['PHNO']);
                        $stmt->execute();
						echo  '<script>
								window.location.href = "index.php";
								alert("Inserted Success")
							</script>';
                        exit();
                    } 
					else
					{  
				?>
                        <span class="error">
                            Email has been registered before!
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
    var form = document.getElementById('UserRegister');

    form.addEventListener('submit', function(event) {
        var emailErr = document.getElementById('MAILID');
        var passwordErr = document.getElementById('PWORD');
        var confirmPasswordErr = document.getElementById('confirmPWORD');
        var fnameErr = document.getElementById('FNAME');
        var lnameErr = document.getElementById('LNAME');
        var addressErr = document.getElementById('ADDR');
        var phoneErr = document.getElementById('PHNO');

        if (document.forms.UserRegister.MAILID.value === "") {
            emailErr.innerText = 'You must enter your email';
            event.preventDefault();
        }
        else if (!new RegExp('(.+)@(.+){2,}\.(.+){2,}').test(document.forms.UserRegister.MAILID.value)) {
            emailErr.innerText = 'Email should be of an appropriate format';
            event.preventDefault();
        } else {
            emailErr.innerText = '';
        }

        if (document.forms.UserRegister.PWORD.value === "") {
            passwordErr.innerText = 'You must enter your password';
            event.preventDefault();
        } else {
            passwordErr.innerText = '';
        }

        if (document.forms.UserRegister.confirmPWORD.value === "") {
            confirmPasswordErr.innerText = 'You must enter a confirm password';
            event.preventDefault();
        }
        else if (document.forms.UserRegister.PWORD.value !== document.forms.UserRegister.confirmPWORD.value) {
            confirmPasswordErr.innerText = 'Passwords must match';
            event.preventDefault();
        } else {
            confirmPasswordErr.innerText = '';
        }

        if (document.forms.UserRegister.FNAME.value === "") {
            fnameErr.innerText = 'You must enter your First Name';
            event.preventDefault();
        } else {
            fnameErr.innerText = '';
        }
		
        if (document.forms.UserRegister.LNAME.value === "") {
            lnameErr.innerText = 'You must enter your Last Name';
            event.preventDefault();
        } else {
            lnameErr.innerText = '';
        }

        if (document.forms.UserRegister.ADDR.value === "") {
            addressErr.innerText = 'You must enter your Address';
            event.preventDefault();
        } else {
            addressErr.innerText = '';
        }

        if (document.forms.UserRegister.PHNO.value === "") {
            phoneErr.innerText = 'You must enter your Phone';
            event.preventDefault();
        } else {
            phoneErr.innerText = '';
        }

    });
</script>

</html>
