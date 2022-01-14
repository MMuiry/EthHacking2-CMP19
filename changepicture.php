<?php

include('fileuploadtype.php');
session_start();

####################################################
# Must define these and SQL update command at the end.
$target_path = "pictures/";
$nextpage="my-account.php";
$DBTable = "shopping";
$useremail=$_SESSION['username'];
include('includes/config.php');
####################################################

// Where the file is going to be placed 
$filename = basename($_FILES['uploadedfile']['name']);
$target_path = $target_path . basename($_FILES['uploadedfile']['name']); 
$file_ext=strtolower(end(explode('.',$_FILES['uploadedfile']['name'])));
$file_size =$_FILES['uploadedfile']['size'];
$file_type= $_FILES[ 'uploadedfile' ][ 'type' ];

###############################################
# 1 - Filetype invalid
###############################################
if ($fileuploadtype=="TYPE" || $fileuploadtype=="ALL"){
$validtypes= array("image/jpeg","image/jpg","image/png");
if(in_array($file_type,$validtypes)=== false){
	echo '<script type="text/javascript">alert("Invalid filetype detected - what are you up to?.");</script>';
	echo "<script>document.location='$nextpage'</script>";
	exit();	
}	
}

###############################################
# 2 - Extension invalid
###############################################
if ($fileuploadtype=="EXT"|| $fileuploadtype=="ALL"){
$extensions= array("jpeg","jpg","png");
if(in_array($file_ext,$extensions)=== false){
	echo '<script type="text/javascript">alert("extension not allowed, please choose a JPEG or PNG file.");</script>';
	echo "<script>document.location='$nextpage'</script>";
	exit();	
}	
}

###############################################
# 3 - Check size?
###############################################
if ($fileuploadtype=="SIZE"|| $fileuploadtype=="ALL"){
if($file_size > 2097152){
	echo '<script type="text/javascript">alert("File size must be less than 2 MB.");</script>';
	echo "<script>document.location='$nextpage'</script>";
	exit();
}
}

###############################################
# Move file.
###############################################
move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
chmod($target_path,0777);

###############################################
# Update database
###############################################
$con=mysql_connect("localhost","root","Thisisverysecret21") or die ("DOWN!");
mysql_select_db($DBTable,$con);

###############################################
mysql_query("update users set thumbnail='$filename' where name='$useremail'") or die(mysql_error());


$query=mysql_query("SELECT * FROM users WHERE name='$useremail'");
$num=mysql_fetch_array($query);

if($num>0)
{
$_SESSION['picture']=$num['thumbnail'];
}

###############################################
echo '<script type="text/javascript">alert("Picture has been changed to ' . $filename. '");</script>';
echo "<script>window.location.replace ('$nextpage')</script>";


?>


