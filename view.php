<?php
include 'partDesign/header.php';
require __DIR__ . '/users/users.php '

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

?>

<div class="container">
	<div class="card">
		<div class="card-header">
			<h3>View User: <b><?php echo $user['name'] ?></b></h3>
		</div>
		<div class="card-body"> 
			<a class="btn btn-secondary" href="update.php?id=<?php echo $user['id'] ?>"></a>
			<a class="btn btn-danger" href="delete.php?id=<?php echo $user['id'] ?>"></a>
		</div>
		<table class="table">
			<tbody>
			<tr>
				<th>Name:</th>
				<td><?php echo $user['name'] ?></td>
			</tr>
			<tr>
				<th>Username:</th>
				<td><?php echo $user['username'] ?></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><?php echo $user['email'] ?></td>
			</tr>
			<tr>
				<th>Phone:</th>
				<td><?php echo $user['phone'] ?></td>
			</tr>
			<tr>
				<th>Website:</th>
				<td><?php echo $user['website'] ?></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>


<?php include 'partDesign/footer.php'; ?>