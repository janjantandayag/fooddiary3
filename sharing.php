<?php
   	include('database/Function.php');
    $db = new Database;
    if(isset($_GET['itemId'])){      
?>
<!DOCTYPE html>
<html>
<head>
	<title>Feed</title>
	<?php include ('include/links.php'); ?>
</head>
<body class="sharingBody">
  <header>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <img src="img/logo.png" class="logo"/>
          <h1>Food App</h1>
        </div>
      </div>
    </div>
  </header>
  <?php $result = $db->feedQuery($_GET['itemId']); ?>
  <section id="sharingContent">
    <div class="container sharingContentContainer">
      <div class="row">
        <div class="col-md-12">
          <div class="sharingContent-top">
            <div class="user-datecontainerMobile">
              <span class="user-date"><?= date("M d, Y",strtotime($result['entry_date'])); ?></span>
              <span class="user-time"><?= date("H:i:s A",strtotime($result['entry_date'])); ?></span>
              <span class="user-meal"><?= $result['meal_name']; ?></span>
            </div>
            <div>
              <span class="user-img fa fa-user" ></span>
              <span class="user-name"><?= $result['first_name'].' '.$result['last_name']; ?></span>
              <span class="user-emotion"><?= $result['emotion_name']; ?></span>
            </div>
            <div class="user-datecontainer">
              <span class="user-date"><?= date("M d, Y",strtotime($result['entry_date'])); ?></span>
              <span class="user-time"><?= date("H:i:s A",strtotime($result['entry_date'])); ?></span>
              <span class="user-meal"><?= $result['meal_name']; ?></span>
            </div>
          </div>
        </div>
      </div>
      <div class="row contentContainer">
        <div class="col-md-12">
          <p class="food-description"><?= $result['food_description'];?></p>
          <img class="food-img" src="database/displayImage.php?itemId=<?=$result['item_id']; ?>" />
          <p class="food-name"><?= $result['food_name']; ?></p>
          <p class="food-serving"><?= $result['serving_size']; ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="index.php" class="sharing-signInButton">Sign in</a>
        </div>
      </div>
    </div>
  </section>
<script>
</script>
</body>
</html>
<?php } 
else{
  echo "<script>window.location.href='index.php';</script>";
}
?>
