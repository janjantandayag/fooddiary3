<!DOCTYPE html>
<html>
<head>
	<title>Steps</title>
	<?php include ('include/links.php'); ?>
</head>
<body class="documentationBody">
	<header class="docuHeader">
		<div class="container">
			<div class="row">
				<div class="nav">
					<a href="#dashboard">#dashboard</a>
					<a href="#addEntry">#add entry</a>
					<a href="#archive">#archive</a>
				</div>
			</div>
		</div>
	</header>
	<div id="dashboard">
		<div class="container dashboard">
			<div class="row">
				<h1>#dashboard</h1>
				<p class="headingDesc">In the dashboard page, you can see different types of visualization:</p>
				<div class="col-md-4">
					<img src="img/visualization-1.PNG" class="docuImg"/>
					<p class="helperDescription">Total Food Intake By Meal</p>
				</div>
				<div class="col-md-4">
					<img src="img/visualization-2.PNG" class="docuImg"/>
					<p class="helperDescription">Food Intake Distribution using Circumplex Model</p>
				</div>
				<div class="col-md-4">
					<img src="img/visualization-3.PNG" class="docuImg"/>
					<p class="helperDescription">Total Food Intake per Emotion</p>
				</div>
			</div>
			<div class="row">				
				<div class="col-md-4">
					<img src="img/visualization-4.PNG" class="docuImg"/>
					<p class="helperDescription">Total Food Intake By Meal per Emotion</p>
				</div>
			</div>
		</div>
	</div>
	<div id="addEntry">
		<div class="container addEntry">
			<div class="row">
				<h1>#add entry</h1>
				<p class="headingDesc">The default date is the current date. If you like to add entries on previous date, go to archive page <i>(archive.php)</i> These are the steps in adding entry to the diary:</p>
				<div class="col-md-4">
					<img src="img/archive-1.PNG" class="docuImg"/>
					<p class="step"><span>1</span>Click the 'plus' button to add new entry.</p>
				</div>
				<div class="col-md-4">
					<img src="img/archive-2.PNG" class="docuImg"/>
					<p class="step"><span>2</span> The system will ask the emotion you feel. Just click on the model.</p>
				</div>
				<div class="col-md-4">
					<img src="img/archive-3.PNG" class="docuImg"/>
					<p class="step"><span>3</span> Enter information regarding the food photo, name, serving size, description)</p>
				</div>
			</div>
			<div class="row">				
				<div class="col-md-4">
					<img src="img/archive-4.PNG" class="docuImg"/>
					<p class="step"><span>4</span> Review list before submission. You can also remove the entry you wish to remove.</p>
				</div>
			</div>
		</div>
	</div>
	<div id="archive">
		<div class="container archive">
			<div class="row">
				<h1>#archive</h1>
				<p class="headingDesc">Archive page displays the number of entries in a calendar view. You an also add entries using the calendar. Just follow the steps below.</p>
				<div class="col-md-4 col-sm-6">
					<img src="img/calendar.PNG" class="docuImg"/>
					<p class="step"><span>1</span> Click on the date to view entries or to add new entry.</p>
				</div>
				<div class="col-md-4 col-sm-6">
					<img src="img/calendar-1.PNG" class="docuImg"/>
					<p class="step"><span>2</span> You can view entry for the selected date or add new entry.</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>