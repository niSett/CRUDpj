<?php
include 'partDesign/header.php';
require __DIR__ . '/users/users.php';



$user = [
	'name' => '',
	'username' => '',
	'email' => '',
	'phone' => '',
	'website' => '',
];

$errors = [
	'name' => "",
	'username' => "",
	'email' => "",
	'phone' => "",
	'website' => "",
];

$isValid = true;

if ($_SERVER['REQUIRE_METHOD'] === 'POST') {

	$user = array_merge($user, $_POST);

	$isValid = validateUser($user, $errors);

	if ($isValid) {
		$user = createUser($_POST);

		uploadImage($_FILES['picture'], $user);
	
		header(string: "Location: index.php");
	}
}

?>
<?php include '_form.php' ?>