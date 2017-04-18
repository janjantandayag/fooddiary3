<?php	
session_start();
Class Database {
	public $servername = 'localhost';
	public $dbname = 'diary3';
	public $password = '';
	public $username = 'root';
	public $conn;

	public function __construct(){
		try {
			    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
			    // set the PDO error mode to exception
			     $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    }
		catch(PDOException $e)
		    {
		    	echo "Connection failed: " . $e->getMessage();
		    }
	}
	public function isExist($username, $password){
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE users.username = :username AND users.password=md5(:password)"); 
 		$stmt->execute([$username,$password]);
 		$exist = $stmt->rowCount();
 		return $exist;
	}
	public function login($username, $password){
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE users.username = :name AND users.password=md5(:password)"); 
 		$stmt->execute([$username,$password]);
		$result = $stmt->fetch(); 			
		$_SESSION['loggedIn'] =  true;
		$_SESSION['userId'] = $result['user_id'];
		$_SESSION['name'] = $result['first_name'];
		header("location: dashboard.php");
	}
	public function signUp($firstName,$lastName,$gender,$birthDate,$username,$password){
		$stmt = $this->conn->prepare("INSERT INTO users(first_name,last_name,gender,date_of_birth,username,password) VALUES(:firstName,:lastName,:gender,:birthDate,:username,md5(:password))");
 		$stmt->execute([$firstName,$lastName,$gender,$birthDate,$username,$password]);
 		$id = $this->conn->lastInsertId();
		$_SESSION['loggedIn'] =  true;
		$_SESSION['userId'] = $id;
		$_SESSION['name'] = $firstName;
		header("location: ../dashboard.php");
	}
	public function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 1000; $i++) {
           $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
        return $randomString;
    }
	public function updatePassUser($username,$password){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("UPDATE users SET username =:username,password=md5(:password) WHERE user_id=$uid"); 
 		$stmt->execute([$username,$password]);
 		$_SESSION['loggedIn'] = false;
 		session_unset($_SESSION['loggedIn'], $_SESSION['userId'], $_SESSION['name']); 
		session_destroy(); 
   		$_SESSION['detail'] = [];
 		echo "<script>
			alert('Password/Username updated!');
			alert('Please login to continue!');
			window.location = './sign-in.php';
		  </script>";
	}
	public function isLogin(){
		if(isset($_SESSION['loggedIn'])){
		}
		else{
			echo "
				<script>
					alert('You are not login! Please login to continue!');
					window.location = './sign-in.php';
				</script>
			";
		}
	}
	public function indexCheckLogin(){
		if(isset($_SESSION['loggedIn'])){
			echo "<script>
				window.location.href='dashboard.php';
			</script>
			";
		}
	}
	public function getUserDetails(){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM users WHERE user_id = $uid"); 
 		$stmt->execute(); 
 		$result = $stmt->fetch();
 		return $result;
	}
	public function feedQuery($itemId){
		$id = $itemId;
		$stmt = $this->conn->prepare("SELECT * FROM meals,users,item,entries,emotions WHERE item.item_id = $id AND item.entry_id = entries.entry_id AND entries.user_id = users.user_id AND entries.emotion_id = emotions.emotion_id AND entries.meal_id = meals.meal_id"); 
 		$stmt->execute(); 
 		$result = $stmt->fetch();
 		return $result;
	}
	public function getEntries(){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE entries.user_id = $uid AND entries.entry_id = item.entry_id"); 
 		$stmt->execute(); 
 		$result = $stmt->fetchAll();
 		return $result;
	}
	public function getEntriesDate($start,$end){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE entries.user_id = $uid AND entries.entry_id = item.entry_id AND (DATE_FORMAT(date_eaten,'%Y-%m-%d')  >= '$start' AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  <= '$end')"); 
 		$stmt->execute(); 
 		$result = $stmt->fetchAll();
 		return $result;
	}
	public function countEntries($start,$end){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE entries.user_id = $uid AND entries.entry_id = item.entry_id AND (DATE_FORMAT(date_eaten,'%Y-%m-%d')  >= '$start' AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  <= '$end')"); 
 		$stmt->execute(); 
		$count = $stmt->rowCount();
 		return $count;
	}
	public function getBorderColor($eid){
		if($eid == 1){
			$border = '5px solid #ecec1c';
		}
		else if($eid == 2){	
			$border = '5px solid #f38c25';
		}
		else if($eid == 3){			
			$border = '5px solid #e10823';		
		}
		else if($eid == 4){
			$border = '5px solid #d57193';			
		}
		else if($eid == 5){
			$border = '5px solid #63519d';			
		}
		else if($eid == 6){
			$border = '5px solid #5970b3';
		}
		else if($eid == 7){
			$border = '5px solid #138047';				
		}
		else if($eid == 8){
			$border = '5px solid #85c435';			
		}
		return $border;
	}
	public function getEmotion(){
		$stmt = $this->conn->prepare("SELECT * FROM emotions"); 
 		$stmt->execute(); 
 		$result = $stmt->fetchAll();
 		return $result;
	}
	public function getBgColor($emotionId){
		if($emotionId==1){
			$color='#ecec1c';
		}
		if($emotionId==2){
			$color='#f38c25';
		}
		if($emotionId==3){
			$color='#e10823';
		}
		if($emotionId==4){
			$color='#d57193';
		}
		if($emotionId==5){
			$color='#63519d';
		}
		if($emotionId==6){
			$color='#5970b3';
		}
		if($emotionId==7){
			$color='#138047';
		}
		if($emotionId==8){
			$color='#85c435';
		}
		return $color;
	}
	public function getEmotionCount($emotionId){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND emotion_id=$emotionId AND item.entry_id = entries.entry_id");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getEmotionCountDate($emotionId,$start,$end){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND emotion_id=$emotionId AND item.entry_id = entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  >= '$start' AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  <= '$end'");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getRecentEntries(){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item,emotions WHERE user_id = $uid AND item.entry_id=entries.entry_id AND entries.emotion_id = emotions.emotion_id ORDER BY date_added DESC LIMIT 4" ); 
 		$stmt->execute(); 
 		$result = $stmt->fetchAll();
 		return $result;
	}
	public function getMealName($id){
		$stmt = $this->conn->prepare("SELECT * FROM meals WHERE meal_id=$id" ); 
 		$stmt->execute(); 
 		$result = $stmt->fetch();
 		return $result['meal_name'];
	}
	public function getMealCount($id){
		$uid = $_SESSION['userId'];
		$date = $_SESSION['throwdate'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id=$uid AND meal_id=$id AND item.entry_id=entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d') = '$date'"); 
		$stmt->execute();
		$count = $stmt->rowCount();
		return $count;
	}
	public function getCountDates($date){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id=$uid AND item.entry_id=entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d') = '$date'" ); 
		$stmt->execute();
		$preCount = $stmt->rowCount();
		if($count = 1){
			$count = $preCount.' entry';
		}
		if($count > 1){
			$count = $preCount.' entries';
		}
		return $count;
	}
	public function getMeals($id){
		$uid = $_SESSION['userId'];
		$date = $_SESSION['throwdate'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item,emotions WHERE user_id=$uid AND meal_id=$id AND entries.emotion_id = emotions.emotion_id AND item.entry_id=entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d') = '$date' ORDER BY date_eaten DESC"  ); 
 		$stmt->execute(); 
 		$result = $stmt->fetchAll();
 		return $result;
	}
	public function countTotalEntries($id){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND meal_id=$id AND item.entry_id = entries.entry_id");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function countTotalEntriesDate($id,$start,$end){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND meal_id=$id AND item.entry_id = entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  >= '$start' AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  <= '$end'");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getValueDate($eid,$mid,$start,$end){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND meal_id=$mid  AND emotion_id=$eid AND item.entry_id = entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  >= '$start' AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  <= '$end'");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getValue($eid,$mid){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND meal_id=$mid  AND emotion_id=$eid AND item.entry_id = entries.entry_id");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getTotalEntry(){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND item.entry_id = entries.entry_id");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getTotalEntryDate($start,$end){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT * FROM entries,item WHERE user_id = $uid AND item.entry_id = entries.entry_id AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  >= '$start' AND DATE_FORMAT(date_eaten,'%Y-%m-%d')  <= '$end'");
 		$stmt->execute();
		$count = $stmt->rowCount();
		if(!$count){
			$count = 0;
		}
		return $count;
	}
	public function getDates(){
		$uid = $_SESSION['userId'];
		$stmt = $this->conn->prepare("SELECT DISTINCT date(date_eaten) as entryDate FROM item,entries WHERE entries.user_id=$uid AND entries.entry_id=item.entry_id"); 
 		$stmt->execute(); 
 		$result = $stmt->fetchAll();
 		return $result;
	}	
	public function displayImage($itemId){
		$stmt = $this->conn->prepare("SELECT photo from item WHERE item_id=$itemId"); 
 		$stmt->execute(); 
 		$result = $stmt->fetch();
 		return $result['photo'];
	}
}

$db = new Database;
if(isset($_POST['signUp'])){
		$db->signUp(strtolower($_POST['firstName']),strtolower($_POST['lastName']),strtolower($_POST['gender']),strtolower($_POST['birthDate']),strtolower($_POST['username']),strtolower($_POST['password']));
	}


