<?php
include 'partDesign/header.php';
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
	include 'partDesign/not_found.php';
	exit;
}
$userId = $_GET['id'];
deleteUser($userId);

header(string: "Location: index.php");
