<!DOCTYPE html>
<html>
<head>
	<title>Project Simulation</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<?php
		include('db.php');
		include('functions.php');

		$namemsg = $phonemsg = $emailmsg = $submitmsg = '';
		$name = $description = $phone = $email = '';

		// print_r($_POST).'<br>';
		if (isset($_POST['name']) && isset($_POST['description']) 
			&& isset($_POST['phone']) && isset($_POST['email'])) {

			$name = $_POST['name'];
			$description = $_POST['description'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];

			// Validations
			$namemsg = nameVal($name);
			$phonemsg = phoneVal($phone);
			$emailmsg = emailVal($email);

			// Get numbers only
			$phone = preg_replace('/[^0-9]/','',$phone);

			// Insert to DB
			if ($namemsg == '' && $phonemsg == '' && $emailmsg == '') {
				$submitmsg = insertData($name, $description, $phone, $email);
			} else {
				$submitmsg = '<label class="error">Data NOT saved.</label>';
			}
		}
		$_POST = array();
		// print_r($_POST);
	?>
	<div class='header'></div>
	<div class="wrapper">
		<div class="container">
			<form method="POST" action="">
				<h1>User Information</h1>
				<label>Name: </label>
				<input type="text" name="name" required>
				<br><label class="error"><?php echo ($namemsg); ?></label>
				<br>
				<label>Description:</label>
				<textarea  row="10" name="description" required></textarea>
				<br>
				<label>Phone Number:</label>
				<input type="text" name="phone" required>
				<br><label class="error"><?php echo ($phonemsg); ?></label>
				<br>
				<label>Email:</label>
				<input type="text" name="email" required>
				<br><label class="error"><?php echo ($emailmsg); ?></label>
				<br>
				<input type="submit" value="Submit"><?php echo ($submitmsg); ?>
			</form>
			<hr><br>
			<h2>List of User Information: </h2>
			<h4> ID | Name | Description | Phone Number | Email </h4>
			<ul>
				<?php
					getData();
				?>
			</ul>
			<br><br>
		</div>
	</div>
	<div class='footer'></div>

</body>
</html>