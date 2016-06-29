<?php

// Name Validation
// Allowed: letters, numbers, space and period
function nameVal($name) {
	if (!preg_match('/^[a-zA-Z0-9 .]+$/', $name)) {
		return $name.' is not a valid name';
	/*} else {
		return $name.' OK';*/
	}
}

// Phone Validation
// Allowed: numbers (0-9), space (' '), parenthesis (( or )), plus sign (+) at start
function phoneVal($phone) {
	if (!preg_match('/^[+]?[0-9 ()-]+$/', $phone)) {
		return $phone.' is not a valid phone number';
	/*} else {
		return $phone.' OK';*/
	}
}

// Email Validation
function emailVal($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return $email.' is not a valid email address';
	/*} else {
		return $email.' OK';*/
	}
}

// Insert Data to Database
function insertData($name, $description, $phone, $email) {
	try {
		$conn = connect_db();
		$stmt = $conn->prepare('INSERT INTO users2(name, description, phone, email)
			VALUES (:name, :description, :phone, :email)');
		$stmt->execute(array(
				':name'=>$name,
				':description'=>$description,
				':phone'=>$phone,
				':email'=>$email
			));
		return '<label class="alert">Data SAVED.</label>';
	} catch(Exception $e) {
		return '<label class="error">Data NOT saved.</label><br><p>'.$e->getMessage().'</p>';
	}
}

// Select Data from Database
function getData() {
	try {
		$conn = connect_db();
		$stmt = $conn->prepare("SELECT * FROM users2");
		$stmt->execute();
		foreach ($stmt as $users) {
			echo '<li>'.$users->id.' | '.$users->name.' | '.$users->description.' | '.$users->phone.' | '.$users->email.'</li>';
		}
	} catch(Exception $e) {
		return '<br><p>'.$e->getMessage().'</p>';
	}
}
?>