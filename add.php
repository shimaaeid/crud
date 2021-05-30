<?php
	require('auth.php');
?>

<?php
	function addProduct(){ //adds a new product to database
		require('connection.php');
		$sql="insert into products(product_name,product_price,product_desc,product_img) values(?,?,?,?)";
		$stmt=mysqli_prepare($conn,$sql);
		
		$pname=$_POST['pname'];
		$pprice=$_POST['pprice'];
		$pdesc=$_POST['pdesc'];
		
		if(isset($_FILES['pfile']['name'])){  // check if the file is uploaded
			$pfile=$_FILES['pfile']['name'];  // gets the file name to a variable
			$img_stat=move_uploaded_file($_FILES['pfile']['tmp_name'],'imgs/'.$_FILES['pfile']['name']);
		}
		
		if(!$img_stat){
			$_SESSION['message']="Image is not uploaded please select another image";
			header('location:index.php');
		}	
				
		mysqli_stmt_bind_param($stmt,"ssss",$pname,$pprice,$pdesc,$pfile);	

		if(mysqli_stmt_execute($stmt)){	
			$_SESSION['message']="Product Added"; // add a session message to the index page		
		}
		header('location:index.php');
	}	
?>

<?php
	if(isset($_POST['add'])){
		 addProduct(); // call the add product function	
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
	<form method="post" enctype="multipart/form-data">
	  <table border="0" align="center" cellpadding="10" cellspacing="3">
	    <tbody>
	      <tr>
	        <td align="right">Product Name</td>
	        <td><input type="text" name="pname"></td>
          </tr>
	      <tr>
	        <td align="right">Product Price</td>
	        <td><input type="text" name="pprice"></td>
          </tr>
	      <tr>
	        <td align="right">Description</td>
	        <td><textarea name="pdesc" rows="10" style="width: 500px;"></textarea></td>
          </tr>
	      <tr>
	        <td align="right">Photo</td>
	        <td><input type="file" name="pfile"></td>
          </tr>
	      <tr>
	        <td align="right">&nbsp;</td>
	        <td><input type="submit" name="add" value=" Insert "></td>
          </tr>
        </tbody>
      </table>
		</form></div>
</body>
</html>