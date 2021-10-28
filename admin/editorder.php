<?php include ( "../inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	$user = "";
	header("location: login.php?ono=".$eoid."");
}
else {
	if (isset($_REQUEST['eoid'])) {
	
		$eoid = mysqli_real_escape_string($con,$_REQUEST['eoid']);
		$getposts5 = mysqli_query($con,"SELECT * FROM orders WHERE id='$eoid'") or die(mysqli_error());
			if (mysqli_num_rows($getposts5)){

			}else {
				header('location: index.php');
			}
	}else {
		header('location: index.php');
	}
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($con,"SELECT * FROM admin WHERE id='$user'");
	$get_user_email = mysqli_fetch_assoc($result);
		$uname_db = $get_user_email['firstName'];
		$type_db=$get_user_email['type'];
		$utype_db=$get_user_email['type'];


	$result1 = mysqli_query($con,"SELECT * FROM orders WHERE id='$eoid'");
		$get_order_info = mysqli_fetch_assoc($result1);
			$eouid = $get_order_info['uid'];
			$eopid = $get_order_info['pid'];
			$eoquantity = $get_order_info['quantity'];
			$eoplace = $get_order_info['oplace'];
			$eomobile = $get_order_info['mobile'];
			$eodstatus = $get_order_info['dstatus'];
			$eodustatus = ucwords($get_order_info['dstatus']);
			$eodate = $get_order_info['odate'];
			$eddate = $get_order_info['ddate'];

			$result2 = mysqli_query($con,"SELECT * FROM user WHERE id='$eouid'");
			$get_order_info2 = mysqli_fetch_assoc($result2);
			$euname = $get_order_info2['firstName'];
			$euemail = $get_order_info2['email'];
			$eumobile = $get_order_info2['mobile'];
}

$getposts = mysqli_query($con,"SELECT * FROM products WHERE id ='$eopid'") or die(mysqli_error());
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$piece=$row['piece'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$category = $row['category'];
						$available =$row['available'];
					}	

//order

if (isset($_POST['order'])) {
//declere veriable
$eodstatus = $_POST['dstatus'];
$dquantity = $_POST['quantity'];
$ddate = $_POST['ddate'];
//triming name
	try {
		if(empty($_POST['dstatus'])) {
			throw new Exception('Status can not be empty');
			
		}
				if(mysqli_query($con,"UPDATE orders SET dstatus='$eodstatus', ddate='$ddate', quantity='$dquantity' WHERE id='$eoid'")){
					//success message
				header('location: editorder.php?eoid='.$eoid.'');
				$success_message = '
				<div class="signupform_content"><h2><font face="bookman">Change successfull!</font></h2>
				</div>';
				}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}
if (isset($_POST['delorder'])) {
//triming name
	if(mysqli_query($con,"DELETE FROM orders WHERE id='$eoid'")){

	header('location: orders.php');
	}

	}
$search_value = "";


?>

<!DOCTYPE html>
<html>
<head>
	<title>EDIT</title>
	<link rel="icon" href="../image/ayman.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="dropdown.js"></script>
	
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image: url(../image/12.jpg); background-position: center center; background-attachment: fixed; background-repeat: no-repeat; background-size:cover;height:578px;">
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
			<div id="srcheader" style="float: right; margin:5px 0px 0px 0px;">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Looking For" value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
			</div>
		</div>
		<div class="categolis">
			
		</div>
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>
				<h2 style="padding-bottom: 20px;">Cancel Or Shipped</h2>
				<div style="float: left;background-color:#000;border:1px solid #fff;border-radius:16px;opacity:80%">
				<?php 
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form" style="    margin-top: 38px;">
									<div>
										<td>
											<input name="ddate" placeholder="Delevary date" required="required" class="email signupbox" type="date" size="30" value="'.$eddate.'">
										</td>
									</div>
									<div>
										<td>
											<select name="dstatus" required="required" style=" font-size: 20px;
												font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #4d0202;color:#b06a09;margin-left: 0;width: 300px;background-color: transparent;" class="">
														<option selected value="'.$eodstatus.'">'.$eodustatus.'</option>
														<option value="No">No</option>
														<option value="Yes">Yes</option>
														<option value="Cancel">Cancel</option>
													</select>
										</td>
									</div>
									<div>
										<td>
											<select name="quantity" required="required" style=" font-size: 20px;
										font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #4d0202;color: #b06a09;margin-left: 0;width: 300px;background-color: transparent;" class="">
										<option selected value="'.$eoquantity.'">Quantity: '.$eoquantity.'</option>';
				 								?><?php
												for ($i=1; $i<=$available; $i++) { 
													echo '<option value="'.$i.'">Quantity: '.$i.'</option>';
												}
											?>
											<?php echo '
											</select>
										</td>
									</div>
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" style="color: #fff" value="Confirm Change">
									</div>
									<div>
										<input name="delorder" class="uisignupbutton signupbutton" type="submit" style="color: #fff" value="Delete Order">
									</div>
									<div class="signup_error_msg"> '; ?>
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									<?php echo '</div>
								</div>
							</form>
							
						</div>
					</div>

					';
					if(isset($success_message)) {echo $success_message;}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: right;">
			<div>
				<?php
					echo '
						<ul style="float: right;">
							<li style="float: left; padding: 80px 0px 25px 25px;">
								<div class="home-prodlist-img">
									<img src="../image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
									
									<div style="text-align: center; padding: 0 0 6px 0;">'.$pName.'</div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
</body>
</html>