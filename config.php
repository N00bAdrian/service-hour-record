<?php
session_start();
require_once(vendor/autoload.php);
$gClient = new Google_Client();
$gClient->setClientId('771987548170-o27q472127q41uojch6ldi0e9rlrq5gv.apps.googleusercontent.com');
$gClient->setClientSecret('m3y1DnTvd_2QP5eOaDslqvX8');
$gClient->setApplicationName('Service Hour Input');
$gClient->setRedirectUri('http://localhost/service_hour')
$gClient->addScope()
?>