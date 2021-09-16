<?php
session_start();
include("config.php");
if(!isset($_SESSION['admin']))
{
	header("location:index.php");
}
if($_GET['del']==NULL)
{
	//ASL Do Nothing
}
else
{
	$del=$_GET['del'];
	mysqli_query($techVegan,"DELETE FROM complaints WHERE id='$del'");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Complaints</title>
<link href="scripts/styleASL.css" rel="stylesheet" type="text/css" />
</head>

<body>
<span class="head" style="float:left">Complaints Management Panel</span>
<span style="float:right;"><a href="logout.php">Logout</a></span><br />
<hr style="clear:both;box-shadow:0px 0px 2px #000;" color="#FF6600" size="2" width="100%"/><br />
<div align="center">
<table cellpadding="3" cellspacing="3" class="formTable">
<tr><th>Complaint</th><th>Complaint By</th><th>Date</th><th>Action</th></tr>
<?php

$sql=mysqli_query($techVegan,"SELECT * FROM complaints ORDER BY id DESC");
while($a=mysqli_fetch_array($sql))
{
	?>
<tr class="info"><td><?php echo $a['complaint'];?></td><td>
<?php 
if($a['access']==0)
{
	echo "Student";
}
else
{
	echo "Faculty";
}?>
</td><td><?php echo $a['date'];?></td><td><a href="Complaints.php?del=<?php echo $a['id'];?>" onclick="return confirm('Are You Sure..?');" style="text-shadow:0px 0px 1px #000000;">Delete</a></td></tr>
<?php } ?> 

</table>
<a href="admin.php">Go Back</a>
</div>
</body>
<!-- 
Designed &amp; Developed by Ashish Vegan
www.ashishvegan.com | technologyvegan@gmail.com | +919890345539
Sharing this source code is strictly Prohibited | Subscribe YouTube Channel "Tech Vegan"
-->
</html>