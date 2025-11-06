<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = 'Tungtung05@';
$dbname  = 'quangxuong_db';
$port = 3307 ;

$mysqli = new mysqli($host, $user, $pass, $dbname ,$port);
if ($mysqli->connect_error) {
    die('Kết nối DB thất bại: ' . $mysqli->connect_error);
}
?>
