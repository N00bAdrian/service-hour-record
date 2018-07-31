<?php
function dbconnect(){
	DEFINE('DB_USER', 'chpc');
	DEFINE('DB_PASSWORD', 'chpccommittee');
	DEFINE('DB_HOST', 'localhost');
	DEFINE('DB_NAME', 'servicehour');
	$db = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$db->query("SET NAMES 'utf8mb4");
	$db->query("SET CHARACTER_SET_CLIENT=utf8mb4");
	$db->query("SET CHARACTER_SET_RESULTS=utf8mb4");
	return $db;
}
$db = dbconnect();

function submit(){
	global $db;

  	$app = $_REQUEST["applicant"];
	$day=$_REQUEST["date"];
	$hours = $_REQUEST["hours"];
	$sid = $_REQUEST["docent"];

	echo $day;

	//echo (string)$app."\n";
	//echo (int)$hours."\n";
	//echo (int)$sid;

	$sql = $db->prepare("INSERT INTO record (applicant, day, hours, sid) VALUES (?,?,?,?)");
	$sql->bind_param("ssdd", $app, $day, $hours, $sid);
	$sql->execute();
	$sql->close();
}

function clear(){
	global $db;

	$rid = $_REQUEST["rid"];

	echo $rid;

	$sql = $db->prepare("DELETE FROM record WHERE rid=?");
	$sql->bind_param("i",$rid);
	$sql->execute();
	$sql->close();
}

function exportall(){
	global $db;

	$stmt=$db->prepare("SELECT namelist.sid, class, no, ename, applicant, hours FROM namelist, record WHERE namelist.sid=record.sid ORDER BY rid DESC");
	$stmt->execute();
	$stmt->bind_result($sid,$class,$no,$ename,$applicant,$hours);

	$csv="sid,class,no,ename,applicant,hours\n";

	while($stmt->fetch()){
		$csv.=$sid.",".$class.",".$no.",".$ename.",".$applicant.",".$hours."\n";
	}

	$csv = chr(239).chr(187).chr(191).mb_convert_encoding($csv, "UTF-8","UTF-8");

	header("Content-Disposition: attachment; filename=\"allrecords.csv\"");

	echo $csv;
}

function exporttotal(){
	global $db;

	$stmt=$db->prepare("SELECT record.sid, class, no, ename, thours FROM namelist, (SELECT sid, SUM(hours) as thours FROM record GROUP BY sid ORDER BY thours DESC) record WHERE record.sid=namelist.sid");
	$stmt->execute();
	$stmt->bind_result($sid, $class, $no, $ename, $hours);

	$csv="sid,class,no,ename,hours\n";

	while($stmt->fetch()){
		$csv.=$sid.",".$class.",".$no.",".$ename.",".$hours."\n";
	}

	$csv = chr(239).chr(187).chr(191).mb_convert_encoding($csv, "UTF-8","UTF-8");

	header("Content-Disposition: attachment; filename=\"totalrecords.csv\"");

	echo $csv;
}

function getsid(){
	global $db;

	$stmt = $db->prepare("SELECT sid FROM namelist");
	$stmt->execute();
	$stmt->bind_result($sid);

	$sids = [];
	while($stmt->fetch()){
		array_push($sids, strval($sid));
	}

	echo json_encode($sids);
}

function exportbronze(){
	global $db;

	$stmt=$db->prepare("SELECT record.sid, class, no, ename, thours FROM namelist, (SELECT sid, SUM(hours) as thours FROM record GROUP BY sid ORDER BY thours DESC) record WHERE record.sid=namelist.sid AND thours >=50 AND thours < 100");
	//$stmt->bind_param("s",date("Y"));
	$stmt->execute();
	$stmt->bind_result($sid, $class, $no, $ename, $hours);

	$csv="sid,class,no,ename,hours\n";

	while($stmt->fetch()){
		$csv.=$sid.",".$class.",".$no.",".$ename.",".$hours."\n";
	}

	$csv = chr(239).chr(187).chr(191).mb_convert_encoding($csv, "UTF-8","UTF-8");

	header("Content-Disposition: attachment; filename=\"bronze.csv\"");

	echo $csv;	
}

function exportsilver(){
	global $db;

	$stmt=$db->prepare("SELECT record.sid, class, no, ename, thours FROM namelist, (SELECT sid, SUM(hours) as thours FROM record GROUP BY sid ORDER BY thours DESC) record WHERE record.sid=namelist.sid AND thours >=100 AND thours < 200");
	$stmt->execute();
	$stmt->bind_result($sid, $class, $no, $ename, $hours);

	$csv="sid,class,no,ename,hours\n";

	while($stmt->fetch()){
		$csv.=$sid.",".$class.",".$no.",".$ename.",".$hours."\n";
	}

	$csv = chr(239).chr(187).chr(191).mb_convert_encoding($csv, "UTF-8","UTF-8");

	header("Content-Disposition: attachment; filename=\"silver.csv\"");

	echo $csv;
}

function exportgold(){
	global $db;
	
	$stmt=$db->prepare("SELECT record.sid, class, no, ename, thours FROM namelist, (SELECT sid, SUM(hours) as thours FROM record GROUP BY sid ORDER BY thours DESC) record WHERE record.sid=namelist.sid AND thours >=200");
	$stmt->execute();
	$stmt->bind_result($sid, $class, $no, $ename, $hours);

	$csv="sid,class,no,ename,hours\n";

	while($stmt->fetch()){
		$csv.=$sid.",".$class.",".$no.",".$ename.",".$hours."\n";
	}

	$csv = chr(239).chr(187).chr(191).mb_convert_encoding($csv, "UTF-8","UTF-8");

	header("Content-Disposition: attachment; filename=\"gold.csv\"");

	echo $csv;
}

function loginhandler(){
	global $db;

	$username = $_POST["username"];
	$password = sha1($_POST["password"]);

	$stmt = $db->prepare("SELECT uname, pw FROM users");
	$stmt->execute();
	$stmt->bind_result($uname, $pw);
	$stmt->fetch();

	if (($username == $uname) && ($password == $pw)){
		$_SESSION['login'] = "true";
		header('location: index.php');
		//echo $_SESSION['login'];
	}
	else{
		header('location: login.php');
	}
}

function checksession(){
	if(isset($_SESSION['login'])){
		echo "<script type='javascript'>alert('logged in');</script>";
	}
	else{
		header("location: login.php");
	}
}
?>
