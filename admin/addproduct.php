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
	if (file_exists("../image/product/$item")) {
		//nothing
	}else {
		mkdir("../image/product/$item");
	}
	
	
	$filename = strtotime(date('Y-m-d H:i:s')).$file_ext;

	if (file_exists("../image/product/$item/".$filename)) {
		echo @$_FILES["profilepic"]["name"]."Already exists";
	}else {
		if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"], "../image/product/$item/".$filename)){
			$photos = $filename;
			$result = mysqli_query($con,"INSERT INTO products(pName,price,piece,description,available,category,type,item,pCode,picture) VALUES ('$_POST[pname]','$_POST[price]','$_POST[piece]','$_POST[descri]','$_POST[available]','$_POST[category]','$_POST[type]','$_POST[item]','$_POST[code]','$photos')");
				header("Location: allproducts.php");
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
		<title>Welcome to my Trip online Store</title>
		<link rel="icon" href="../image/ayman.png" type="image/x-icon">
	<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<script src="dropdown.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body class="home-welcome-text" style=" background-image: url(../image/12.jpg); background-attachment: fixed; background-position: center center; background-repeat: no-repeat; background-size:cover;height:578px">
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
                                        <a href="addproduct.php"  style="background-color:#4d0202"  style="border-top-left-radius:0px;border-top-right-radius:0px;">Add</br></br>Product</a>
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
		
		<?php 
			if(isset($success_message)) {echo $success_message;}
			else {
				echo '
					<div class="holecontainer" style="float: right; margin-right: 25%;margin-top:70px;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2 style="margin-left:220px">Add Product</h2>
										<div class="signup_error_msg">';
											if (isset($error_message)) {echo $error_message;}
										echo '</div>
										<div class="signupform_text"></div>
										<div>

											<form action="" method="POST" class="registration" enctype="multipart/form-data">
												<div class="signup_form">

											<div>
											<div class="label_content" style="float: left;">
  											<h5>Product Name:</h5>
  											</div>
														
												<input name="pname" " style="margin-left: 50px;  id="first_name"  required="required" class="first_name signupbox" type="text" size="30" value="'.$pname.'" >
											</div></br>

											<div>
											<div class="label_content1" style="float: left;">
  											<h5>Price:</h5>
  											</div>
												<td >
												<input name="price" style="margin-left: 180px; id="last_name" required="required" class="last_name signupbox" type="text" size="30" value="'.$price.'" >
												</td>
											</div></br>



											<div>
											<div class="label_content11" style="float: left;">
  											<h5>Piece(unit):</h5>
  											</div>
											<td >
											<input name="piece" style="margin-left: 100px; id="piece" required="required" class="piece signupbox" type="text" size="30" value="'.$piece.'" >
											</td>
											</div></br>


											<div>
											<div class="label_content1" style="float: left;">
  											<h5>Available:</h5>
  											</div>
												<td>
												<input name="available" style="margin-left: 123px; placeholder="Available Quantity" required="required" class="email signupbox" type="text" size="30" value="'.$available.'">
												</td>
											</div></br>
													

											<div>
											<div class="label_content1" style="float: left;">
  											<h5>Description:</h5>
  											</div>
												<td >
												<input name="descri" style="margin-left: 90px; id="first_name" required="required" class="first_name signupbox" type="text" size="30" value="'.$descri.'" >
												</td>
											</div></br>
													
													
											<div>
											<div class="label_content1" style="float: left;">
  											<h5>Item:</h5>
  											</div>
												<td>
												<select name="item" required="required" style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #4d0202;color: #4d0202;margin-left: 195px;width: 300px;background-color: transparent;" class="">
																<option selected value="back">BACK&Pack</option>
																<option value="carpet">CARPETS</option>
																<option value="tent">TENTS</option>
																<option value="sleep">SLEEP&Bag</option>
																<option value="torch">TORCH</option>
																<option value="power">POWER&Bank</option>
																
												</select>
												</td>
											</div></br>
													

											<div>
											<div class="label_content1" style="float: left;">
  											<h5>Product Code:</h5>
  											</div>
												<td>
												<input name="code" id="password-1" style="margin-left: 60px;   required="required"  placeholder="Code" class="password signupbox " type="text" size="30" value="'.$pCode.'">
												</td>
											</div></br>
											

											<div>
											<div class="label_content1" style="float: left;">
  											<h5>Picture:</h5>
  											</div>
											<input name="profilepic"style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #4d0202;color: #4d0202;margin-left: 152px;width: 270px;background-color: transparent;" class="password signupbox" type="file" value="Add Pic">
											</div></br>


											<div>
											<input name="signup"  style=" font-size: 20px;
														font-style: italic;margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #4d0202;color: #ffff;margin-left: 260px;width: 304px;background-color: transparent;" class="uisignupbutton signupbutton" type="submit" value="Add Product">
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