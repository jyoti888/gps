<?php
$conn=mysqli_connect('localhost','root','','map');
	if($conn){
		echo "connected successfully";
	}
	else{
		echo $conn->error;
	}
	?>