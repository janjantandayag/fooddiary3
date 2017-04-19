<?php
   	include('database/Function.php');
   	$_SESSION['detail'] = [];
    $db = new Database;
    $db->isLogin();
    if(isset($_GET['date'])){
    	$_SESSION['date'] = $_GET['date'];
    	if($_SESSION['date'] == date("Y-m-d")){ 			
    		$_SESSION['date'] = date("Y-m-d");
    		$_SESSION['throwdate'] = date("Y-m-d");
    		$_SESSION['echodate'] = 'TODAY';
    	}
    	else{
    		$_SESSION['date'] = $_GET['date'];
    		$_SESSION['throwdate'] = $_GET['date'];
    		$_SESSION['echodate'] = date("M d, Y",strtotime($_GET['date']));
    	}
    }
    else{
    	$_SESSION['date'] = date("Y-m-d");
		$_SESSION['throwdate'] = date("Y-m-d");
 		$_SESSION['echodate'] = 'TODAY';
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry</title>
	<?php include ('include/links.php'); ?>
</head>
<body class="mainPage">	
	<?php include('include/header.php'); ?>
	<section id="breadcrumb">
		<div class="container">
			<div class="row breadcrumbContainer">
				<div class="col-md-12">
					<a href="dashboard.php" class="breadcrumb-link"><span class="fa fa-dashboard"></span> dashboard</a>
					<a href="#"  class="breadcrumb-link  breadcrumb-link-active"><span class="fa fa-plus-square-o"></span> add entry</a>
					<a href="#" id="help-circumplex" data-toggle="modal" title="Click for further info" data-target="#myModal"><span class="fa fa-question-circle"></span></a>
				</div>
			</div>
		</div>
	</section>
	<section id="addEntry-header">
		<div class="container">
			<div class="row addEntry-header--container">
				<div class="col-md-12">
					<h3 class="addEntry--header"><?= $_SESSION['echodate'] ?></h3>
				</div>
			</div>
		</div>
	</section>
	<section id="addEntry-body">
		<div class="container">
			<div class="row addEntry-body--container">
				<?php
					$mealId=[1,2,3,4];
					foreach($mealId as $id):
				?>				
				<div class="col-md-3 col-sm-6 mealContainer">
					<p class="mealName breakfast"><?= $db->getMealName($id) ?></p>
					<a href="circumplex.php"  onClick='storeMealType(<?=$id?>)' title="Add Entry" class="addEntryIcon"><span class="fa fa-plus"></span></a>
					<div class="mealQuantityContainer">
						<p class="mealQuantity"><?= $db->getMealCount($id) ?></p>
					</div>
					<?php if(!($db->getMealCount($id))): ?>
						<div class="noEntry">No entry</div>
					<?php
					 	endif;
						foreach($db->getMeals($id) as $meal):
					?>
					<div class="entryContainer" id="itemView-<?=$meal['item_id'];?>">
						<div class="row">
							<div class="col-md-4">
								<img src="data:image/jpeg;base64,<?= $db->displayImage($meal['item_id']); ?>" class="bodyImg"/>
							</div>
							<div class="col-md-8 ">
								<h2 class="entryName"><?= $meal['food_name']; ?></h2>
								<p class="servingSize"><span class="fa fa-commenting" style="margin-right:5px"></span> <?= $meal['serving_size']; ?></p>
								<p class="servingSize"><span class="fa fa-smile-o" style="margin-right:5px"></span> <?= strtoupper($meal['emotion_name']); ?></p>
								<p class="servingSize"><span class="fa fa-calendar-plus-o" style="margin-right:5px"></span>
									<?php 
										$date = strtotime($meal['date_added']);
										$dateFormatted = date('M d, Y',$date);
										echo $dateFormatted;
									?>
								</p>
								<p class="entryDate"><span class="fa fa-clock-o" style="margin-right:5px"></span>
									<?php 
										$date = strtotime($meal['date_eaten']);
										$dateFormatted = date('h:i:s A',$date);
										echo $dateFormatted;
									?>
								</p>
								<a href="http://www.facebook.com/sharer/sharer.php?u=http://diary.x10.mx/sharing.php?id=<?= $db->generateRandomString(); ?>&itemId=<?= $meal['item_id']; ?>&bogus=<?=$db->generateRandomString();?>" class="share" value=""><span class="fa fa-facebook" style="margin-right:5px"></span> Share</a>
							</div>
						</div>				
					</div>			
					<?php endforeach; ?>
				</div>
				<?php
					endforeach;
				?>
			</div>
		</div>
	</section>
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" id="helpCircumplexdialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Process</h4>
        </div>
        <div class="modal-body">
          <video width="100%" controls>
            <source src="video/add.mp4" type="video/mp4">
            <source src="video/add.mp4" type="video/ogg">
            Your browser does not support HTML5 video.
          </video>
        </div>
      </div>
    </div>
  </div>


<script type="text/javascript">
	$(document).ready(function() {
    $('.share').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
});
</script>
<script>
$("#showItem").click(function(){
    $(".itemView").toggle();
});

function storeMealType(mealId){
	$.ajax({
		type: 'GET',
		url: 'database/script-meal.php?mealId='+mealId
	});
}
</script>
</body>
</html>