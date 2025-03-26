<?php
$username=$_POST["uname"];
$password=$_POST["pass"];
$conn=new mysqli("localhost","root","","db_donate");
if($conn)
{
   $query="select uname,password from account where uname='$username' and password='$password'";
   $result=$conn->query($query);
   $row=$result->fetch_assoc();
   if($row)
   {
    if($row["uname"]==$username and $row["password"]==$password)
    {
        header("Location: register.html");
        exit();
    } 
   }
    else
    {
        echo "Invalid Username or Password";
    }
}
else
{
	die("Connection failed: " . mysqli_connect_error());
}
?>