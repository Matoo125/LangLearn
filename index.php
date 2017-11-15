<?php
header('Access-Control-Allow-Origin: http://localhost:8080'); 
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
session_start();
header("Cache-Control: no-cache");
header("Pragma: no-cache");

require_once 'backend/bootstrap.php';

$b = new m4\wordMaster\Bootstrap();
