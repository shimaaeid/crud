<?php
	require('auth.php');
?>

<?php
	
	if(isset($_GET['id'])){
		require('connection.php');
		$id=$_GET['id'];
		$sql="delete from products where product_id=?";
		$stmt=mysqli_prepare($conn,$sql);
		mysqli_stmt_bind_param($stmt,"i",$id);	
		if(mysqli_stmt_execute($stmt)){
			$_SESSION['message']="record deleted ID=$id";
		}
	}
	header('location:index.php');
?>
