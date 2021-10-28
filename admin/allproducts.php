<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($con,"SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$utype_db=$get_user_email['type'];
}

$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Welcome to My TRip online Store</title>
		<link rel="icon" href="../image/ayman.png" type="image/x-icon">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="dropdown.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(../image/12.jpg); background-position: center center; background-attachment: fixed; background-repeat: no-repeat; background-size:cover;height:578px;">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
						}
					 ?>
					
				</div>
				<div>
					<?php 
						if ($user!="") {
							echo ' <div style="color: #FFFFFF;line-height: 10px;padding: 0px 5px;text-align: center;text-decoration: none;float: right;margin: 20px 0px 0px 10px; font-size: 10px;"> 
							        <div class="navbar">
                                    <a href="index.php" font-size: 16px;>Profile</a>
                                    <a href="newadmin.php">Add Admin</a>
                                    <div class="dropdown">
                                        <button class="dropbtn" onclick="myFunction()">Settings
                                         <i class="fa fa-caret-down"></i>
                                        </button>
                                     <div class="dropdown-content" id="myDropdown">
                                        <a href="addproduct.php" style="border-top-left-radius:0px;border-top-right-radius:0px;">Add</br></br>Product</a>
                                        <a href="orders.php">Orders</a>
                                        <a href="allproducts.php" style="background-color:#4d0202" >All</br></br>Products</a>
										<a href="updateadmin.php" >Update</br></br>Admin</a>
										<a href="users.php" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;">Users</a>
                                     </div>
                                    </div> 
                                   </div>
								   </div>';
						}
						else {
							echo '<div  style="color: #FFFFFF;line-height: 10px;padding: 12px 24px;text-align: center;text-decoration: none;float: right;margin: 20px 0px 0px 10px; font-size: 10px;">
							<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a></div>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 60px; width: 90px;" src="../image/ayman.png">
				</a>
			</div>
			<div style="float:left;">
			<h1 style="padding:10px 0px 0px 0px ;color:white;font-size:40px;font-family:verdana;">TRIP ONLINE STORE</h1>
			</div>
			<div class="">
				<div id="srcheader" style="float: right; margin:5px 0px 0px 0px;">
					<form id="newsearch" method="get" action="http://www.google.com">
					        <input type="text" class="srctextinput" name="q" size="21" maxlength="120"  placeholder="Looking For"><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="categolis">
			
		</div>
		<div>
			<table class="rightsidemenu">
				<tr style="font-weight: bold;" colspan="10" >
					<th>Id</th>
					<th>P Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Piece</th>
					<th>Available</th>
					<th>Category</th>
					<th>Type</th>
					<th>Item</th>
					<th>P Code</th>
					<th>Edit</th>
				</tr>
				<tr>
					<?php include ( "../inc/connect.inc.php");
					$query = "SELECT * FROM products ORDER BY id DESC";
					$run = mysqli_query($con,$query);
					while ($row=mysqli_fetch_assoc($run)) {
						$id = $row['id'];
						$pName = substr($row['pName'], 0,50);
						$descri = $row['description'];
						$price = $row['price'];
						$piece=$row['piece'];
						$available = $row['available'];
						$category = $row['category'];
						$type = $row['type'];
						$item = $row['item'];
						$pCode = $row['pCode'];
						$picture = $row['picture'];
					
					 ?>
					<th><?php echo $id; ?></th>
					<th><?php echo $pName; ?></th>
					<th><?php echo $descri; ?></th>
					<th><?php echo $price; ?></th>
					<th><?php echo $piece; ?></th>
					<th><?php echo $available; ?></th>
					<th><?php echo $category; ?></th>
					<th><?php echo $type; ?></th>
					<th><?php echo $item; ?></th>
					<th><?php echo $pCode; ?></th>
					<th><?php echo '<div class="home-prodlist-img"><a href="editproduct.php?epid='.$id.'">
									<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
									</a>
								</div>' ?></th>
				</tr>
				<?php } ?>
			</table>
		</div>
	</body>
</html>