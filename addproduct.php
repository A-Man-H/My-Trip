<?php include ( "inc/connect.inc.php" ); ?>
<?php
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);

			$uname_db = $get_user_email['firstName'];
			

}
$pname = "";
$price = "";
$piece="";
$available = "";
$category = "";
$type = "";
$item = "";
$pCode = "";
$descri = "";

if (isset($_POST['signup'])) {
//declere veriable
$pname = $_POST['pname'];
$price = $_POST['price'];
$piece=$_POST['piece'];
$available = $_POST['available'];
$type = $_POST['type'];
$item = $_POST['item'];
$pCode = $_POST['code'];
$descri = $_POST['descri'];
//triming name
$_POST['pname'] = trim($_POST['pname']);

//finding file extention
$profile_pic_name = @$_FILES['profilepic']['name'];
$file_basename = substr($profile_pic_name, 0, strripos($profile_pic_name, '.'));
$file_ext = substr($profile_pic_name, strripos($profile_pic_name, '.'));

if (((@$_FILES['profilepic']['type']=='image/jpeg') || (@$_FILES['profilepic']['type']=='image/png') || (@$_FILES['profilepic']['type']=='image/gif')) && (@$_FILES['profilepic']['size'] < 1000000)) {

	$item = $item;
	if (file_exists("image/product/$item")) {
		//nothing
	}else {
		mkdir("image/product/$item");
	}


	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("image/product/$item/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "image/product/$item/".$filename)){
			$photos = $filename;
			$result = mysqli_query($con,"INSERT INTO products(pName,price,piece,description,available,category,type,item,pCode,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[piece]','$_POST[descri]','$_POST[available]','$_POST[category]','$_POST[type]','$_POST[item]','$_POST[code]','$photos')");
				header("Location: addproduct.php");
		}else {
			echo "Something Worng on upload!!!";
		}
		//echo "Uploaded and stored in: userdata/profile_pics/$item/".@$_FILES["profilepic"]["name"];


	}
	}
	else {
		$error_message = 'Add picture!';
	}
}
$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Music Instruments Store</title>
		<link rel="icon" href="image/ayman.png" type="image/x-icon">
		<link rel="stylesheet" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="dropdown1.js"></script>
		<script src="dropdown2.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="home-welcome-text"  style="background-image:url(image/94.jpg); background-position: center center; background-repeat: no-repeat; background-size:cover;">
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
							echo '<div style="color: #FFFFFF;line-height: 10px;padding: 0px 24px;text-align: center;text-decoration: none;float: right;margin: 20px 0px 0px 10px; font-size: 10px;"> 
							        <div class="navbar1">
                                    
                                    <div class="dropdown1">
                                        <button class="dropbtn1" onclick="myFunction()">Profile
                                         <i class="fa fa-caret-down"></i>
                                        </button>
                                     <div class="dropdown-content1" id="myDropdown">
                                        <a href="mycart.php " style="border-top-left-radius:0px;border-top-right-radius:0px;">My</br></br>Cart</a>
                                        <a href="profile.php">My</br></br>Orders</a>
										<a href="addproduct.php">Add</br></br>Product</a>
                                        <a href="settings.php" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;">Settings</a>
										
                                     </div>
                                    </div> 
									 <div class="dropdown2">
                                        <button class="dropbtn2" onclick="myFunction1()">Categories
                                         <i class="fa fa-caret-down"></i>
                                        </button>
                                     <div class="dropdown-content2" id="myDropdown2">
										<a href="OurProducts/back.php" style="border-top-left-radius:0px;border-top-right-radius:0px;">BACK&pack</a>
				                        <a href="OurProducts/carpet.php" >CARPETS</a>
				                        <a href="OurProducts/tent.php" >TENTS</a>
				                        <a href="OurProducts/sleep.php" >SLEEP&Bag</a>
				                        <a href="OurProducts/torch.php" >TORCH</a>
				                        <a href="OurProducts/power.php" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;">POWER&Bank</a>
                                     </div>
                                    </div> 
                                   </div>
								   </div>';
						}
						else {
							echo '<div style="color: #FFFFFF;line-height: 10px;padding: 0px 24px;text-align: center;text-decoration: none;float: right;margin: 20px 0px 0px 10px; font-size: 10px;"> 
							<div class="navbar1">
							<div class="dropdown2" style="float:left">
                                        <button class="dropbtn2" onclick="myFunction1()">Categories
                                         <i class="fa fa-caret-down"></i>
                                        </button>
                                     <div class="dropdown-content2" id="myDropdown2" >
										<a href="back.php" style="border-top-left-radius:0px;border-top-right-radius:0px;">BACK&pack</a>
				                        <a href="carpet.php" >CARPETS</a>
				                        <a href="tent.php" >TENTS</a>
				                        <a href="sleep.php" >SLEEP&Bag</a>
				                        <a href="torch.php" >TORCH</a>
				                        <a href="power.php" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;">POWER&Bank</a>
                                     </div>
                                    </div> 
                                   
							<a style="float:right" style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>
							</div></div>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style="height: 60px; width: 80px;" src="image/ayman.png">
				</a>
				</div>
			<div style="float:left;">
			<h1 style="padding:10px 0px 0px 0px ;color:white;font-size:40px;font-family:verdana;">TRIP ONLINE STORE</h1>
			</div>
			
			<div class="" style="float: right; margin:5px 0px 0px 0px; font-weight:bold;" >
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Looking for"><input type="submit" value="search" class="srcbutton" >
					</form>
			      <div class="srcclear"></div>
				</div>
			</div>
		</div>

		<?php
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 35%; padding-top: 20px;margin-top:5%;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2 style="text-align:center;">Add Product</h2>
										<div class="signup_error_msg">';
											if (isset($error_message)) {echo $error_message;}
										echo '</div>
										<div class="signupform_text"></div>
										<div>

											<form action="" method="POST" class="registration" enctype="multipart/form-data">
												<table>
													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Product Name:</h4>
														</td>
														<td>
																<input name="pname" " style="margin-left: 50px;  id="first_name"  required="required" class="first_name signupbox" type="text" size="30" value="'.$pname.'" >
														</td>
													</tr><br><br

													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Price:</h4>
														</td>
														<td>
																<input name="price" style="margin-left: 50px; id="last_name" required="required" class="last_name signupbox" type="text" size="30" value="'.$price.'" >
														</td>
													</tr>

													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Piece(unit):</h4>
														</td>
														<td>
																<input name="piece" style="margin-left: 50px; id="piece" required="required" class="piece signupbox" type="text" size="30" value="'.$piece.'" >
														</td>
													</tr>

													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Available:</h4>
														</td>
														<td>
																<input name="available" style="margin-left: 50px; placeholder="Available Quantity" required="required" class="email signupbox" type="text" size="30" value="'.$available.'">
														</td>
													</tr>

													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Description:</h4>
														</td>
														<td>
																<input name="descri" style="margin-left: 50px; id="first_name" required="required" class="first_name signupbox" type="text" size="30" value="'.$descri.'" >
														</td>
													</tr>

													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Item:</h4>
														</td>
														<td>
															<select name="item" required="required" style=" font-size: 20px;
																	font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 8px;line-height: 25px;border-radius: 4px;border: 1px solid black;color: black;margin-left: 50px;width: 270px;background-color: transparent;">
																		<option selected value="back">BACK&Pack</option>
																        <option value="carpet">CARPETS</option>
																        <option value="tent">TENTS</option>
																        <option value="sleep">SLEEP&Bag</option>
																        <option value="torch">TORCH</option>
																        <option value="power">POWER&Bank</option>
														</td>
													</tr>

													<tr>
														<td>
															<h4 class="label_content" style="float: left;font-size:20px;">Picture:</h4>
														</td>
														<td>
															<input name="profilepic"style=" font-size: 15px;font-style: italic;padding:20px;border-radius: 4px;border: 1px solid black;color: black;margin-left: 50px;width: 270px;background-color: transparent;" class="password signupbox" type="file" value="Add Pic">
														</td>
													</tr>
												</table>


												<input name="signup"  style=" font-size: 20px;font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid black;color: black;margin-left: 100px;width: 304px;background-color: transparent;" class="uisignupbutton signupbutton" type="submit" value="Add Product">

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
