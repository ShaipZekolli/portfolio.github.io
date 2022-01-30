<?php

session_start();

//konek db
require "connect.php";

//marrja e te dhenave me metoden POST
$username = $_POST['usernameLogin'];
$password = $_POST['passLogin'];

$login = true;

//asnjera fushe nuk eshte plotesuar
if(empty($username) && empty($password)) {
	$errorGen = "Te gjitha fushat duhet te plotesohen!";
	$login = false;
}
//te pakten njera nga fushat ka vlere
else {
	//nese username eshte i zbrazet
	if(empty($username)) {
		$errorUsername = "Fusha e username-it duhet te plotesohet!";
		$login = false;
	}
	else {
		//kontrollo nese perdoruesi ekziston ne db
		$query1 = "SELECT Username FROM perdoruesi WHERE Username = '$username';";
		$query1Res = mysqli_query($connect, $query1);
		$count1 = mysqli_num_rows($query1Res);
		if($count1 == 0) {
			$errorUsername = "Ky perdorues nuk ekziston!";
			$login = false;
		}
	}
	
	//nese password eshte i zbrazet
	if(empty($password)) {
		$errorPassword = "Fusha e fjalekalimit duhet te plotesohet!";
		$login = false;
	}
	// valido password
	else {
		//kontrollo nese fjalekalimi eshte i sakte
		$password1 = md5($password);
		$query2 = "SELECT Fjalekalimi FROM perdoruesi WHERE Username = '$username';";
		$query2Res = mysqli_query($connect, $query2);
		$passwordRow = mysqli_fetch_array($query2Res);
		$passwordDB = $passwordRow['Fjalekalimi'];
		
		if($passwordDB != $password1) {
			$errorPassword = "Fjalekalimi nuk eshte i sakte!";
			$login = false;
		}
	}
	
	//nese ska asnje gabim atehere kyqe kete perdorues ne llogari
	if($login) {
		
		$_SESSION['usernameID'] = $username;
		
		
		header("Location: logedin.php");
	}
}
?>