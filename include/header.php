<?php 
	$currentPage = $db->checkuri($_SERVER['REQUEST_URI']);
?>
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
						<li <?= $db->isActive($currentPage,['archive.php'], 'web'); ?> ><a href="archive.php"><span class="fa fa-calendar-o"></span>archive</a></li>
						<li <?= $db->isActive($currentPage,['add-entry.php','circumplex.php','food-detail.php'],'web'); ?> ><a href="add-entry.php"><span class="fa fa-plus-square-o"></span>add entry</a></li>	
						<li <?= $db->isActive($currentPage,['dashboard.php'],'web'); ?> ><a href="dashboard.php"><span class="fa fa-dashboard"></span>dashboard</a></li>
						<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span>steps</a></li>
						<li  class="userNav"><a href="#" ><span class="fa fa-user"></span> Hello, <span id="topName"><?= $_SESSION['name'] ?></span></a>
                        <div class="dropdown-content">
					    	<a href="setting.php" <?= $db->isActive($currentPage,['setting.php'],'web'); ?> ><span class="fa fa-gear"></span>settings</a>
					    	<a href="database/logout.php"><span class="fa fa-power-off"></span>logout</a>
					  	</div>
						</li>
					</ul>	
				</div>
				<div>
					<a href="javascript:void(0);" onclick="myFunction();" class="icon">&#9776;</a>
                    <ul  id="mobile"  class="displayNone">
                        <li <?= $db->isActive($currentPage,['archive.php'],'mobile'); ?> ><a href="archive.php"><span class="fa fa-calendar-o"></span> archive</a></li>
                        <li <?= $db->isActive($currentPage,['add-entry.php','circumplex.php','food-detail.php'],'mobile'); ?> ><a href="add-entry.php"><span class="fa fa-plus-square-o"></span> add entry</a>  </li>   
                        <li <?= $db->isActive($currentPage,['dashboard.php'],'mobile'); ?> ><a href="dashboard.php"><span class="fa fa-dashboard"></span> dashboard</a></li>
						<li><a href="documentation.php" target="_blank"><span class="fa fa-list-ol"></span> steps</a></li>
                        <li <?= $db->isActive($currentPage,['setting.php'],'mobile'); ?> ><a href="setting.php"><span class="fa fa-gear"></span> settings</a></li>
                        <li><a href="database/logout.php"><span class="fa fa-power-off"></span> <?= $_SESSION['name'] ?>, logout
	                      </a>
                        </li>
                    </ul>   
                </div>
			</div>
		</div>
	</div>
</header>