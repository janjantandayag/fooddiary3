<?php
   	include('database/Function.php');
    $db = new Database;
    $db->isLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php include ('include/links.php'); ?>
	<script src="highChart/highcharts.js"></script>
</head>
<body class="mainPage">	
	<?php include('include/header.php'); ?>
	<section>
		<div class="container ">
			<div class="row rangeFormContainer">
				<p class="rangeLabel"> *To display result for other dates, just change starting and ending dates below.</p>
				<form id="rangeForm" method="GET" action="dashboard.php">
					<div class="col-md-5 col-sm-5">		
					  <div class="form-group">
					    <label for="start" class="labelDate">Start date:</label>
					    <input type="date" class="form-control" id="start" required name="startDate" max="<?= date("Y-m-d"); ?>">
					  </div>
					</div>
					<div class="col-md-5 col-sm-5">			
					  <div class="form-group">
					    <label for="end" class="labelDate">End date:</label>
					    <input type="date" class="form-control" id="end" required name="endDate" max="<?= date("Y-m-d"); ?>">
					  </div>
					</div>
					<div class="col-md-2">
				  		<button type="submit" class="rangeSubmit" >Submit</button>
					</div>
				</form>				
			</div>
			<?php 
				if(isset($_GET['startDate']) && isset($_GET['endDate'])){
			?>
			<div class="showDates">
				<p class="rangeShowDateHeader">Showing results for: </p>
				<span class="rangeStart"><?= date("M d,Y",strtotime($_GET['startDate'])); ?></span>
				<span class="rangeTo"> up to  </span>
				<span class="rangeEnd"><?= date("M d,Y",strtotime($_GET['endDate'])); ?></span>
			</div>
			<a href="dashboard.php" class="showAllRange">show all entries </a>
			<?php } ?>
		</div>
	</section>
	<section id="visualization">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mealCountContainer">
					<div class="visualizationContainer">
						<div class="stat-header">
							<h3 class="mealHeader">Total Food Intake By Meal</h3>
						</div>
						<?php 
							$ids = [1,2,3,4];
							foreach($ids as $id):
						?>
						<div class="mealEntryContainer">
							<p class="mealLabelName"><?= $db->getMealName($id); ?></p>
							<div class="entryCountContainer">
								<p class="entryCount">
								<?php
									if(isset($_GET['startDate']) && isset($_GET['endDate'])){
										echo $db->countTotalEntriesDate($id,$_GET['startDate'],$_GET['endDate']);
									} 
									else{
										echo $db->countTotalEntries($id); 
									}
								?>									

								</p>
								<p class="entryLevel">entries</p>
							</div>
						</div>
						<?php endforeach; ?>
						<div class="totalCountContainer">
							<p class="totalCount">Total</p>
							<div class="entryCountContainer">
								<p class="totalEntryCount">
								<?php 
									if(isset($_GET['startDate']) && isset($_GET['endDate'])){
										echo $db->getTotalEntryDate($_GET['startDate'],$_GET['endDate']);
									} 
									else{
										echo $db->getTotalEntry(); 
									}
								?>								
								</p>
								<p class="totalLabel">entries</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 circumplexContainer">				
					<div class="visualizationContainer">
						<div class="circumplex-header">
							<h3 class="circumplexTitle">Food Distribution (Circumplex Model)</h3>
						</div>
						<div class="circumplex-body" style="margin-top:5px">		
							<div class="circumplex-model" id="circumplex-model">	
								<div class="label top">Pumped</div>
								<div class="label left">Negative</div>
								<div class="label right">Positive</div>
								<div class="label bottom">Relaxed</div>
								<?php
									if(isset($_GET['startDate']) && isset($_GET['endDate'])){
										$entries = $db->getEntriesDate($_GET['startDate'],$_GET['endDate']);
									}
									else{
										$entries = $db->getEntries();
									}
									foreach($entries as $entry){ ?>						
								<div class="circumplexFood" style="left:<?=$entry['xCoor']-3;?>%;top:<?=$entry['yCoor']-3;?>%">
									<h5 class="circumplexFoodName"><?=$entry['food_name'];?></h5>
									<img src="data:image/jpeg;base64,<?=$db->displayImage($entry['item_id']); ?>" style="border:<?= $db->getBorderColor($entry['emotion_id']); ?>;" class="circumplexFoodImg" />
								</div>
									<?php }	?>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="visualization">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="visualizationCarousel" class="carousel slide" >
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    <li data-target="#visualizationCarousel" data-slide-to="0" class="active"></li>
						    <li data-target="#visualizationCarousel" data-slide-to="1"></li>
						  </ol>
						  <!-- Wrapper for slides -->
						  <div class="carousel-inner" role="listbox">
						    <div class="item active">
								<div id="statChart"><?php $emotions = $db->getEmotion(); ?></div>
						    </div>
						    <div class="item">					      
								<div id="statChartByMeal"><?php $emotions = $db->getEmotion(); ?></div>
						    </div>
						  </div>
					 </div>
				 </div>
			</div>
		</div>		
	</section>
	<section id="recent-entries">
		<div class="container">
			<div class="recent-entries-container">
				<div class="row">
					<div class="col-md-12">
						<div class="recentEntriesHeading">
								<h3 class="recentEntriesHeader">Recent Entries</h3>
						</div>
					</div>
				</div>
				<div class="row recent-container">
					<?php foreach($db->getRecentEntries() as $recent) { ?>
					<div class="col-md-3 col-sm-6 recentContainer">
						<img class="recentEntriesImg" src="data:image/jpeg;base64,<?=$db->displayImage($recent['item_id']); ?>" />
						<div class="recentEntriesDesc">
							<p class="recentFoodName"><?=$recent['food_name'] ?> </p>
							<p class="recentEntriesDate"><span style="margin-right:5px" class="fa fa-calendar-plus-o"></span><?= date("M d,Y @h:i:s A",strtotime($recent['date_added'])) ?></p>
							<p class="recentEntriesDate"><span style="margin-right:5px;margin-top:10px" class="fa fa-calendar"></span><?= date("M d,Y @h:i:s A",strtotime($recent['date_eaten'])) ?></p>
							<p class="recentServing"><span style="margin-right:5px" class="fa fa-commenting"></span><?=$recent['food_description'] ?> </p>
							<p class="recentServing"><span style="margin-right:5px" class="fa fa-pie-chart"></span><?=$recent['serving_size'] ?> </p>
							<p class="recentServing"><span style="margin-right:5px" class="fa fa-smile-o"></span><?=$recent['emotion_name'] ?> </p>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</disv>
	</section>
<script>	
Highcharts.chart('statChart', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Food Intake per Emotion'
    },
    xAxis: {
        categories: ['Emotions']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Food Intake'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [
    <?php 
    	foreach($emotions as $emotion){
    		echo "{ name: '".strtoupper($emotion['emotion_name'])."',";   		
			if(isset($_GET['startDate']) && isset($_GET['endDate'])){	
				$countEmotion = $db->getEmotionCountDate($emotion['emotion_id'],$_GET['startDate'],$_GET['endDate']);
			}
			else{				
				$countEmotion = $db->getEmotionCount($emotion['emotion_id']);
			}
    		echo "data: [".$countEmotion."], color:'".$db->getBgColor($emotion['emotion_id'])."'},";
    	}
    ?>
    ]
});
Highcharts.chart('statChartByMeal', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Food Intake by Meal per Emotion'
    },
    xAxis: {
        categories: ['Breakfast','Lunch','Dinner','Snack']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Food Intake'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    },
    series: [
    <?php 
    	$mids = [1,2,3,4];
    	foreach($emotions as $emotion){
    		echo "{ name: '".strtoupper($emotion['emotion_name'])."',";
    		echo "data: [";
    		foreach($mids as $mid){
				if(isset($_GET['startDate']) && isset($_GET['endDate'])){	
					$stackCount = $db->getValueDate($emotion['emotion_id'],$mid,$_GET['startDate'],$_GET['endDate']);
				}
				else{
					$stackCount = $db->getValue($emotion['emotion_id'],$mid);
				}
    			echo $stackCount.',';
    		}
    		echo "], color:'".$db->getBgColor($emotion['emotion_id'])."'},";
    	}
    ?>
    ]
});
</script>
</body>
</html>