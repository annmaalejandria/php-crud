<?php
	function connect_db() {
		// $conn = new PDO('mysql:host=localhost;dbname=simulation','root','');
		// var_dump($conn);
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
		return $conn;
	}
?>