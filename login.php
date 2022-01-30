<?php

session_start();

if(!isset($_SESSION['usernameID'])) {

?>

<html>
	<head>
		<title>My Portfolio</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="shortcut icon" type="image/x-icon" href="images/tabIcon.png">
		<link rel="stylesheet" href="style/css/main.css" />
		
	</head>
	
	<body class="is-preload">

		<!-- Wrapper-->
			<div id="wrapper">

						<!-- Login form -->
							<div>
								<header >
									<h2 >Log In</h2>
								</header>
								<?php
									$errorGen = $errorUsername = $errorPassword = "";
									$username = "";
					
									if($_SERVER['REQUEST_METHOD'] == "POST") {
										//login
										//...
										include "loginValidate.php";
									}
								?>
									<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "POST">
										<table>
										<tr>
											<td><i class="fa fa-user" style="font-size:24px;padding-bottom:5px;">&nbsp;</i><input type = "text" name = "usernameLogin" style="padding:7px 7px;boder:0;border-radius:7px" value = "<?php echo $username;?>" placeholder =" Username"></td>
										</tr>
										<!--errors-->
										<tr>
											<td><?php echo "<span class = 'error'>$errorUsername</span>";?></td>
										</tr>
										<tr >
											<td><i class="fa fa-unlock-alt" style="font-size:24px;padding-bottom:5px;padding-top:10px;">&nbsp;</i><input type = "password" name = "passLogin"  style="padding:7px 7px;boder:0;border-radius:7px" placeholder = " Password "></td>
										</tr>
										<!--errors-->
										<tr>
											<td><?php echo "<span class = 'error'>$errorPassword</span>";?></td></td>
										</tr>
										<tr>
											<td><?php echo "<span class = 'error'>$errorGen</span>";?></td>
										</tr>
										
										<table>
									
											<td><input style="padding:1px 10px;" type = "submit" value="Login"</td>
										
									</form>
							</div>
				<!-- Footer -->
					<div style="postion:absolute;bottom: 10px;" id="footer">
						<ul class="copyright">
							<li>&copy; My Portfolio.</li><li>Design: <a href="https://github.com/ShaipZekolli">SH.Z</a></li>
						</ul>
					</div>
					
			</div>
			
		<!-- Skriptat -->
			<script src="style/js/script.js" ></script>
			<script src="style/js/jquery.min.js"></script>
			<script src="style/js/breakpoints.min.js"></script>
			<script src="style/js/main.js"></script>
		
	</body>

</html>

<?php
}

else {
	header("Location: logedin.php");
}?>