<?php
   	include('database/Function.php');
    $db = new Database;
    $db->isLogin();
    if(!isset($_SESSION['detail']['mealType'])){
    	echo "<script>alert('Oops! Please select meal type first!')</script>";
    	echo "<script>window.location.href='add-entry.php'</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Entry - How do you feel?</title>
	<?php include ('include/links.php'); ?>
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
							<li><a href="archive.php"><span class="fa fa-calendar-o"></span>archive</a></li>
							<li class="navActive"><a href="add-entry.php"><span class="fa fa-plus-square-o"></span>add entry</a></li>	
							<li><a href="dashboard.php"><span class="fa fa-dashboard"></span>dashboard</a></li>
							<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span>steps</a></li>
							<li  class="userNav"><a href="#"><span class="fa fa-user"></span> Hello, <?= $_SESSION['name'] ?></a>
                            <div class="dropdown-content">
						    	<a href="setting.php"><span class="fa fa-gear"></span>Settings</a>
						    	<a href="database/logout.php"><span class="fa fa-power-off"></span>Logout</a>
						  	</div>
							</li>
						</ul>	
					</div>
					<div>
						<a href="javascript:void(0);" onclick="myFunction();" class="icon">&#9776;</a>
                        <ul  id="mobile"  class="displayNone">
                            <li><a href="archive.php"><span class="fa fa-calendar-o"></span> archive</a></li>
                            <li  class="mobile-navActive"><a href="add-entry.php"><span class="fa fa-plus-square-o"></span> add entry</a>  </li>   
                            <li><a href="dashboard.php"><span class="fa fa-dashboard"></span> dashboard</a></li>
							<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span> steps</a></li>
                            <li><a href="setting.php"><span class="fa fa-gear"></span> setting</a></li>
                            <li><a href="database/logout.php"><span class="fa fa-power-off"></span> <?= $_SESSION['name'] ?>, logout</a>
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
					<a href="add-entry.php"  class="breadcrumb-link"><span class="fa fa-plus-square-o"></span> add entry</a>
					<a href="#"  class="breadcrumb-link  breadcrumb-link-active">STEP 1</a>
					<a href="#" id="help-circumplex" data-toggle="modal" title="Click for further info" data-target="#myModal"><span class="fa fa-question-circle"></span></a>
				</div>
			</div>
		</div>
	</section>
	<div class="mainCircumplex">
		<section id="circumplexHeader">
			<div class="container circumplexHeader">
				<div class="row">
					<div class="col-md-12">
						<h2 class="circumplexHeading">How do you feel?</h2>
						<div>
							<p class="circumplexHeading--helper">* Click on the angle you feel today </p>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="circumplexBody">
			<div class="container">
				<div class="row circumplexBody">
					<div class="col-md-7 ">
						<div class="circumplexModel" id="circumplexModel">			
							<div class="label top">Pumped</div>
							<div class="label left">Negative</div>
							<div class="label right">Positive</div>
							<div class="label bottom">Relaxed</div>
							<div id="marker" id="marker" class="marker"></div>
						</div>
					</div>
					<div class="col-md-5">
						<a href="food-detail.php" class="circumplex--button">Next Step</a>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" id="helpCircumplexdialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Process</h4>
	      </div>
	      <div class="modal-body">
	      	<video width="100%" controls>
			  <source src="video/circumplex.mp4" type="video/mp4">
			  <source src="video/circumplex.mp4" type="video/ogg">
			  Your browser does not support HTML5 video.
			</video>
			<div class="meaning-emotion">
				<div class="emotion">
					<h1 class="emotion-header">Pleasure</h1>
					<p class="emotion-description">Pleasure describes the broad class of mental states that humans and other animals experience as positive, enjoyable, or worth seeking. It includes more specific mental states such as happiness, entertainment, enjoyment, ecstasy, and euphoria.</p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Excitement</h1>
					<p class="emotion-description">Excitement is a feeling or situation full of activity, joy, exhilaration, or upheaval. One thing about excitement — it sure isn't boring. There are a few types of excitement, but they're all exciting — they get your attention. If you can't wait for your birthday, you're feeling a happy kind of excitement.</p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Arousal</h1>
					<p class="emotion-description">Arousal is basically being alert, physically and mentally. Various body systems and hormones are involved,and contribute to alertness and readiness to move. Some signs of arousal are increased heart rate and blood pressure and quick responses. </p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Distress</h1>
					<p class="emotion-description">This term refers to the "bad" type of stress, and occurs when we have excessive adaptive demands placed upon us. This occurs when the demands upon us are so great that they lead to bodily and mental damage. Distress is damaging, excessive or pathogenic (disease producing) stress.</p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Displeasure</h1>
					<p class="emotion-description">The state of being displeased; dissatisfaction; vexation; indignant disapproval. </p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Depression</h1>
					<p class="emotion-description">Depression is a state of low mood and aversion to activity that can affect a person's thoughts, behavior, feelings, and sense of well-being.[1][2]</p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Sleepiness</h1>
					<p class="emotion-description">Sleepiness is a state of strong desire for sleep, or sleeping for unusually long periods (compare hypersomnia). </p>
				</div>
				<div class="emotion">
					<h1 class="emotion-header">Relaxation</h1>
					<p class="emotion-description">Relaxation in psychology, is the emotional state of a living being, of low tension, in which there is an absence of arousal that could come from sources such as anger, anxiety, or fear. </p>
				</div>
			</div>
	      </div>
	    </div>
	  </div>
	</div>
<script>
	$( '#circumplexModel' ).click( function(e)
        {

            var coordX = ( e.pageX - $( this ).offset().left - ( $( this ).width()  * 0.5 ) );
            var coordY = -( e.pageY - $( this ).offset().top  - ( $( this ).height() * 0.5 ) );

            var posX = (e.pageX - $(this).offset().left)/$(this).width()*100;
            var posY = (e.pageY - $(this).offset().top)/$(this).width()*100;
            
            mark = document.getElementById('marker');
          	mark.style.top = posY-4.5+ '%';
           	mark.style.left = posX-4.5 + '%';    

            var x = coordX.toFixed(1);
            var y = coordY.toFixed(1);	
            var angle = Math.atan2(y,x);
            var deg = angle * (180/Math.PI);
             function isNegative(degree){
	            return degree = 360 + degree;
            }
           	function borderColor(deg){
            	/*FIRST QUADRANT*/
            	if(deg < 0){
            		deg = isNegative(deg);
            	}
	            if(deg>=0 && deg <= 45){
	            	colorValue = ' #ecec1c';
	            }
	            if(deg>=46 && deg <= 90){
	            	colorValue =' #f38c25';
	            }
	            // /*SECOND QUADRANT*/
	            if(deg>=91 && deg <= 135){
	            	colorValue =' #e10823';
	            }
	            if(deg>=136 && deg <= 180){
	            	colorValue =' #d57193';
	            }
	            // /*THIRD QUADRANT*/
	            if(deg >= 181 && deg <= 224 ){
	            	colorValue =' #63519d';
	            }
	            if(deg >= 225  && deg <= 269){
	            	colorValue =' #5970b3';
	            }
	            // /*FOURTH QUADRANT*/
	            if(deg >=270 && deg <= 314){
	            	colorValue =' #138047';
	            }
	            if(deg >= 315 && deg <= 360){
	            	colorValue =' #85c435';
	            }
	            return colorValue;
            }

            borderColor = borderColor(deg);
           	mark.style.border = '10px dotted '+ borderColor;
            function degEmotion(deg){
            	/*FIRST QUADRANT*/
	            if(deg>=0 && deg <= 45){
	            	emotionId = '1';
	            }
	            if(deg>=46 && deg <= 90){
	            	emotionId = '2';
	            }
	            // /*SECOND QUADRANT*/
	            if(deg>=91 && deg <= 135){	            	
	            	emotionId = '3';
	            }
	            if(deg>=136 && deg <= 180){	            	
	            	emotionId = '4';
	            }
	            // /*THIRD QUADRANT*/
	            if(deg >= 181 && deg <= 224 ){
	            	emotionId = '5';
	            }
	            if(deg >= 225  && deg <= 269){
	            	emotionId = '6';
	            }
	            // /*FOURTH QUADRANT*/
	            if(deg >=270 && deg <= 314){
	            	emotionId = '7';
	            }
	            if(deg >= 315 && deg <= 360){
	            	emotionId = '8';
	            }
	            /*
				posX
				posY
				deg
				emotionId
	        	*/
	        	$.ajax({
					type: 'GET',
					url: 'database/script-meal-1.php?posX='+Math.round(posX)+'&posY='+Math.round(posY)+'&deg='+Math.round(deg)+'&emotionId='+emotionId
				});
            }


            function isNegative(degree){
	            return degree = 360 + degree;
            }

            function emotionName(degree){         
            	//check if negative -> convert to positive
            	if(degree < 0){
            		degree = isNegative(degree);
            	}
            	degEmotion(degree);
            }
            emotionName(Math.round(deg));
        });
</script>
</body>
</html>