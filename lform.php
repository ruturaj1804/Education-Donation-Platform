<?php
$username=$_POST["uname"];
$email=$_POST["email"];
$mob_no=$_POST["number"];
$password=$_POST["pass"];
$conn=mysqli_connect("localhost","root","","db_donate");
if($conn){
$query="INSERT INTO account values('$username','$email','$mob_no','$password')";
mysqli_query($conn,$query);
}
else{
	die("Connection failed: " . mysqli_connect_error());
}
header("Location: loginpage.html");
exit();
?>