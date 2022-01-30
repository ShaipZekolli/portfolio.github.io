<html>
	<head>
			<title>Contact US</title>
			<link rel="shortcut icon" type="image/x-icon" href="images/tabIcon.png">
			<style>
					body {
					  animation: fadein 2s;
					}
					@keyframes fadein {
					  from { opacity: 0}
					  to   { opacity: 1}
					}
				a.btn {
						text-decoration: none;
						background-color: black;
						color: #b6b6b6;
						padding: 10px 10px;
						margin: 8px 0;
						border: none;
						text-shadow: 0 0 2px grey;
						border-radius: 4px;
						cursor: pointer;
					  }
			</style>
	</head>
	<body style="background-color:#f1f1f1;">
					
		<div style="background-color:red;text-align:center; border:0px solid #05386B;color:#b6b6b6;
			  border-radius:8px;margin-top:220px;
			  margin-bottom:115px;
			  margin-left:520px;
			  box-shadow: 20px 20px 90px;width:22%;">
		<?php
			require "connect.php";
			$name = $_POST["Name"];
			$email = $_POST["Email"];
			$subject = $_POST["Subject"];
			$content = $_POST["Message"];
			$sql = "INSERT INTO `contactus`(`name`, `email`, `subject`, `message`, `timesent`) VALUES ('$name', '$email', '$subject', '$content',CURRENT_TIMESTAMP())";
			if(mysqli_multi_query($connect, $sql)) {
					 echo "<div style='background-color:green;border-radius:8px;' class='updateerror'></br>Your message has been recived!</br></br>"."<a class='btn'style='background-color:black' href='index.html'>Go Back</a></div>";
				}
		?>
		</div>
	</body>
</html>