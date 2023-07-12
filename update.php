<?php
include 'partDesign/header.php';
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
	include 'partDesign/not_found.php';
	exit;
}
$userId = $_GET['id'];

$user = getUserById($userId);
if (!$user) {
	include 'partDesign/not_found.php';
	exit;
}

$errors = [
	'name' => "",
	'username' => "",
	'email' => "",
	'phone' => "",
	'website' => "",
];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$user = array_megre($user, $_POST);

	$isValid = validateUser($user, $errors);

	if ($isValid) {
		$user = updateUser($_POST, $userId);
		uploadImage($_FILES['picture'], $user);
		header(string: "Location: index.php");
	}	
}

?>
<?php include '_form.php' ?>