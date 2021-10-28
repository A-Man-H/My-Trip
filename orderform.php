<?php include ( "inc/connect.inc.php" ); ?>
<?php 

if (isset($_REQUEST['poid'])) {
	
	$poid = mysqli_real_escape_string($con,$_REQUEST['poid']);
}else {
	header('location: index.php');
}
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	header("location: login.php?ono=".$poid."");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);

			$uname_db = $get_user_email['firstName'];
			$ulast_db=$get_user_email['lastName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}


$getposts = mysqli_query($con,"SELECT * FROM products WHERE id ='$poid'") or die(mysqli_error());
					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$category = $row['category'];
						$available =$row['available'];
					}	

//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$quan = $_POST['Quantity'];
$del = $_POST['Delivery'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['Quantity'])) {
			throw new Exception('Quantity can not be empty');
			
		}
		if(empty($_POST['Delivery'])) {
			throw new Exception('Type of Delivery can not be empty');
			
		}

		
		// Check if email already exists
		
		
						$d = date("Y-m-d"); //Year - Month - Day
						
						// send email
						$msg = "
					
						Your Order suc

						
						";
						//if (@mail($uemail_db,"mytrip store Product Order",$msg, "From:my trip stor <no-reply@mytrip.xyz>")) {
							
						if(mysqli_query($con,"INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,delivery,price) VALUES ('$user','$poid',$quan,'$_POST[address]','$_POST[mobile]','$d','$del',$price)")){

							//success message
							

							
						$success_message = '
						<div class="signupform_content">
						<h2><font face="bookman"></font></h2>
						<script>
						alert("you ll receive your item as soon as possible");
						</script>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">

						</font></div></div>
						';
						

						

							
						}
						//}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>BACK&Pack</title>
	<link rel="icon" href="image/ayman.png" type="image/x-icon">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="dropdown1.js"></script>
	<script src="dropdown2.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image: url(image/94.jpg);background-position: center center; background-repeat: no-repeat;   background-size: cover;">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="signup.php">SIGN UP</a>';
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
                                   
							<a style="float:right" style="text-decoration: none; color: #fff;" href="../login.php">LOG IN</a>
							</div></div>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 60px; width: 90px;" src="image/ayman.png">
				</a>
			</div>
			<div style="float:left;">
			<h1 style="padding:10px 0px 0px 0px ;color:white;font-size:40px;font-family:verdana;">TRIP ONLINE STORE</h1>
			</div>
			<div class="" style="float: right; margin:5px 0px 0px 0px; ">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Looking for"><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
	<div class="categolis" >
		
		</div>
		
	<div class="holecontainer" style="padding: 20px 15%">
		<div class="container signupform_content ">
			<div>


				<div style="float: left;">

				<?php 
					if(isset($success_message)) {echo $success_message;
					       

									echo '<h3 style="color:#0d7da6;font-size:45px;"> Payment Receipt </h3>';

                        
						$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$ulast_db=$get_user_email['lastName'];
			$uemail_db = $get_user_email['email'];
			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
			echo '<h3 style="color:#b05b15;font-size:25px;"> First Name: </h3>';
			echo'<span style="color:black;font-size:25px;">'. $uname_db.'</span>';
			echo '<h3 style="color:#b05b15;font-size:25px;"> Last Name: </h3>';
			echo'<span style="color:black;font-size:25px;">' .$ulast_db.'</span>';
			echo '<h3 style="color:#b05b15;font-size:25px;"> Email: </h3>'; 
			echo '<span style="color:black;font-size:25px;">' .$uemail_db.'</span>';
			echo '<h3 style="color:#b05b15;font-size:25px;"> Contact Number: </h3>';
			echo '<span style="color:black;font-size:25px;">' .$umob_db.'</span>';
			echo '<h3 style="color:#b05b15;font-size:25px;"> Home Address: </h3>';
			echo '<span style="color:black;font-size:25px;">'.$uadd_db.'</span>';
			
			$del = $_POST['Delivery'] ;
			echo '<h3 style="color:#b05b15;font-size:25px;">Types of Delivery:</h3>';
			echo'<span style="color:#000;font-size:25px;">' .$del.'</span>';
			$quan = $_POST['Quantity'];
			echo '<h3 style="color:#b05b15;font-size:25px;"> Quantity: </h3>';
			echo'<span style="color:#black;font-size:25px;">' .$quan.'</span>';
			
			echo '<h3 style="color:#0d7da6;font-size:45px;"> Total: '.$quan * $price.' DH</h2>';
			

	

			

					}
					else {
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form">
								
									<div>
										<td>
											<input name="fullname" placeholder="your name" required="required" class="email signupbox" type="text" size="30" value="'.$uname_db.'">
										</td>
									</div>

									<div>
										<td>
											<input name="lastname" placeholder="Your last name" required="required" class="email signupbox" type="text" size="30" value="'.$ulast_db.'">
										</td>
									</div>



									<div>
									<td>
											<input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
										</td>
									</div>
									<div>
										<td>
											<input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
										</td>
									</div>

									<div>
									<td>

									<font style="italic" family="arial" size="5px" color="#000">
									Delivery types: <br>
									

									 <input name="Delivery" required="required" value="Amana +50 DH " type="radio"  placeholder="Mode Of Payment" > Amana +50 DH </br>
									 <input name="Delivery" type="radio" value="Poste Maroc free" required="required" placeholder="Mode Of Payment"> Post Maroc free </br>
									 </font>


									</td>
									</div>


									<div>
									<td>

									 <input name="Quantity" required="required" type="number" min="1" class="password signupbox" placeholder="Quantity">

									</td>
									</div>
									


									



									
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
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

					}

				 ?>
					</h3>
				</div>

			</div>
		</div>
		<div style="float: right; font-size: 23px;">
			<div>
				<?php
					echo '
						<ul style="float: right;">
							<li style="float: right; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img"><a href="'.$category.'/projetMytrip/OurProducts/view_product.php?pid='.$id.'">
									<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height:300px;width:250px">
									</a>
									<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' DH</div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
		<?php 
					if(isset($success_message)):?>
					<div class="categolis" >
					<h1 style="color:#000;">click to</h1>
					<a href="print.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: red;border-radius: 12px;">PRINT</a></div>
					<?php endif ; ?>
					
	</div>
</body>
</html>