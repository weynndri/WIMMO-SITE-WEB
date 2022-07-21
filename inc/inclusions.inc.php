<?php 

  // ==== ON TESTE SI LE PATH EST VALABLE | permet d'excuter le bon path en fonction de l'emplacement du fichier
  $pathBase = "";
  if (is_dir("inc/")) {//=== exemple de repertoire : à la racine
    $pathBase = "";
  } else if(is_dir("../inc/")) {//=== exemple de repertoire : process/ , API/ , ...
    $pathBase = "../";
  } else if(is_dir("../../inc/")) {//=== exemple de repertoire : process/facture/ 
    $pathBase = "../../";
  }else if (is_dir("../../../inc/")) {
    $pathBase = "../../../";
  }else{
    // ===== CHEMIN POUR EXECUTION EN LIGNE DE COMMANDE --> TACHES CRON


    if (is_dir("../../../../".$pathString."inc/")) {
        echo "==>inclusions de fichiers reussie 1\n";
        $pathBase = "../../../../".$pathString;
    }else if (is_dir("../../../../../".$pathString."inc/")) {
        echo "==>inclusions de fichiers reussie 2\n";
        $pathBase = "../../../../../".$pathString;
    }else{

        echo "ERROR ::::: BASE PATH --- IS NOT CORRECT FOR  =====> ".getcwd();
        return false;
    }
  }
  
  require_once $pathBase.'inc/bd.inc.php';
  require_once $pathBase.'inc/fonctionsPredefinies.inc.php';
  require_once $pathBase.'inc/fonctionsGlobales.inc.php';

  require_once $pathBase.'inc/variablesGlobales.inc.php';
  
 ?>