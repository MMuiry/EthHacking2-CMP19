<?php
session_start();
include('includes/config.php');

//$sql=mysql_query("SELECT password FROM users where password='".$cpass."' && email='".$emailaddress."'");
//$num=mysql_fetch_array($sql);


//	if($num>0)
//	{
		$con=mysql_query("update users set password='".$newpass."' where id='".$emailaddress."'");
		echo "<script>alert('Password Changed Successfully !!');</script>";
//	}
//	else
//	{
//		echo "<script>alert('Current Password not match !!');</script>";
//	}
?>
