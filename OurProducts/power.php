<?php include ( "../inc/connect.inc.php" ); ?>
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>POWER</title>
	<link rel="icon" href="../image/ayman.png" type="image/x-icon">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../mainheader.inc.php" ); ?>
	<div class="categolis" style="background-image:url(../image/93.jpg) ;background-position: center center; background-repeat: no-repeat;   background-size: cover;">
		
	<div style="padding: 15px 0px; font-size: 15px; margin: 0 auto; display: table; width: 100%;">
		<div>
		<?php 
			$getposts = mysqli_query($con ,"SELECT * FROM products WHERE available >='1' AND item ='power'  ORDER BY id DESC LIMIT 10") or die(mysql_error());
					if (mysqli_num_rows($getposts)) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="../image/product/power/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' DH</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
		?>
			
		</div>
	</div></div>
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