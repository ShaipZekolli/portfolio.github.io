<?php

session_start();

if(isset($_SESSION['usernameID'])) {
?>
<!DOCTYPE HTML>
<!--
	First Portfolio
-->
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

				<!-- Nav -->
					<nav id="nav">
						<a href="#" class="icon solid fa-user"><span><?php require "connect.php";
											$querey ="Select Username From perdoruesi Where Username='$_SESSION[usernameID]';";
											$quereyrez = mysqli_query($connect,$querey);
											$Perdoruesi=mysqli_fetch_array($quereyrez);
											$emriPerdoruesit = $Perdoruesi['Username'];
											echo $emriPerdoruesit;
										?></span></a>
						<a href="#work" class="icon solid fa-folder"><span>Work</span></a>
						<a href="#contact" class="icon solid fa-envelope-open"><span>Contacted Us</span></a>
						<span class="badge"><?php require "connect.php";
											$querey ="Select count(*) as nr From contactus";
											$quereyrez = mysqli_query($connect,$querey);
											$c=mysqli_fetch_array($quereyrez);
											$nr = $c['nr'];
											echo $nr;
										?></span>
						<a href="logout.php" class="icon solid fa-unlock"><span>Log Out</span></a>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Me -->
							<article id="home" class="panel intro">
								<header>
									<h1><?php require "connect.php";
											$querey ="Select Username From perdoruesi Where Username='$_SESSION[usernameID]';";
											$quereyrez = mysqli_query($connect,$querey);
											$Perdoruesi=mysqli_fetch_array($quereyrez);
											$emriPerdoruesit = $Perdoruesi['Username'];
											echo $emriPerdoruesit;
										?></h1>
									<p>Loged is as</p>
								</header>
								<a href="#work" class="jumplink pic">
									<span class="arrow icon solid fa-chevron-right"><span>See my work</span></span>
									<img src="images/me.jpg" alt="" />
								</a>
							</article>

						<!-- Upload Work -->
							<article id="work" class="panel">
								<header>
									<h2>Upload Work</h2>
								</header>
								<?php
								 if (isset($_POST['submit'])){ 
										$target_dir = "images/imNgarkuara/";
										$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
										$uploadOk = 1;
										$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

										// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0) {
										  echo "Sorry, your file was not uploaded.";
										// if everything is ok, try to upload file
										} else {
										  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
											 require "connect.php";
											 $path =htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
											 $querey1 ="Select Count(path) as c From path Where path='$path';";
											 $quereyrez1 = mysqli_query($connect,$querey1);
											 While($m=mysqli_fetch_array($quereyrez1)){
											 $count = $m['c'];}
											 if($count >= 1){
												 $f = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " already exist in database.";
												 echo "<script>alert('$f');</script>";
											 }
											 elseif($count == 0){
											 $ext = pathinfo($path, PATHINFO_EXTENSION);
											 $querey ="Insert into path(id,path,ext) values('','$path','$ext')";
											 $quereyrez = mysqli_query($connect,$querey);
											 $g = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
											 echo "<script>alert('$g');</script>";
											 }
										  } else {
											echo "Sorry, there was an error uploading your file.";
										  }
										}
								 }
									?>
								<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
								  Select file to upload:
								  <input type="file" name="fileToUpload" id="fileToUpload">
								  <input type="submit" value="Upload" name="submit">
								</form>
								<section>
									<div class="row">
										<?php require "connect.php";
											$quereypath ="Select path,ext From path";
											$quereyrezpath = mysqli_query($connect,$quereypath);
											while($p=mysqli_fetch_array($quereyrezpath)){
											$path = $p['path'];
											$ext = $p['ext'];
											if($ext == 'pdf'){
											echo "<a href='images/imNgarkuara/$path'><img style='width:8%;' src='images/pdf.png'>$path</a></br>";
											}
											elseif($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif'){
											echo "<a href='images/imNgarkuara/$path'><img style='width:8%;' src='images/img.png'>$path</a></br>";
											}
											elseif($ext == 'txt' || $ext == 'md'){
											echo "<a href='images/imNgarkuara/$path'><img style='width:8%;' src='images/txt.png'>$path</a></br>";
											}
											else {
											echo "<a href='images/imNgarkuara/$path'><img style='width:8%;' src='images/unk.png'>$path</a></br>";
											}
										}
										?>
										
								</section>
							</article>

						<!-- Contacted us -->
							<article id="contact" class="panel">
								<header>
									<h2>Contacted Us</h2>
								</header>
								<?php
								require "connect.php";
								$quereyc ="SELECT * FROM contactus ORDER BY `contactus`.`timesent` DESC;";
									$quereyrezc = mysqli_query($connect,$quereyc);
									echo'<div style="color:black" id="mesazh">
										<h3  style="color:black;padding-top:22px"><b><i class="fa fa-envelope"></i> Messages</b></h3></br>
										<div  style="border-radius:6px;border: 1px solid #846a29;color:black">';
									while($mesge=mysqli_fetch_array($quereyrezc)){
									$emri = $mesge['name'];
									$email = $mesge['email'];
									$subject = $mesge['subject'];
									$messages = $mesge['message'];
									$time = $mesge['timesent'];
									echo  ' <div style="color:black;padding-top:3px">
											<i  class="fa fa-user-circle" style="width:48px;height:48px;font-size:48px"></i>
											<span style="color:gray;align:right;">Time:'. $time .'</span>
										  </div>
										  <div style="color:black;padding-top:0px">
											<h3>Name: <b>'. $emri .'</b></h3>
											<h5><b>Email: </b>'. $email .'</h5>
											<h5><b>Subject: </b>'. $subject .'</h5>
											<p><b>Message: </b>'. $messages .'.</p><br>
									</div>';
									}
								?>	
				</div>
							</article>

					</div>

				<!-- Footer -->
					<div id="footer">
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
	header("Location: login.php");
}?>
