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

?>


<!doctype html>
<html>
	<head>
		<title>Welcome to My Trip online STore</title>
		<link rel="icon" href="../image/logo1.png" type="image/x-icon">
		
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
                                        <a href="allproducts.php">All</br></br>Products</a>
									<a href="updateadmin.php" >Update</br></br>Admin</a>
										<a href="users.php"  style="background-color:#4d0202;border-bottom-left-radius:10px;border-bottom-right-radius:10px;" >Users</a>
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
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 60px; width: 90px;" src="../image/logo1.png">
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
		<div style="margin-top: 20px;">
			<div style="width: 950px; margin: 0 auto;">
			
				<ul>
					
					<li style="float: center; ">
						<div>
							<table class="rightsidemenu">
								<tr style="font-weight: bold;" colspan="10" bgcolor=>
									<th>Id</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Address</th>
									<th>Activation</th>
								</tr>
								<tr>
									<?php include ( "../inc/connect.inc.php");
									$query = "SELECT * FROM user ORDER BY id DESC";
									$run = mysqli_query($con,$query);
									while ($row=mysqli_fetch_assoc($run)) {
										$id = $row['id'];
										$fname = $row['firstName'];
										$lname = $row['lastName'];
										$email = $row['email'];
										$mobile = $row['mobile'];
										$address = $row['address'];
										$active = $row['activation'];
									
									 ?>
									<th><?php echo $id; ?></th>
									<th><?php echo $fname; ?></th>
									<th><?php echo $lname; ?></th>
									<th><?php echo $email; ?></th>
									<th><?php echo $mobile; ?></th>
									<th><?php echo $address; ?></th>
									<th><?php echo $active; ?></th>
								</tr>
								<?php } ?>
							</table>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>