<?php 
	session_start();
	header('Content-Type: application/json'); 

	use PHPMailer\PHPMailer\PHPMailer;
	require '../vendor/autoload.php';

  	
  	require_once '../inc/inclusions.inc.php';//=== CONTIENT TOUTLES FICHIERS INCLUS


	if (isset($_GET["option"])) {
		$option = $_GET["option"];
	}else if (isset($_POST["option"])) {
		$option = $_POST["option"];
	}else{
		echo "ACCES DANIED";
		return false;
	}
		
	if ($option == 1) {//=== CONNEXION
	
		// var_dump($_POST);
		// exit();
		$isOK = false;
		$status = array(
				"error"=>0,
				"errorMsg"=>"Erreur de paramètres"
				);

		if (isset($_POST["email-demandeur"]) && isset($_POST["contact-demandeur"]) && isset($_POST["objetEmail"])) {
			
			$email_demandeur = trim($_POST["email-demandeur"]);
			$mobile_demandeur = $_POST["contact-demandeur"];
			$objetEmail = trim($_POST["objetEmail"]);



			//============= VIRIFICATION DE L'EXISTANCE DU LOGIN
			$queryUserExiste = $pdo->prepare("
				SELECT *
				FROM t_demandeur
				WHERE email_demandeur = :email_demandeur
				");
			$queryUserExiste->bindParam("email_demandeur", $email_demandeur);
			$queryUserExiste->execute();
			


			if ($queryUserExiste->rowCount() >= 1) {//=== SI EXISTE
				$listeUserExiste = $queryUserExiste->fetch(PDO::FETCH_OBJ);
				$email_demandeur = $listeUserExiste->email_demandeur;
				$mobile_demandeur = $listeUserExiste->mobile_demandeur;

				try {

					$query = W_UPDATE_USER($pdoApp,
											$email_demandeur,//login
											W_PASSWORD_ENCRYPT($mobile_demandeur),//password
											$mobile_demandeur,
											$email_demandeur,
											$id_userGroupe=1,
											$nomComplet_user='WIMMO - DEMO',
											$etat_user=1);//=== On active le compte sil a ete desactiver

					if ($query) {//==== Si OK

						$status["error"] = 0;
						$status["errorMsg"] = "Votre compte a bien été mise à jour et vos accès vous ont étés retransmis par e-mail";

						$isOK = true;
					}
						
				} catch (Exception $e) {
					// var_dump($e);
					$status["error"] = 1;
					$status["errorMsg"] = "Echec : ".$e->errorInfo[2];
				}

			}else{//============= SAVE DATA + CREATION DE COMPTE
				
				try {
					
					//============= SAVE DATA
					$queryUserExiste = $pdo->prepare("
						INSERT INTO t_demandeur(email_demandeur, mobile_demandeur)
						VALUES (:email_demandeur, :mobile_demandeur)
						");
					$queryUserExiste->bindParam("email_demandeur", $email_demandeur);
					$queryUserExiste->bindParam("mobile_demandeur", $mobile_demandeur);
					$queryUserExiste->execute();
					

					if ($queryUserExiste) {
						//============= CREATION DE COMPTE
						$query = W_ADD_USER($pdoApp,
							$email_demandeur,//login
							W_PASSWORD_ENCRYPT($mobile_demandeur),//password
							$mobile_demandeur,
							$email_demandeur,
							$id_userGroupe=1,
							$nomComplet_user='WIMMO - DEMO');					



						$status["error"] = 0;
						$status["errorMsg"] = "Opération réussie !";

						$isOK = true;

					}else{

						$status["error"] = 1;
						$status["errorMsg"] = "Echec lors de la création du compte";
					}

				} catch (Exception $e) {
					
					$status["error"] = 1;
					$status["errorMsg"] = "Echec : ".$e->errorInfo[2];
				}
				
			}
						
		}else{
			$status["error"] = 1;
			$status["errorMsg"] = "Accès interdit : Erreur de paramètres";
		}



		if ($isOK) {//==== si ok on envoi le maile

			try {
				

				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = EMAIL_SMTPDebug;
				$mail->Host = EMAIL_HOST;
				$mail->Port = EMAIL_PORT;
				$mail->SMTPAuth = true;
				$mail->Username = EMAIL_USERNAME;
				$mail->Password = EMAIL_PASSWORD;
				$mail->setFrom(EMAIL_USERNAME, 'WIMMO INFO');
				$mail->addReplyTo(EMAIL_USERNAME, 'WIMMO INFO');
				$mail->addAddress($email_demandeur, '');
				$mail->Subject = $objetEmail;


				// ===== ON STOCK LES DATAS POUR LE TRANSFERT VERS LA PAGE DE EMAIL HTML
				// $_SESSION['WSITE']['login'] = $email_demandeur; 
				// $_SESSION['WSITE']['password'] = $mobile_demandeur;

				// [[==LOGIN==]]
				// [[==PASSWORD==]]

				$myEmailModel = file_get_contents('../email/accesDemo.php');
				$myEmailModel = str_replace("[[==LOGIN==]]", $email_demandeur, $myEmailModel);
				$myEmailModel = str_replace("[[==PASSWORD==]]", $mobile_demandeur, $myEmailModel);

				// $mail->msgHTML(file_get_contents($url_path, false, $stream), __DIR__);
				// $mail->msgHTML(file_get_contents('../email/accesDemo.php'), __DIR__);
				$mail->msgHTML($myEmailModel, __DIR__);

				// $mail->msgHTML(file_get_contents('message.html'), __DIR__);
				// $mail->Body = 'Ceci est le contenu du message en texte clair';
				//$mail->addAttachment('test.txt');
				// if (!$mail->send()) {
				//     echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
				// } else {
				//     echo 'Le message a été envoyé.';
				// }


				if (!$mail->send()) {

					$status["error"] = 1;
					$status["errorMsg"] = "Echec lors de l'envoi des accès, réessayez svp !";
					
				}else{
					
					$status["error"] = 0;
					$status["errorMsg"] = "Opération réussie !\nLe lien de la démo en ligne et vos accès vous ont étés envoyés par e-mail";
				}


			} catch (Exception $e) {
				
				$status["error"] = 1;
				$status["errorMsg"] = "Echec lors de l'envoi des accès, réessayez svp !\nINFO : ".$e->errorInfo[2];
			}
		}



		echo json_encode($status);


	}else if ($option == 2) {//==== DECONNEXION;
		unset($_SESSION["WA"]);
		header("Location:../?error=-2");
	}






 ?>