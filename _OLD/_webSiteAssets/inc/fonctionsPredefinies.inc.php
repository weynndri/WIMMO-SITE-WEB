<?php 
	
    

    // function W_ENVOIE_MAIL_VIDE($_W_EMAIL_SENDER, $objet, $message_contain, $email_destinataire){
        
    //     // $header="MIME-Version: 1.0\r\n";
    //     // $header.='From:"'.$_W_EMAIL_SENDER.''."\n";
    //     // $header.='Content-Type:text/html; charset="uft-8"'."\n";
    //     // $header.='Content-Transfer-Encoding: 8bit';

    //     // $header="MIME-Version: 1.0\r\n";
    //     // $header.="From:".$_W_EMAIL_SENDER."\n";
    //     // $header.="Content-Type:text/html; charset='uft-8'\n";
    //     // $header.='Content-Transfer-Encoding: 8bit';

    //     // $message='
    //     // <html>
    //     //     <body>
    //     //         <div>'
    //     //             .$message_contain.
    //     //         '</div>
    //     //     </body>
    //     // </html>';

    //     // $statut = mail($email_destinataire, $objet, $message, $header);
        
    //     // ini_set('display_error', 1);
    //     // error_reporting(E_ALL);

    //     $from = "info@wimmo-ci.com";
    //     $to = "jackofblade19@gmail.com";
    //     $objet = "test";
    //     $message = "msg";
    //     $headers = "From:" .$from;


    //     $statut = mail($to, $objet, $message, $headers);
        
    //     return $statut;
    // }


    function W_DIFFERENCE_ENTRE_DATE($currentDate, $date2){

        // === on calcul la difference entre les dates
        $WDATE_current = strtotime($currentDate);
        $WDATE_Limite = strtotime($date2);
        $WDate_difference = ($WDATE_Limite - $WDATE_current)/60/60/24;

        // var_dump("Days since my birthday: ", $WDate_difference);

        return $WDate_difference;
    }
    
    function W_DECHIFFRAGE_CLE_LICENCE($cle){
        // === ON EXTRAIT LA DATE LIMITE SOUS LE FORMAT ANGLAIS
        
        $tabCle = explode("-", $cle);
        $getDateLimite = isset($tabCle[2]) ? intval($tabCle[2]):null; 
        if (is_int($getDateLimite)) {
            $getDateLimite = substr($getDateLimite, 0, 4)."-".substr($getDateLimite, 4, 2)."-".substr($getDateLimite, 6, 8);
        }
        return $getDateLimite;
    }


    function W_UPDATE_CONFIG_FILE_SMS_PRO($data=[], $filePath = "../config.json"){

        // === UPDATE DATA
        $defaultData = array(
            'code_client' => $data["code_compteClient"], 
            'licenceActive' => $data["licenceActive_compteClient"],
            'etat_compteClient' => $data["etat_compteClient"], 
            'messageEtat_compteClient' => $data["messageEtat_compteClient"], 
            'senderId' => $data["senderId_compteClient"], 
            'allowSms_smsCompte' => $data["allowSms_compteCLient"], 
            'balanceSms' => $data["balanceSms_compteClient"], 
            'status' => $data["status_compteClient"], 
            'derniere_synchronisation' => $data["derniereSynchronisation_compteClient"] 
        );

          

        try {

            // === CREATION DU FICHIER SI NEXISTE PAS EN MODE LECTURE ET ECRITURE
            $file = fopen($filePath, "w+" );

            // === ECRITURE DU CONTENU INITIAL
            file_put_contents($filePath, json_encode($defaultData));

            // === ON RECUPERE LA CONFIG
            $content = fgets($file, 7777);
            
            // === CLOSE
            fclose($file);



            // === INIT SMS CONFIG
            $_SESSION["WIMO"]["CONFIG"] = json_decode($content);


            $resultat = array('status' => 1, 'message' => "Opération réussie");

        } catch (Exception $e) {
            $resultat = array('status' => 0, 'message' => $e->getMessage());
        }

        return $resultat;

    }



    function W_CREAT_CONFIG_FILE($filePath = "../config.json"){
        // === PHP code to get the MAC address of Client
        $MAC = exec('getmac');
        // === Storing 'getmac' value in $MAC
        $CLIENT_MAC_ADDRESS = strtok($MAC, ' ');
          

        try {

            if (is_file($filePath)) {
                // === ON RECUPERE LA CONFIG
                $file = fopen($filePath, "r" );
                // === ON RECUPERE LA CONFIG
                $content = fgets($file, 7777);                
                // === CLOSE
                fclose($file);


            }else{//==== SI LE FICHIER DE CONFIG N'EXISTE PAS ALORS :::

                // === INITIAL DATA
                $defaultData = array(
                    'code_client' => $CLIENT_MAC_ADDRESS, 
                    'licenceActive' => "",
                    'etat_compteClient' => "2", 
                    'messageEtat_compteClient' => "Compte en attente d'activation", 
                    'senderId' => "", 
                    'allowSms_smsCompte' => "0", 
                    'balanceSms' => "0", 
                    'status' => "Vous n'ètes pas connecté !", 
                    'derniere_synchronisation' => "", 
                );

                // === CREATION DU FICHIER SI NEXISTE PAS EN MODE LLECTURE ET ECRITURE
                $file = fopen($filePath, "w+" );

                // === ECRITURE DU CONTENU INITIAL
                file_put_contents($filePath, json_encode($defaultData));

                // === ON RECUPERE LA CONFIG
                $content = fgets($file, 7777);
                
                // === CLOSE
                fclose($file);

            }


            // === INIT SMS CONFIG
            $_SESSION["WIMO"]["CONFIG"] = json_decode($content);


            $resultat = array('status' => 1, 'message' => "Opération réussie");

        } catch (Exception $e) {
            $resultat = array('status' => 0, 'message' => $e->getMessage());
        }

        return $resultat;

    }

    
    function W_SMS_PRO_SENDER(
                            $message, 
                            $contacts=[], 
                            $url,
                            $code_client){
        $reponse = array('status' => 0, 'message'=>"");// === Error
        

        $param = array(
            'message' => $message,
            'code_client' => $code_client,
            // 'senderId' => $senderId,
            // 'type' => $type,
            // 'datetime' => '2022-01-06 22:04:12',
        );


        // $recipients = array('2250748217415','2250748217415');
        $recipients = $contacts;

        $post = 'contacts=' . implode(';', $recipients);
        
        foreach ($param as $key => $val) {
            $post .= '&' . $key . '=' . rawurlencode($val);
        }
        // $url = "http://africasmshub.mondialsms.net/api/api_http.php";
        // $url = W_API_URL_BASE;
        // var_dump($post);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);//=== RESOUDRE LE PROBLE DE CERTIFICAT
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//=== RESOUDRE LE PROBLE DE CERTIFICAT
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//=== RESOUDRE LE PROBLE DE CERTIFICAT
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Connection: close"));
        $result = curl_exec($ch);
        if(curl_errno($ch)) {
            $result = "cURL ERROR: " . curl_errno($ch) . " " . curl_error($ch);
            $reponse["status"] = 0;
        } else {
            $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
            switch($returnCode) {
                case 200 :
                    $reponse["status"] = 1;
                    break;
                default :
                    $result = "HTTP ERROR: " . $returnCode;
                    $reponse["status"] = 0;
            }
        }

        curl_close($ch);
            

        // === ON CHECK BIEN LES ERREURS
        $myError = explode(":", $result);
        $codeError = $myError[0];

        // === ON CHECK SI LE TEXTE CONTIENT LE CODE ERREUR
        $pattern = '/ERROR/i';
        preg_match($pattern, $codeError, $matches, PREG_OFFSET_CAPTURE);

        if (!empty($matches)) {//=== SI ERROR
            $msgError = json_decode($result);
            $reponse["status"] = 0;
            $reponse["message"] = isset($msgError->message)? $msgError->message : $result;
            
        }else{//=== SI OK
            $msgError = json_decode($result);
            // var_dump($msgError);

            $reponse["status"] = isset($msgError->status)? $msgError->status : 1;
            $reponse["message"] = isset($msgError->message)? $msgError->message : $result;
        }

        // var_dump($result);
            
        return json_encode($reponse);
    }



    function W_GENERATEUR_DE_CODE($code=0, $prefixe=""){

        if ($code < 10) {
            $code = '0'.$code;
        }
        // if ($code < 10) {
        //     $code = '000'.$code;
        // }else if ($code >= 10 && $code < 100) {
        //     $code = '00'.$code;
        // }else if ($code >= 100 && $code < 1000) {
        //     $code = '0'.$code;
        // }
        // else if ($code >= 1000 && $code < 10000) {
        //     $code = '0'.$code;
        // }
        // else if ($code >= 10000 && $code < 100000) {
        //     $code = '0'.$code;
        // }

        return $prefixe."".$code;
    }


	function W_CHARGER_CLASSE($classe){
		// === AUTOMATISE LE CHARGEMENT DES CLASSES
		$path = 'class/'.$classe . '.class.php';
		if (is_file($path)) {//=== Racine
			require $path;
		}else if(is_file('../../'.$path)){
			require '../../'.$path;
		}else{//=== dossier /process
			require '../'.$path;
		}  
	}



    function W_UPLOAD_FICHIER_UNIQUE($nom_fichier, $W_dossier_destination = ""){

        // === SI AUCUN FICHIER N EST TROUVER
        if (!isset($_FILES) || empty($_FILES)) {
          return false;
        }

        $FILES = $_FILES[$nom_fichier];
        $ERROR = $FILES['error'];
        $NAME = $FILES['name'];
        $TMP_NAME = $FILES['tmp_name'];

        // === CHECK IF ALL IS OK
        if ($ERROR == 4 || $ERROR == 4) {
          return false;
        }

        $W_erreur = "";
        $W_info_fichier = pathinfo($NAME);//separe le nom et l'etension

        $W_fichier = time().".". $W_info_fichier["extension"];
        $W_taille_maxi = 10485760;//octet => 5Mo
        $W_taille = filesize($TMP_NAME);
        $W_extensions_autoriser = array('png', 'gif', 'jpg', 'jpeg', 'ico');
        $W_extension = strtolower($W_info_fichier["extension"]); 

        //Début des vérifications de sécurité...
        if(!in_array($W_extension, $W_extensions_autoriser)){ 
          return false;//error : extension non acceptée
        }


        if($W_erreur == ""){
          $W_fichier = strtr($W_fichier, 
              'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
              'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
          $W_fichier = uniqid().preg_replace('/([^.a-z0-9]+)/i', '-', $NAME);
          if(move_uploaded_file($TMP_NAME, $W_dossier_destination . $W_fichier)){
            return $W_fichier;//numero de reussite + nom du fichier
          }
        }

        return false;//error : impossible de deplacer le fichier
    }

    function W_UPLOAD_FICHIER_MULTIPLE($nom_fichier, $W_dossier_destination = "", $indice){

        $FILES = $_FILES[$nom_fichier];
        $ERROR = $FILES['error'];
        $NAME = $FILES['name'];
        $TMP_NAME = $FILES['tmp_name'];


        if (!isset($FILES) || $ERROR[$indice] == 4 || $ERROR[$indice] == 4) {
          return false;
        }

        $W_erreur = "";
        $W_fichier = "";
        $W_info_fichier = pathinfo($NAME[$indice]);//separe le nom et l'etension

        $W_filename = $W_info_fichier["filename"];
        $W_taille_maxi = 10485760;//octet => 5Mo
        $W_taille = filesize($TMP_NAME[$indice]);
        // $W_extensions_autoriser = array('png', 'gif', 'jpg', 'jpeg');
        $W_extension = strtolower($W_info_fichier["extension"]); 

        //Début des vérifications de sécurité...
        // if(!in_array($W_extension, $W_extensions_autoriser)){ 
        //   return false;//error : extension non acceptée
        // }

        if($W_erreur == ""){
          $W_fichier = strtr($W_filename, 
              'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
              'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
          $W_fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $W_filename).uniqid().".".$W_extension; //$NAME[$indice]);


          if(move_uploaded_file($TMP_NAME[$indice], $W_dossier_destination . $W_fichier)){
            return $W_fichier;//numero de reussite + nom du fichier
          }
        }

        return false;//error : impossible de deplacer le fichier
    }


	function W_PASSWORD_ENCRYPT($password){
		$step_1 = md5($password);
		$step_2 = sha1($step_1);
		return $step_2;
	}

	function W_RANDOM_PASSWORD(){
		$char = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
		$charLower = [];
		$tabDigit = [];
		$tabCharUpper = [];
		$tabCharLower = [];
		$stringPassword = "";

		for ($j=0; $j < count($char); $j++) { //=== Creation du tableau d'alphabet en minuscule
			$charLower[$j] = strtolower($char[$j]);
		}

		for ($i=0; $i < 2; $i++) { 
			$intRand = rand(0, 25);
			$tabDigit[$i] = rand(0, 9);
			$tabCharUpper[$i] = $char[$intRand];
			$tabCharLower[$i] = $charLower[$intRand];
		}

		for ($i=0; $i < 2; $i++) { 
			$stringPassword .= $tabDigit[$i].$tabCharUpper[$i].$tabCharLower[$i];
		}

		$finalPassword = str_shuffle($stringPassword);

		return $finalPassword;
	}
	
	function W_SET_FORMAT_MONNAIE($valeur, $taille = 3, $separateur=" "){
	    return strrev(wordwrap(strrev($valeur), $taille,$separateur,true));
	}


    function CODE_EXISTE($pdo, $table, $code_propriete, $code_value, $query=""){
        // retourne TRUE si l'ement est dejas utiliser
        $req = $pdo->prepare("
            SELECT *
            FROM {$table}
            WHERE {$code_propriete} = :code_value
            {$query}
        ");

        $req->bindParam("code_value", $code_value);
        $req->execute();

        return (($req->rowCount() > 0 ) ? true : false);

    }


    function W_MOIS(){	
    	$tab = array(
    		"1"=>"Janvier",
    		"2"=>"Février",
    		"3"=>"Mars",
    		"4"=>"Avril",
    		"5"=>"Mai",
    		"6"=>"Juin",
    		"7"=>"Juillet",
    		"8"=>"Août",
    		"9"=>"Septembre",
    		"10"=>"Octobre",
    		"11"=>"Novembre",
    		"12"=>"Décembre",
    	);

    	return $tab;
    }


    function W_CIVILITE(){  
        $tab = array(
            "M"=>"Monsieur (M.)",
            "Mme"=>"Madame (Mme)",
            "Mlle"=>"Mademoiselle (Mlle)",
            " "=>"Personne Morale",
        );

        return $tab;
    }



    function W_ANNEE(){ 

        $tablisteYear = [];
        $currentYearMin = intval(date("Y"))-10;
        $currentYearMax = intval(date("Y"));

        for ($i=0; $i < 10; $i++) { 
            array_push($tablisteYear, ($currentYearMin++));
        }

        for ($i=0; $i <= 10; $i++) { 
            array_push($tablisteYear, ($currentYearMax++));
        }

        return $tablisteYear;
    }


    function W_ANNEE_STATIC($initYearMin=2010){ 

        $tablisteYear = [];
        // $initYearMin = 2000;
        $currentYear = intval(date("Y"));

        for ($i=$initYearMin; $i <= ($currentYear+2); $i++) { 
            array_push($tablisteYear, ($initYearMin++));
        }
        
        return $tablisteYear;
    }



 ?>