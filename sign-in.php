<?php
	include ('database/Function.php');	
	if(isset($_SESSION['loggedIn']) == true){
		echo "<script>
			window.location = 'dashboard.php';
		</script>";
	}
	else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<?php include ('include/links.php'); ?>
</head>
<body>
	<section id="mainPage">
		<div class="container">
			<div class="row">
				<div class="col-md-6">	
					<div class="form-container">
						<div class="form--header">
							<img src="img/logo.png" class="img-logo"/>
							<h1>Food Diary App</h1>
						</div>
						<div class="form--body">
							<div class="form">
								<form action="sign-in.php" method="POST">
									<input type="text" class="form-control" name='username' required placeholder="username" />
									<input type="password" class="form-control" name='password' required placeholder="password" />
									<input type="submit" name='submit' value="Log in" />
								</form>
								<?php
									$db = new Database;
									if(isset($_POST['submit'])){
										$username = htmlspecialchars(strtolower($_POST['username']));
										$password = htmlspecialchars(strtolower($_POST['password']));
										if($db->isExist($username,$password)){
											$db->login($username,$password);
										}
										else{ ?>
								<div class="message">
									<p>Incorrect username or password! Please try again!</p>
								</div>
								<?php		
									}
								}
								?>
							</div>
						</div>
						<div class="form--footer">
							<a href="#" data-toggle="modal" data-target="#myModal">Create an account</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					  <!-- Indicators -->
					  <ol class="carousel-indicators">
					    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
					  </ol>
					  <!-- Wrapper for slides -->
					  <div class="carousel-inner" role="listbox">
					    <div class="item active">
					      <img src="img/mobile-carousel.png" alt="Mobile View">
					    </div>
					    <div class="item">
					      <img src="img/web-carousel.png" alt="Desktop View">
					    </div>
					  </div>
				</div>
			</section>
		</div>
	</div>	
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sign Up</h4>
      </div>
      <div class="modal-body">
      	<form id="signUpForm" method="POST" action="database/Function.php">
      		<div class="row marginTop">
      			<div class="col-md-6 col-sm-6">
		      		<label for="firstName">First Name</label>
		    		<input type="text" class="form-control" name="firstName" id="firstName" required>
		    	</div>
      			<div class="col-md-6 col-sm-6">
		      		<label for="lastName">Last Name</label>
		    		<input type="text" class="form-control" name="lastName" id="lastName" required>
		    	</div>
	    	</div>
	    	<div class="row marginTop">
      			<div class="col-md-6 col-sm-6">
		      		<label for="gender">Gender</label>
		    		<select id="gender" name="gender" class="form-control" required>
		    			<option value="male">Male</option>
		    			<option value="female">Female</option>
		    		</select>
		    	</div>
      			<div class="col-md-6 col-sm-6">
		      		<label for="birthDate">Date of Birth</label>
		    		<input type="date" name="birthDate" class="form-control" id="birthDate" required>
		    	</div>
	    	</div>
	    	<div class="row marginTop">
      			<div class="col-md-6 col-sm-6">
		      		<label for="username">Username</label>
		      		<input type="text" class="form-control" id="username" name="username" required/>
		    	</div>
      			<div class="col-md-6 col-sm-6">
		      		<label for="password">Password</label>
		    		<input type="password" name="password" class="form-control" id="password" required>
		    	</div>
	    	</div>
	    	<input type="submit" name="signUp" id="signUpButton" value="Sign up"/>
      	</form>
      </div>
    </div>
  </div>
</div>
<script>
	$('.message').fadeOut(5000);	
</script>
</body>
</html>
<?php } ?>