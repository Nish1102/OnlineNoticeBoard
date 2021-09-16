<?php
session_start();
if(isset($_SESSION['sid']))
{
	header("location:shome.php");
}elseif(isset($_SESSION['fid']))
	{
		header("location:fhome.php");
	}elseif(isset($_SESSION['admin']))
		{
			header("location:admin.php");
		}

include("config.php");
$id=$_POST['id'];
$pass=$_POST['pass'];
$type=$_POST['type'];

if($type==1)
{
	$sql=mysqli_query($techVegan,"SELECT * FROM registration WHERE (roll='".mysqli_real_escape_string($techVegan,$id)."' AND password='".mysqli_real_escape_string($techVegan,sha1($pass))."') AND status='1'");
	if(mysqli_num_rows($sql)==1)
	{
		$_SESSION['sid']=$_POST['id'];
		header("location:shome.php");
	}
	else
	{
		$info="Incorrect User ID or Password";
	}
}
elseif($type==2)
{
	$sql=mysqli_query($techVegan,"SELECT * FROM faculty WHERE (fid='".mysqli_real_escape_string($techVegan,$id)."' AND password='".mysqli_real_escape_string($techVegan,sha1($pass))."') AND status='1'");
	if(mysqli_num_rows($sql)==1)
	{
		$_SESSION['fid']=$_POST['id'];
		header("location:fhome.php");
	}
	else
	{
		$info="Incorrect User ID or Password";
	}
}elseif($type==3)
	{
	$sql=mysqli_query($techVegan,"SELECT * FROM admin WHERE id='".mysqli_real_escape_string($techVegan,$id)."' AND password='".mysqli_real_escape_string($techVegan,sha1($pass))."'");
	if(mysqli_num_rows($sql)==1)
	{
		$_SESSION['admin']=$_POST['id'];
		header("location:admin.php");
	}
	else
	{
		$info="Incorrect User ID or Password";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Notice Board</title>
<link href="scripts/styleASL.css" rel="stylesheet" type="text/css" />
<style type="text/css">
td {vertical-align:top;}
</style>
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>

<body>
<div align="center">

<span class="head">Online Notice Board</span>
<br />
<marquee behavior="alternate" scrollamount="5" direction="left" class="marquee" onmouseover="this.stop();" onmouseout="this.start();">Welcome To Online Notice Board</marquee>
<br /><br /><br /><br />
<form action="" method="post" onsubmit="MM_validateForm('id','','R','pass','','R');return document.MM_returnValue">
<table cellpadding="3" cellspacing="3" class="formTable">
<tr><td colspan="2" align="center" class="Subhead"><marquee behavior="alternate" scrollamount="2" width="150" direction="left" onmouseover="this.stop();" onmouseout="this.start();">ONB Login</marquee></td></tr>
<tr><td colspan="2" align="center" class="info"><?php echo $info;?></td></tr>
<tr><td class="labels">User Type : </td><td><select name="type" class="fields"><option disabled="disabled" selected="selected">- Select User Type -</option><option value="1">Student</option><option value="2">Faculty</option><option value="3">Admin</option></select></td></tr>
<tr><td class="labels">User ID : </td><td><input name="id" type="text" class="fields" id="id" placeholder="Enter User ID" size="20"/></td></tr>
<tr><td class="labels">Password : </td><td><input name="pass" type="password" class="fields" id="pass" placeholder="Enter Password" size="20"/></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Login" class="button"/></td></tr>
</table>
</form><br />
<span style="font-family:'trebuchet MS';font-size:16px;color:#900;">New Student?</span> <a href="registration.php">Register Here</a><br />
<span style="font-family:'trebuchet MS';font-size:16px;color:#900;">New Faculty?</span> <a href="facultyReg.php">Register Here</a>
</div>
</body>
<!-- 
Designed &amp; Developed by Nishant & Sajal
-->
</html>