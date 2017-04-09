<?php
   	include('database/Function.php');
   	$_SESSION['detail'] = [];
    $db = new Database;
    $db->isLogin();
    $userDetail = $db->getUserDetails();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry</title>
	<?php include ('include/links.php'); ?>
	<!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="calendar/fullcalendar/fullcalendar.print.css" media="print">
</head>
<body class="mainPage">
	<header>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="left-col">
            <img src="img/logo.png">
            <h1 class="foodAppName" >Food Diary App</h1>
          </div>
          <div class="right-col">
            <ul id="topNav">
              <li  class="navActive"><a href="archive.php"><span class="fa fa-calendar-o"></span>archive</a></li>
              <li><a href="add-entry.php"><span class="fa fa-plus-square-o"></span>add entry</a></li> 
              <li><a href="dashboard.php"><span class="fa fa-dashboard"></span>dashboard</a></li>
              <li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span>steps</a></li>
              <li  class="userNav"><a href="#"><span class="fa fa-user"></span> Hello,  <span id="topName" ><?= $_SESSION['name']?>  </span></a>
                            <div class="dropdown-content">
                  <a href="setting.php"><span class="fa fa-gear"></span>settings</a>
                  <a href="database/logout.php"><span class="fa fa-power-off"></span>logout</a>
                </div>
              </li>
            </ul> 
          </div>
          <div>
            <a href="javascript:void(0);" onclick="myFunction();" class="icon">&#9776;</a>
                <ul  id="mobile"  class="displayNone">
                    <li><a href="archive.php"><span class="fa fa-calendar-o"></span> archive</a></li>
                    <li><a href="add-entry.php"><span class="fa fa-plus-square-o"></span> add entry</a>  </li>   
                    <li><a href="dashboard.php"><span class="fa fa-dashboard"></span> dashboard</a></li>
              <li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span> steps</a></li>
                    <li class="mobile-navActive"><a href="setting.php"><span class="fa fa-gear"></span> setting</a></li>
                    <li><a href="database/logout.php"><span class="fa fa-power-off"></span> <span id="topName"><?= $_SESSION['name'] ?></span>, logout </a>
                    </li>
                </ul>   
            </div>
        </div>
      </div>
    </div>
  </header>
	<section id="breadcrumb">
		<div class="container">
			<div class="row breadcrumbContainer">
				<div class="col-md-12">
					<a href="dashboard.php" class="breadcrumb-link"><span class="fa fa-dashboard"></span> dashboard</a>
					<a href="setting.php"  class="breadcrumb-link  breadcrumb-link-active"><span class="fa fa-gear"></span> settings</a>
				</div>
			</div>
		</div>
	</section>
	<section id="setting-body">
		<div class="container">
			<div class="row setting-bodyContainer">
			 <div class="col-md-6 col-sm-6 profileContainer">
          <p class="profileHEader">Update username/password</p>
          <form action="setting.php" method="POST">
              <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" placeholder="Enter username" name="username" value="<?= $userDetail['username'] ?>" required>
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" id="password" class="form-control" placeholder="Enter password" name="password" required >
              </div>
              <div class="form-group">
                  <label>Retype Password</label>
                  <input type="password" id="retype" class="form-control" onchange="isTheSame();" placeholder="Retype password" required>
                  <p id="alert"></p>
              </div>
              <button id="buttonChange" name="updatePassword" type="submit" class="btn btn-warning" onclick="check();">Update Details</button>
              <p id="alert"></p>
          </form>
          <?php 
            if(isset($_POST['updatePassword'])) {
              $db->updatePassUser($_POST['username'], $_POST['password']); 
             } 
            ?>
       </div>
       <div class="col-md-6 col-sm-6 profileContainer">
          <p class="profileHEader">Update Profile</p>
          <form>
              <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" id="firstName" placeholder="Enter first name" name="firstname" value="<?= $userDetail['first_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" id="lastName" placeholder="Enter last name" name="lastname" value="<?= $userDetail['last_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Gender (CURRENT: <?= $userDetail['gender'] ?> )</label>
                            <select class="form-control" id="gender" required>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input class="form-control" id="birthDate" type="date" value="<?= date("Y-m-d",strtotime($userDetail['date_of_birth']))?>"name="middlename" required>
                        </div>
                        <button type="button" class="btn btn-warning" onclick="updateUserDetails();">Update Profile</button>
                        <p id="alertSuccess" style="padding-top: 20px"></p>
          </form>
       </div>
			</div>
		</div>
	</section>
</body>
<script>
function check(){
  if(confirm('Are you sure you want to update the name?')){
  }
  else
  {
      return false;
  }
}
function isTheSame(){
  var password = document.getElementById("password").value;
  var retype = document.getElementById("retype").value;
  var message = $("#alert");
  if (password!=retype) {
      message.text('*Seems like you retyped your new password incorrectly');
      message.fadeIn(1000);
      $("#buttonChange").attr('disabled','disabled');
  }
  else{
      message.fadeOut(1000);
      $("#buttonChange").removeAttr('disabled');
  }
}
function updateUserDetails(){
  if(confirm('Are you sure you want to update the name?')){
      var firstName = document.getElementById('firstName').value;
      var lastName = document.getElementById('lastName').value;
      var gender = document.getElementById('gender').value;
      var birthdate = document.getElementById('birthDate').value;
      var prompt = $("#alertSuccess");
      var topName = $("#topName");
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200){                        
              topName.fadeOut('fast');
              topName.text(firstName); 
              topName.fadeIn('slow');
              prompt.text("Successfully updated!");
              prompt.css({
                  "color":"green",
                  "font-weight":"bold",
                  "font-family":"semiBold",
                  "margin-top":"20px",
                  "text-transform":"uppercase"
              });
              prompt.fadeIn(500);
              prompt.fadeOut(5000);
              }
      };

      xmlhttp.open("GET", "database/updateUserDetails.php?firstName=" + firstName+"&lastName="+ lastName+"&gender="+gender+"&birthday="+birthdate, true);
      xmlhttp.send();
  }
  else
  {
      return false;
  }
}
</script>
</html>