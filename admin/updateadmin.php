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
			$ulast_name = $get_user_email['lastName'];
			$email = $get_user_email['email'];
			$mobile = $get_user_email['mobile'];
			$address = $get_user_email['address'];
			
}
if (isset($_POST['signup'])) {
//declere veriable
$u_fname = $_POST['first_name'];
$u_lname = $_POST['last_name'];
$u_email = $_POST['email'];
$u_mobile = $_POST['mobile'];
if($utype_db == 'admin'){
	$u_admin_type = $_POST['admintype'];
}
$u_address = $_POST['signupaddress'];
//triming name
$_POST['first_name'] = trim($_POST['first_name']);
$_POST['last_name'] = trim($_POST['last_name']);
	try {
		if(empty($_POST['first_name'])) {
			throw new Exception('Fullname can not be empty');
			
		}
		if (is_numeric($_POST['first_name'][0])) {
			throw new Exception('Please write your correct name!');
		}
		if(empty($_POST['last_name'])) {
			throw new Exception('Lastname can not be empty');
			
		}
		if (is_numeric($_POST['last_name'][0])) {
			throw new Exception('lastname first character must be a letter!');
		}
		if(empty($_POST['email'])) {
			throw new Exception('Email can not be empty');
			
		}
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
			
		}
		if($utype_db =='admin'){
			if(empty($_POST['admintype'])) {
			throw new Exception('Admin Type can not be empty');
			
		}
		}
		if(empty($_POST['signupaddress'])) {
			throw new Exception('Address can not be empty');
			
		}
		
		// Check if email already exists
		
		$check = 0;
		$e_check = mysqli_query($con,"SELECT email FROM `admin` WHERE email='$u_email'");
		$email_check = mysqli_num_rows($e_check);
		if (strlen($_POST['first_name']) >2 && strlen($_POST['first_name']) <16 ) {
			if ($check == 0 ) {
				if (strlen($_POST['password']) >4 ) {
					$d = date("Y-m-d"); //Year - Month - Day
					$_POST['first_name'] = ucwords($_POST['first_name']);
					$_POST['last_name'] = ucwords($_POST['last_name']);
					$_POST['password'] = md5($_POST['password']);
					$confirmCode   = substr( rand() * 900000 + 100000, 0, 6 );
					// send email
					
					
					if($utype_db == 'admin'){
						$result = mysqli_query($con,"UPDATE admin SET firstName='$_POST[first_name]', lastName='$_POST[last_name]', email='$u_email', mobile='$u_mobile', address='$u_address', password='$_POST[password]', type='$u_admin_type' WHERE id='$user'");
					}else{
						$result = mysqli_query($con,"UPDATE admin SET firstName='$_POST[first_name]', lastName='$_POST[last_name]', email='$u_email', mobile='$u_mobile', address='$u_address', password='$_POST[password]' WHERE id='$user'");
					}
					
					
					//success message
					$success_message = '
					<div class="signupform_content"><h2><font face="bookman">Admin Update Successfull!</font></h2>
					<div class="signupform_text" style="font-size: 18px; text-align: center;">
					<font face="bookman">
						Email: '.$u_email.'<br>
						Account Successfully Updated. <br>
					</font></div></div>';
					//}else {
					//	throw new Exception('Email is not valid!');
					
					
					
				}else {
					throw new Exception('Password must be 5 or more then 5 characters!');
				}
			}else {
				throw new Exception('Username already taken!');
			}
		}else {
			throw new Exception('Firstname must be 2-15 characters!');
		}
	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}
$search_value = "";
?>


<!doctype html>
<html>
	<head>
		<title>Welcome to My Trip online STor</title>
		<link rel="icon" href="../image/ayman.png" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
			<script src="dropdown.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="home-welcome-text" style=" background-image: url(../image/12.jpg); background-position: center center;background-attachment: fixed; background-repeat: no-repeat; background-size:cover;height:578px">
		<div class="homepageheader"  >
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
					 ?>
					
				</div>
				<div>
					<?php 
						if ($user!="") {
							echo ' <div style="color: #FFFFFF;line-height: 10px;padding: 0px 5px;text-align: center;text-decoration: none;float: right;margin: 20px 0px 0px 10px; font-size: 10px;"> 
							        <div class="navbar">
                                    <a href="index.php" font-size: 16px;>Profile</a>
                                    <a href="newadmin.php" >Add Admin</a>
                                    <div class="dropdown">
                                        <button class="dropbtn" onclick="myFunction()">Settings
                                         <i class="fa fa-caret-down"></i>
                                        </button>
                                     <div class="dropdown-content" id="myDropdown">
                                        <a href="addproduct.php" style="border-top-left-radius:0px;border-top-right-radius:0px;">Add</br></br>Product</a>
                                        <a href="orders.php">Orders</a>
                                        <a href="allproducts.php">All</br></br>Products</a>
										<a href="updateadmin.php" style="background-color:#4d0202" >Update</br></br>Admin</a>
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
			<h1 style="padding:10px 0px 0px 0px ;color:white;font-size:40px;font-family:verdana; ">TRIP ONLINE STORE</h1>
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
		
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 71px; ">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content" style="background-color:#000;margin-top:0px">
										<h2>Update Admin</h2>
										<div class="signupform_text"></div>
										<div>
											<form action="" method="POST" class="registration">
												<div class="signup_form">
													<div>
														<td >
															<input name="first_name" id="first_name" placeholder="First Name" required="required" class="first_name signupbox" type="text" size="30" value="'.$uname_db.'" >
														</td>
													</div>
													<div>
														<td >
															<input name="last_name" id="last_name" placeholder="Last Name" required="required" class="last_name signupbox" type="text" size="30" value="'.$ulast_name.'" >
														</td>
													</div>
													<div>
														<td>
															<input name="email" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30" value="'.$email.'">
													</td>
														</div>
													<div>
														<td>
															<input name="mobile" placeholder="Enter Your Mobile" required="required" class="email signupbox" type="text" size="30" value="'.$mobile.'">
														</td>
													</div>
													<div>
														<td>
															<input name="signupaddress" placeholder="Write Your Full Address" required="required" class="email signupbox" type="text" size="30" value="'.$address.'">
														</td>
													</div>
													<div>
														<td>
															<input name="password" id="password-1" required="required"  placeholder="Enter New Password" class="password signupbox " type="password" size="30" value="">
														</td>
													</div>';
													if($utype_db == 'admin'){
														echo '<div>
														<td>
															<select name="admintype" required="required" style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #4d0202;color: #4d0202;margin-left: 0;width: 300px;background-color: transparent;" class="">
																<option selected value="admin">Admin</option>
																<option value="staff">Staff</option>
																
															</select>
														</td>
													</div>';
													}
													
													 echo ' <div>
														<input name="signup" class="uisignupbutton signupbutton" type="submit" value="Update Admin">
													</div>
													<div class="signup_error_msg">
														<?php 
															if (isset($error_message)) {echo $error_message;}
															
														?>
													</div>
												</div>
											</form>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}
		 ?>
	</body>
</html>