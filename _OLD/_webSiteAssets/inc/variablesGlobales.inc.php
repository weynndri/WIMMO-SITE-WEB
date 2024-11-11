<?php 
	// session_start();
	
	if (isset($_SESSION["WSITE"]["PARAM"])) {
		
		$_W_CONTACT_ENTREPRISE 			= $_W_PARAM->contact_entreprise;
		$_W_SIEGE_SOCIAL_ENTREPRISE		= $_W_PARAM->adresse_entreprise;

	}

	define("EMAIL_HOST", "smtp.hostinger.fr");
	define("EMAIL_PORT", "587");
	define("EMAIL_SMTPDebug", 0);//2
	define("EMAIL_USERNAME", "info@wimmo-ci.com");
	define("EMAIL_PASSWORD", "@Wenceslas95");
	define("EMAIL_SENDER", "info@wimmo-ci.com");

 ?>