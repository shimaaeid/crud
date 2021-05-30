<?php
	if (!isset($_SESSION)) { // check if the session is not started then start the session
  		session_start();
  	}

	require('connection.php');
	$sql="SELECT * from products";
	$result=mysqli_query($conn,$sql);   // runs the query using the opened connection
	$num=mysqli_num_rows($result);		// gets the number of rows to a variable
?>
			
			

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	

<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		if(isset($_SESSION['role'])){ //check if the session role is defined
	?>
			<p style="width: 1200px; margin-left: auto; margin-right: auto; text-align: right;">Username: 
			<?php echo $_SESSION['username']." -  Role: ".$_SESSION['role']; ?>
			<a href="logout.php"> logout </a> </p>
	<?php
		} // end of if block
		else {  // else block to add the sign in button if the user is not signed in
	?>
			<p style="width: 1200px; margin-left: auto; margin-right: auto; text-align: right;"> 
			<a href="login.php"> Sign In </a> </p>
	<?php			
		}
	?>
	
	<div class="cont">
	
	<?php		
		if(isset($_SESSION['message'])){  // check if there is a messege inside the session or not
  	?>
		<div class="message">
			<?php echo $_SESSION['message'] ?>
		</div>
			
	<?php
		unset($_SESSION['message']);  //clear the message from the session after printing it
		} // end of if block
	?>
	
	<?php
		for($i=0;$i<$num;$i++){
			$rows=mysqli_fetch_assoc($result);	
	?>
	<div class="products">
		<img src="imgs/<?php echo $rows['product_img']; ?>">
		<aside>
			<h1><?php echo $rows['product_name']; ?></h1>
			<h2>$<?php echo $rows['product_price']; ?></h2>
		</aside>
		<footer>
			<h3>Product Description</h3>
			<p><?php echo $rows['product_desc']; ?></p>		
			<?php
				if(isset($_SESSION['role'])&&$_SESSION['role']=='admin'){ //check for the session role value
			?>
			<div style="position: absolute; bottom: 15px; right:20px; ">
				<a href="edit.php?id=<?php echo $rows['product_id']; ?>">Edit</a>
				<a href="del.php?id=<?php echo $rows['product_id']; ?>">Delete</a>
			</div>
			
			<?php
				} // end of if block
			?>			
		</footer>
	</div>
	
	<?php
		}
	?>
	
	<?php
		if(isset($_SESSION['role'])&&$_SESSION['role']=='admin'){ //check if the session role is defined
	?>
		<div style="clear: both; text-align: center;">
			<a href="add.php" style="width: 250px;"> Add </a>
		</div>
	<?php
		} // end of if block
	?>	
		

</div>
</body>
</html>
<?php
	mysqli_close($conn);
?>