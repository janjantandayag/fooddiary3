<?php
   	include('database/Function.php');
   	$_SESSION['detail'] = [];
    $db = new Database;
    $db->isLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Archive</title>
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
					<a href="archive.php"  class="breadcrumb-link  breadcrumb-link-active"><span class="fa fa-calendar-o"></span> archive</a> 
          <a href="#" id="help-circumplex" data-toggle="modal" title="Click for further info" data-target="#myModal"><span class="fa fa-question-circle"></span></a>
				</div>
			</div>
		</div>
	</section>
	<section id="archive-body">
		<div class="container">
			<div class="row archive-bodyContainer">
				<div class="calendarHeader">					
					<p class="circumplexHeading--helper" style="margin-left:15px"><span style="color:red;font-weight: bold;font-style:normal;font-family: semiBold">NOTE:</span> Just click on the date to add/view entry</p>                    
				</div>
				<div class="col-md-12">
					<div id="calendar"></div>
				</div>
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
            <source src="video/archive.mp4" type="video/mp4">
            <source src="video/archive.mp4" type="video/ogg">
            Your browser does not support HTML5 video.
          </video>
        </div>
      </div>
    </div>
  </div>
	   <!-- jQuery 2.1.4 -->
    <script src="calendar/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="calendar/moment.min.js"></script>
    <script src="calendar/fullcalendar/fullcalendar.min.js"></script>
    <script>
        /* initialize the calendar*/
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          //Random default events
          selectable:true,
          dayClick: function( date, jsEvent, view) {
		    if (moment().format('YYYY-MM-DD') === date.format('YYYY-MM-DD') || date.isBefore(moment())) {
		        window.location.href= 'add-entry.php?date='+ date.format();
		    } else {
		        alert('Oops! Future date!');
		    }
		},
    	events: [
	    <?php
	    	foreach($db->getDates() as $date): 
        ?>
            {
              title: '<?= $db->getCountDates($date['entryDate']); ?>',
              start: '<?= date('Y',strtotime($date['entryDate'])) ?>,<?= date('m',strtotime($date['entryDate'])) ?>,<?= date('d',strtotime($date['entryDate'])) ?>',
              backgroundColor: "#eeb10c", //red
              borderColor: "#eeb10c", //red
              url: 'add-entry.php?date=<?= $date['entryDate']; ?>'
            },

        <?php endforeach; ?>
          ],
          editable: false,
          droppable: true, // this allows things to be dropped onto the calendar !!!
          drop: function (date, allDay) { // this function is called when something is dropped

            // retrieve the dropped element's stored Event Object
            var originalEventObject = $(this).data('eventObject');

            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);

            // assign it the date that was reported
            copiedEventObject.start = date;
            copiedEventObject.allDay = allDay;
            copiedEventObject.backgroundColor = $(this).css("background-color");
            copiedEventObject.borderColor = $(this).css("border-color");

            // render the event on the calendar
            // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
              // if so, remove the element from the "Draggable Events" list
              $(this).remove();
            }

          }
        });

    </script>
</body>
</html>