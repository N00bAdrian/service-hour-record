<?php
require_once("functions.php");
$username="chpccommittee";
$pw = sha1("chpccommittee");

$stmt = $db->prepare("INSERT INTO users(uname, pw) VALUES (?,?)");
$stmt->bind_param("ss", $username, $pw);
$stmt->execute();
?>