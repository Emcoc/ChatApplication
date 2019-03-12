<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>
		ChatApplication
	</title>
	<body>
		<?php session_start();
			if(isset($_SESSION['username'])){
				echo 'Welcome ' . $_SESSION['username'];
				echo '<a href = "logout.php"> Logout </a><br>';
			}else{
				header("location:login.php");
			}
			
		?>
		
		<div id="main">
		<div id="message_area">	
		<?php	include("connection.php");
		
			$q1 = "SELECT * FROM message";
			$r1 = mysqli_query($con, $q1);
			while($row = mysqli_fetch_assoc($r1){
				$message = $row['message'];
				$username = $row['username'];
				echo '<h4>' .$username. '</h4>';
				echo '<p>' .$message. '</p>';
				echo '<hr>';
			}
			if(isset($_POST['submit'])){
				$message = $_POST['message'];
				$q = 'INSERT INTO message (id, message, username VALUES("", "'.$message.'", "'.$_SESSION['username'].'")';
				if(mysqli_query($con, $q)){
					echo '<h4 style = "color:red">' .$_SESSION['username']. '</h4>';
					echo '<p>' .$message. '</p>';
				}
			}
		?>
		</div>	
		<form method="post">
		<input type= "text" name = "message" placeholder = "Scrivi un messaggio...">
		<input type = "submit" name = "submit" value = "Message" />
		</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>