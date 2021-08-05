<?php
	ini_set('sendmail_path', '/usr/sbin/sendmail-wrapper-php -t -i -F"ResilEyes" -f\'no-reply@resileyes.com\'');
	
	$headers = array(
		'From' => 'no-reply@resileyes.com',
		'Reply-To' => 'contact@resileyes.com',
		'X-Mailer' => 'PHP/' . phpversion()
	);
	$success = mail('bastien.labouche@resileyes.com','This is a test message subject','This is a test message body', $headers);
	
	if ($success) {
		echo "toto";
	} else {
		print_r(error_get_last());
	}
	
	
	//phpinfo();
?>
