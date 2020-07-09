<?php
	session_start();
	echo $_SESSION["email"];
	if(isset($_SESSION["email"])) {
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../css/welcome.css" />
</head>
<body>
	<div>
		<h1>Welcome To Programers Earth</h1>
		<button><a href="../index.php">Dashboard</a></button>
	</div>
	<video autoplay loop muted class="video_selector">
		<source src="../video/1.mp4" type="video/mp4" width="1600" height="600"></source>
	</video>
</body>
</html>
<?php
	}
	else {
		header("Location:../pages/sign_in.php");
	}
?>