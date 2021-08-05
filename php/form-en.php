<?php
	/*error_reporting(-1);
	ini_set('display_errors', 'On');*/
	
	ini_set('sendmail_path', '/usr/sbin/sendmail-wrapper-php -t -i -F"ResilEyes" -f\'no-reply@resileyes.com\'');


	$success = false;
	
	if(isset($_POST['contact-form'])) {
		if (empty($_POST['last-name']) || empty($_POST['first-name']) || empty($_POST['email']) || empty($_POST['situation']) || empty($_POST['message']) || empty($_POST['captcha-token']) ) {
			// If not all required elements
			$success = false;
		}	
		else {
			$lastName = htmlspecialchars($_POST['last-name']);
			$firstName = htmlspecialchars($_POST['first-name']);
			$email = htmlspecialchars($_POST['email']);
			$situation = htmlspecialchars($_POST['situation']);
			$message = htmlspecialchars($_POST['message']) ;
			if (isset($_POST['subscribe'])){
				$subscribe = true;
			}
			else {
				$subscribe = false;
			}
			
			// Asking to google if captcha is ok
			$base_url = "https://www.google.com/recaptcha/api/siteverify";
			$site_key = "6LfgBd8bAAAAAHrX98EmFDcJyy_QmDe2DzQppmlU";
			$token = $_POST['captcha-token'];
			
			$url = "$base_url?secret=$site_key&response=$token";
			
			$response = file_get_contents($url);
			$result = json_decode($response, true);
			
			
			$dest = "bastien.labouche@resileyes.com";
			$from = "no-reply@resileyes.com";
			$subject = "[contact] $firstName $lastName - $email";
			
			
			$headers = array(
				'From' => $from,
				'X-Mailer' => 'PHP/' . phpversion()
			);
			$message = "Nom de famille : $lastName \nPrenom : $firstName \nEmail : $email \nSituation : $situation \n\n\n$message";
			
			
			// If Google says ok or not
			if ($result["success"] == 1) {
				$success = true;
				
				$result_mail = mail($dest, $subject, $message, $headers);
				
				if ($result_mail == true){
					$success = true;
				} else {
					$success = false;
				}
			} else {
				$success = false;
			}
		}
	}
	header('location: /pages/site-en/contact-page.php?success=2');
	if ($success == true){
		header('location: /pages/site-en/contact-page.php?success=1');
	} else {
		header('location: /pages/site-en/contact-page.php?success=0');
	}
?>

