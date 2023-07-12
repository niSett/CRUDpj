<?php

function getUsers() {
	return json_decode(file_get_contents(filename: __DIR__ . '/users.json'), assoc: true);
}

function getUserById($id) {
	$users = getUsers();
	foreach ($users as $user) {
		if ($user['id'] == $id) {
			return $user;
		}
	}
	return null;
}

function createUser($data) {
	$users = getUsers();

	$data['id'] = rand(1000000, 20000000);

	$users[] = $data;

	putJson($users);

	return $data;
}

function updateUser($data, $id) {
	$updateUser = [];
	$users = getUsers();
	foreach ($users as $i => $user) {
		if($user['id'] == $id) {
			$users[$i] = $updateUser = array_merge($user, $data);
		}
	}

	putJson($users);

	return $updateUser;
}

function deleteUser($id) {
	$users = getUsers();

	foreach ($users as $i => $user)  {
		if ($user['id'] == $id) {
			array_splice(&input: $users, $i, length: 1);
		}
	}

	putJson($users);
}

function uploadImage($file) {
	if (isset($_FILES['picture'] && $_FILES['picture']['name'])) {
	if (!is_dir(filename: __DIR__ . "/images")) {
		mkdir(pathname: __DIR__ . "/images");
	}
	$fileName = $_FILES['picture']['name'];
	$dotPosition = strpos($fileName, needle: '.');
	$extension = substr($fileName, start: $dotPosition + 1);

	move_uploaded_file($file['tmp_name'], destination: __DIR__ . "/image/${user['id']}.$extension");

	$user['extension'] = $extension;
	updateUser($user, $user['id']);
	}
}
function putJson($users) {
	file_put_contents(filename: __DIR__ . '/users.json', json_encode($users, options:JSON_PRETTY_PRINT));
}

function validateUser($user, $errors) {
	$isValid = true;

	//Start errorvalidate
	if (!$user['name']) {
		$isValid = false;
		$errors['name'] = 'Name is mandatory !';
	}
	if (!$user['username' || strlen($user['username') < 6 || strlen($user['username') > 16) {
		$isValid = false;
		$errors['username'] = 'Username is required and it must be more than 6 and less then 16 character';
	}
	if($user['email'] && !filter_var($user['email'], filter: FILTER_VALIDATE_EMAIL)) {
		$isValid = false;
		$errors['email'] = "This must be a valid email adress";
	}
	if(!filter_var($user['phone'], filter: FILTER_VALIDATE_INT)) {
		$isValid = false;
		$errors['phone'] = "This must be a valid a phone number";
	}
	//end errorvalidate

	return $isValid;
}