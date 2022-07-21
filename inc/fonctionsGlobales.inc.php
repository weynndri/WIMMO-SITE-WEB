<?php 


function W_ADD_USER($pdoApp,
					$login_user,
					$pwd_user,
					$mobile_user,
					$email_user,
					$id_userGroupe=1,
					$nomComplet_user='WIMMO - DEMO'
				){
	$query = $pdoApp->prepare("
			INSERT INTO t_user(
						id_userGroupe,
						nomComplet_user,
						login_user,
						pwd_user,
						mobile_user,
						email_user)
			VALUES(
				:id_userGroupe,
				:nomComplet_user,
				:login_user,
				:pwd_user,
				:mobile_user,
				:email_user)
		");
	$query->bindParam("id_userGroupe",$id_userGroupe);
	$query->bindParam("nomComplet_user",$nomComplet_user);
	$query->bindParam("login_user",$login_user);
	$query->bindParam("pwd_user",$pwd_user);
	$query->bindParam("mobile_user",$mobile_user);
	$query->bindParam("email_user",$email_user);
	$query->execute();
	
	return $query;
}

function W_UPDATE_USER($pdoApp,
					$login_user,
					$pwd_user,
					$mobile_user,
					$email_user,
					$id_userGroupe=1,
					$nomComplet_user='WIMMO - DEMO',
					$etat_user=1
				){
	$query = $pdoApp->prepare("
			UPDATE t_user
			SET
				id_userGroupe 	= :id_userGroupe,
				nomComplet_user = :nomComplet_user,
				login_user 		= :login_user,
				pwd_user 		= :pwd_user,
				mobile_user 	= :mobile_user,
				etat_user 		= :etat_user
			WHERE 
					email_user 		= :email_user
		");
	$query->bindParam("id_userGroupe",$id_userGroupe);
	$query->bindParam("nomComplet_user",$nomComplet_user);
	$query->bindParam("login_user",$login_user);
	$query->bindParam("pwd_user",$pwd_user);
	$query->bindParam("mobile_user",$mobile_user);
	$query->bindParam("email_user",$email_user);
	$query->bindParam("etat_user",$etat_user);
	$query->execute();
	
	return $query;
}


 ?>