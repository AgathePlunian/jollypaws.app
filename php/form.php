<?php
	$success = false;
	
	if(isset($_POST['contact-form'])) {
		if (empty($_POST['last-name']) || empty($_POST['first-name']) || empty($_POST['email']) || empty($_POST['situation']) || empty($_POST['message']) || empty($_POST['captcha-token']) ) {
			// If not all required elements
			$success = false;
		}	
		else {
			$lastName = htmlspecialchars($_POST['last-name']);
			$fistName = htmlspecialchars($_POST['first-name']);
			$email = htmlspecialchars($_POST['email']);
			$situation = htmlspecialchars($_POST['situation']);
			$message = htmlspecialchars($_POST['message']) ;
			if (!isset($_POST['subscribe'])){
				$subscribe = false;
			}
			else {
				$subscribe = true;
			}
			
			// Asking to google if captcha is ok
			$base_url = "https://www.google.com/recaptcha/api/siteverify";
			$site_key = "6LfgBd8bAAAAAHrX98EmFDcJyy_QmDe2DzQppmlU";
			$token = $_POST['captcha-token'];
			
			$url = "$base_url?secret=$site_key&response=$token";
			
			$response = file_get_contents($url);
			$result = json_decode($response, true);
			
			// If Google says ok or not
			if ($result["success"] == 1) {
				$success = true;
			} else {
				$success = false;
			}     
		} 
	}
	if ($success == true){
		header('location: /pages/page-contact.php?success=1');
	} else {
		header('location: /pages/page-contact.php?success=0');
	}
?>
