<?php
	if (!isset($_SESSION)) { // check if the session is not started then start the session
  		session_start();
  	}

	if(isset($_POST['login'])) {
		require('connection.php');
		$uname=$_POST['uname'];
		$pass=sha1($_POST['userpass']);  //encrypting the password using the SHA1 algorithm
		$sql="SELECT id,username,role from users where username='$uname' and password='$pass'";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_fetch_array($result);
		$num=mysqli_num_rows($result);
	
		if($num==1){   //checks the number of returned rows in the record set (must be eqaual to 1)
			$_SESSION['role']=$rows['role'];  		 //adds the user role to the session.
			$_SESSION['username']=$rows['username']; //adds the username to the session.
			header('location:index.php');
		}
		else {
			header('location:passord_error.php');
		}
			mysqli_close($conn);
		}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<style>
		.products{
			margin:80px auto;
			
			float: none;
			min-height: auto;
			
		}
	</style>
	</head>
<body>
		<div class="products">
		<form method="post">
	  <table border="0" align="center" cellpadding="10" cellspacing="3">
	    <tbody>
	      <tr>
	        <td align="right">User Name</td>
	        <td><input type="text" name="uname"></td>
          </tr>
	      <tr>
	        <td align="right">Password</td>
	        <td><input type="password" name="userpass"></td>
          </tr>
	      <tr>
	        <td align="right">&nbsp;</td>
	        <td><input type="submit" name="login" value=" Login "></td>
          </tr>
        </tbody>
      </table>
    </form></div>
</body>
</html>
