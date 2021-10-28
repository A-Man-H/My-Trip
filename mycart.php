<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];
			$ulast_db=$get_user_email['lastName'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}



if (isset($_REQUEST['cid'])) {
		$cid = mysqli_real_escape_string($con,$_REQUEST['cid']);
		if(mysqli_query($con,"DELETE FROM orders WHERE pid='$cid' AND uid='$user'")){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}

$search_value = "";


									$query = "SELECT * FROM cart WHERE uid='$user' ORDER BY id DESC";
									$run = mysqli_query($con,$query);
									$total = 0;
									while ($row=mysqli_fetch_assoc($run)) {
										$pid = $row['pid'];
										$quantity = $row['quantity'];
										
										//get product info
										$query1 = "SELECT * FROM products WHERE id='$pid'";
										$run1 = mysqli_query($con,$query1);
										$row1=mysqli_fetch_assoc($run1);
										$pId = $row1['id'];
										$pName = substr($row1['pName'], 0,50);
										$price = $row1['price'];
										$description = $row1['description'];
										$picture = $row1['picture'];
										$item = $row1['item'];
										$category = $row1['category'];

										$total += ($quantity*$price);
									$_SESSION['total'] = $total;}
									 
//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$del = $_POST['Delivery'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
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
						
						$result = mysqli_query($con,"SELECT * FROM cart WHERE uid='$user'");
						$t = mysqli_num_rows($result);
						if($t <= 0) {
							throw new Exception('No product in cart. Add product first.');
							
						}
						while ($get_p = mysqli_fetch_assoc($result)) {
							$num = $get_p['quantity'];
							$pid = $get_p['pid'];

							mysqli_query($con,"INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,delivery,price) VALUES ('$user','$pid',$num,'$_POST[address]','$_POST[mobile]','$d','$del',$price)");
						}
							
						if(mysqli_query($con,"DELETE FROM cart WHERE uid='$user'")){

							//success message
							
						$success_message = '
						<div class="signupform_content">
						<h2><font face="bookman"></font></h2>

						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">

						</font></div></div>
						';
							
						}
						

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>MY cart</title>
	<link rel="icon" href="image/ayman.png" type="image/x-icon">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
			<div id="srcheader" style="float:right;margin:5px 0px 0px 0px;">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Looking for" value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
			</div>
		</div>
		<div class="categolis">
			
		</div>
	<div style="margin-top: 20px; padding: 0 10%;">
		<div style=" margin: 0 auto; width: 55%;float: right;">
		
			<ul>
				<li ">
					<div>
						<div>
							<table class="rightsidemenu" style="color:#000;" border-radius=12px >
								<tr style="font-weight: bold; height:40px;"  colspan="10" >
									<th>Product Name</th>
									<th>Price</th>
									<th>Pieces</th>
									<th>Description</th>
									<th>View</th>
									<th>Remove</th>
								</tr>
								<tr >
									<?php include ( "inc/connect.inc.php");
									$query = "SELECT * FROM cart WHERE uid='$user' ORDER BY id DESC";
									$run = mysqli_query($con,$query);
									$total = 0;
									while ($row=mysqli_fetch_assoc($run)) {
										$pid = $row['pid'];
										$quantity = $row['quantity'];
										
										//get product info
										$query1 = "SELECT * FROM products WHERE id='$pid'";
										$run1 = mysqli_query($con,$query1);
										$row1=mysqli_fetch_assoc($run1);
										$pId = $row1['id'];
										$pName = substr($row1['pName'], 0,50);
										$price = $row1['price'];
										$description = $row1['description'];
										$picture = $row1['picture'];
										$item = $row1['item'];
										$category = $row1['category'];

										$total += ($quantity*$price);
										$_SESSION['total'] = $total;
									 ?>
									<th><?php echo $pName; ?></th>
									<th><?php echo $price; ?></th>
									<th><?php echo '<a href="delete_cart.php?sid='.$pId.'" style="text-decoration: none;padding: 0px 5px;font-size: 25px;color: white;border: 1px solid;margin: 10px;">-</a>' ?><?php echo $quantity; ?><?php echo '<a href="delete_cart.php?aid='.$pId.'" style="text-decoration: none;padding: 0px 5px;font-size: 25px;color: white;border: 1px solid;margin: 10px;">+</a>' ?></th>
									<th><?php echo $description; ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="OurProducts/view_product.php?pid='.$pId.'">
													<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
													</a>
												</div>' ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="delete_cart.php?cid='.$pId.'" style="text-decoration: none;">X</a>
												</div>' ?></th>
								</tr>
								<?php } ?>
								<tr style="font-weight: bold; height:40px;"  colspan="10" >
									<th>Total</th>
									
									<th><?php echo $total ?> DH</th>
									
									
									
								</tr>
							</table>
						</div>
					</div>
				</li>
				
			</ul>
		</div>
		<div class="holecontainer" style="float: left;width: 35%;">
			<div class="container signupform_content ">
				<div>
					<div style="" >
					
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
				echo '<div >
					<h1 style="line-height: 1.3;font-weight: bold;color: #000;font-size: 27px;">click to</h1><br>
					<a href="print.php" style="text-decoration: none;color: #040403;text-align: center;background-color: red;font-size: 27px;border-radius: 12px;">PRINT</a></div>';
				echo '<h3 style="color:#b05b15;font-size:25px;"> First Name: </h3>';
				echo'<span style="color:black;font-size:25px;">'. $uname_db.'</span>';
				echo '<h3 style="color:#b05b15;font-size:25px;"> Last Name: </h3>';
				echo'<span style="color:black;font-size:25px;">' .$ulast_db.'</span>';
				echo '<h3 style="color:;#b05b15font-size:25px;"> Email: </h3>'; 
				echo '<span style="color:black;font-size:25px;">' .$uemail_db.'</span>';
				echo '<h3 style="color:#b05b15;font-size:25px;"> Contact Number: </h3>';
				echo '<span style="color:black;font-size:25px;">' .$umob_db.'</span>';
				echo '<h3 style="color:#b05b15;font-size:25px;"> Home Address: </h3>';
				echo '<span style="color:black;font-size:25px;">'.$uadd_db.'</span>';
				
				$del = $_POST['Delivery'] ;
				echo '<h3 style="color:black;font-size:25px;">Delivery types:</h3>';
				echo'<span style="color:#b05b15;font-size:25px;">' .$del.'</span>';
				
				echo '<h3 style="color:#0d7da6;font-size:35px;"> Total: DH '.$_SESSION['total'].' DH</h2>';
				

						}
						else {
						echo '
							
							<div class="signupform_text"></div>
							

								<form action="" method="POST" class="registration" style="foat:left">
							
									<div class="signup_form" style="foat:left">
									
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

										<font style="italic" family="arial" size="5px" color="black">
										Delivery types <br>
										

										 <input name="Delivery" required="required" value="Amana +50Dh " type="radio"  placeholder="Mode Of Payment"> Amana+50Dh</br>
										 <input name="Delivery" type="radio" value="Post maroc free" required="required" placeholder="Mode Of Payment"> Post Maroc </br>
										 </font>


										</td>
										</div>


										<div>
										</div>
										
										
										<div>
											<input onclick="myFunction()" name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
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
		</div>
	</div>
	
	
</body>
</html>