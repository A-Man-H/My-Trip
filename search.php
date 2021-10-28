<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($con,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}

if (isset($_REQUEST['keywords'])) {

	$epid = mysqli_real_escape_string($con,$_REQUEST['keywords']);
	if($epid != "" && ctype_alnum($epid)){
		
	}else {
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>search</title>
	<link rel="icon" href="image/ayman.png" type="image/x-icon">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="dropdown1.js"></script>
	<script src="dropdown2.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	
</head>
<body>
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
										<a href="OurProducts/back.php" style="border-top-left-radius:0px;border-top-right-radius:0px;">BACK&pack</a>
				                        <a href="OurProducts/carpet.php" >CARPETS</a>
				                        <a href="OurProducts/tent.php" >TENTS</a>
				                        <a href="OurProducts/sleep.php" >SLEEP&Bag</a>
				                        <a href="OurProducts/torch.php" >TORCH</a>
				                        <a href="OurProducts/power.php" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;">POWER&Bank</a>
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
				<img style="height: 60px; width: 90px;border-radius: 12px;" src="image/ayman.png">
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
	<div style="background-image:url(image/93.jpg) ;background-position: center center; background-repeat: no-repeat;   background-size: cover;">
	<div class="categolis" >
		
	</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
				$getposts = mysqli_query($con,"SELECT * FROM products WHERE pName like '%$search_value%'  ORDER BY id DESC") or die(mysql_error());
					if ( $total = mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="ourproducts/view_product.php?pid='.$id.'">
										<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' DH</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}else {
				echo '<a style="padding:30px 30px 40px 300px;margin-right:200px;font-size:40px;font-weight:bold">Try with another product</a>';
			}
			}else {
				echo "Input Someting...";
			}
			
		?>
			
		</div>
	</div>
	</div>
	<section id="contact">
            <div class="wrapper">
                <h3>Contact-us</h3>
                <p>At My Trip live a better travel</p>
                
                <form>
                    <label for="name">Name</label>
                    <input type="text" id="name" placeholder="your Name">
                    <label for="email">Email</label>
                    <input type="text" id="email" placeholder="Your email">
                    <p><a  class="mail"href="mailto:aymane.hasnaoui1@gmail.com" >ok</a></p>
                </form>
            </div>
        </section>
        
        
        <footer>
            <div class="wrapper">
                <h1>My Trip Store<span class="orange">.</span></h1>
                <div class="copyright">Copyright © 2020. All rights reserved.</div>
			</div>
        </footer>
</body>
</html>