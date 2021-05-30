<?php
	require('auth.php');
?>

<?php
	function selProduct(){ //function to to select product from the database using its id
		require_once('connection.php');
		$id=$_GET['id'];
		$sql="select * from products where product_id='$id'";
		$result=mysqli_query($conn,$sql);
		
		if($result){
			global $rows; // adds the $row variable to the global scope to be accessed outside the function
			$rows=mysqli_fetch_array($result);
		}
		else{
			$_SESSION['message']="Invlaid Product ID";  // set the session message
			header('location:index.php');
		}
		
	}

	function updtProduct(){  //function to update the product details 
		require_once('connection.php');
		$pname=$_POST['pname'];
		$pprice=$_POST['pprice'];
		$pdesc=$_POST['pdesc'];
		$pid=$_POST['pid'];
		
		$sql="update products set product_name='$pname', product_price='$pprice', product_desc='$pdesc' where product_id='$pid'";
		
		$result=mysqli_query($conn,$sql);
		
		if($result){
				$_SESSION['message']="Data updated";  // set the session message
			}
		else {
			$_SESSION['message']="Data not updated";  // set the session message
		}		
		header('location:index.php');
	}
?>



<?php
	

	if(isset($_POST['edit'])){ // check if there is a post from the update form
		updtProduct();  // runs the update product function
		}
	elseif(isset($_GET['id'])){ // check if there is a get (URL parameters) from the previous page
 		selProduct();  // runs the select product function
		}
	else {
		$_SESSION['message']="Invlaid Product ID";
			header('location:index.php');
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
			width: 800px;
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
	        <td align="right">Product Name</td>
	        <td><input type="text" name="pname" value="<?php echo $rows['product_name']; ?>">
				<input type="hidden" name="pid" value="<?php echo $rows['product_id']; ?>"></td>
          </tr>
	      <tr>
	        <td align="right">Product Price</td>
	        <td><input type="text" name="pprice" value="<?php echo $rows['product_price']; ?>"></td>
          </tr>
	      <tr>
	        <td align="right">Description</td>
	        <td><textarea name="pdesc" rows="10" style="width: 500px;"><?php echo $rows['product_desc']; ?></textarea></td>
          </tr>
	  
	      <tr>
	        <td align="right">&nbsp;</td>
	        <td><input type="submit" name="edit" value=" Update "></td>
          </tr>
        </tbody>
      </table>
    </form>
		</div>
</body>
</html>