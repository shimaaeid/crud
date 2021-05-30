<?php
	function addUser(){
		require('connection.php');
		$sql="insert into users(username,password,role) values(?,?,?)";
		$stmt=mysqli_prepare($conn,$sql);
		
		$username=$_POST['uname'];
		$password=sha1($_POST['userpass']);
		$role=$_POST['role'];
			
		
		
		mysqli_stmt_bind_param($stmt,"sss",$username,$password,$role);	

		if(mysqli_stmt_execute($stmt)){
			echo "user created";
			
			
		}
		
	}
	
	
?>



<?php
	if(isset($_POST['add'])){
		 addUser();
	
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
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
	        <td align="right">role</td>
	        <td><select name="role">
	          <option value="user" selected>User</option>
	          <option value="admin">Admin</option>
	        </select></td>
          </tr>
	      <tr>
	        <td align="right">&nbsp;</td>
	        <td><input type="submit" name="add" value=" Add User "></td>
          </tr>
        </tbody>
      </table>
    </form>
</body>
</html>