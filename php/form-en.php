<?php
  if(isset($_POST['contact-form'])) {
    if (empty($_POST['last-name']) || empty($_POST['first-name']) || empty($_POST['email']) || empty($_POST['situation']) || empty($_POST['message'])) {
      header('location: /pages/site-en/contact-page.php?success=0');      
		}

    else {
      $lastName = htmlspecialchars($_POST['last-name']);
      $fistName = htmlspecialchars($_POST['first-name']);
      $email = htmlspecialchars($_POST['email']);
      $situation = htmlspecialchars($_POST['situation']);
      $message = htmlspecialchars($_POST['message']) ;
      header('location: /pages/site-en/contact-page.php?success=1');     
    } 
  }
?>
