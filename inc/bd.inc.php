<?php 


	// ================================		
	// ================================		
	// ================================		BD CONNEXION - WEB SITE
	// ================================		
	// ================================		

	try {

		// $host = "localhost";
		// $bd_name = "u442772263_bd_wimmo_site";
		// $user = "u442772263_wimmo_site";
		// $password = "qAd3w>JiAa!5";

		$host = "localhost";
		$bd_name = "bd_wimmo_site"; 
		$user = "root";
		$password = "";
	 
		// Options de connection
		$options = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8",
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		  );

		$pdo = new PDO('mysql:host='.$host.';dbname='.$bd_name, $user, $password, $options );


	} catch (PDOException $e) {
	    echo 'Connexion impossible WIMMO WEBSITE : ' . $e->getMessage();
	    die();
	}

	// ================================		
	// ================================		
	// ================================		BD CONNEXION - APP
	// ================================		
	// ================================		

	try {

		$host2 = "localhost";
		$bd_name2 = "u442772263_bd_wimmo";
		$user2 = "u442772263_wimmo_app";
		$password2 = "qAd3w>JiAa!5";

		$host2 = "localhost";
		$bd_name2 = "bd_wimmo"; 
		$user2 = "root";
		$password2 = "";
	 
		// Options de connection
		$options2 = array(
		    PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8",
		    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		  );

		$pdoApp = new PDO('mysql:host='.$host2.';dbname='.$bd_name2, $user2, $password2, $options2 );


	} catch (PDOException $e) {
	    echo 'Connexion impossible WIMMO APP : ' . $e->getMessage();
	    die();
	}

 ?>