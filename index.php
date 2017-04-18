<?php
  include('database/Function.php');
  $db = new Database;
  $db->indexCheckLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Food Diary App - Welcome</title>
	<?php include ('include/links.php'); ?>
</head>
<body>
  <section id="index-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <img class="index-banner-logo" src="img/logo.png" />
          <h1 class="index-foodAppName">Food diary app</h1>
          <p class="index-foodAppDescription">
            Food diaries are an excellent way to track what you're eating. But how about tracking your eating behaviour based on your emotions? Would it be possible? Yes! Food Diary App is all you need. <br/><br/>Food Diary App is a place where you can actively track each meal of the day based on your current emotion. This online emotion-based food diary application greatly helps anyone who wants to see what they’re really eating and start making some changes. Food Diary App is a free, secure way to keep track of your food intake. The benefits of journaling for food tracking are substantial and free.
          </p>
        </div>
      </div>
    </div>
  </section>
  <section id="features">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 feature">
          <span class="fa fa-cutlery"></span>
          <h2 class="feature-name">Add Entries</h2>
          <p class="feature-description">
            Food Diary App lets you create new entries for each day or each meal (breakfast, lunch, dinner, snacks). In creating a new entry, users are first asked about their current emotion and plot it in the Circumplex Model of Emotions. 
          </p>
        </div>
        <div class="col-md-4 col-sm-4 feature">
          <span class="fa fa-calendar-o"></span>
          <h2 class="feature-name">View Entries</h2>
          <p class="feature-description">
            Tracking your food entries in Food Diary App is an easy task. It is presented in a calendar manner for a quicker navigation. You can view your entries by clicking the specific dates. 
          </p>
        </div>
        <div class="col-md-4 col-sm-4 feature">
          <span class="fa fa-dashboard"></span>
          <h2 class="feature-name">Dashboard</h2>
          <p class="feature-description">
            This lets you see the visualization of the summary of your food diary. It displays your total food intake entries by meal. It also shows the food distribution in the Circumplex Model, graphs of your food intake per emotion and by meal per emotion. Your recent food entries are also displayed in this feature. 
          </p>
        </div>
      </div>
    </div>
  </section>
  <section id="signin">
    <div class="container">
      <div class="row">
        <p class="signInHeader">start yours today and take your food diary to a new level</p>
        <a href="sign-in.php" class="index-signinButton">Sign in</a>
      </div>
    </div>
  </section>
</body>
</html>