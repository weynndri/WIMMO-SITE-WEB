


function W_ENREGISTREMENT_DEMANDE(element, e) {
  // alert();
    e.preventDefault();
  let haveError = false;
  let elementID = element.attr("id");
  let allButtonInForm = $("#"+elementID+" button");
  let btSubmit = $("#"+elementID).find("button[type='submit']");
    allButtonInForm.attr("disabled", true);

  // === ON VERIFI LES CHAMPS
  $("#"+elementID+" .Wrequired, #"+elementID+" .Wnumeric").each(function () {
    let currentElement = $(this);
    if ($.trim(currentElement.val()) == "") {
      currentElement.css("border-color", "red");
      haveError = true;
    } else {
      currentElement.css("border-color", "lightgray");
    }
  });


  if (haveError) {
    alert("Echec de l'opération !");
    allButtonInForm.removeAttr("disabled");
  }else {
    
    W_LOADER_SPIN(btSubmit);

    // === ON SOUMET LE FORMULAIRE EN AJAX

    $.ajax({
      url: 'process/demandeDemo.process.php',
      type: 'POST',
      // dataType: 'html',
      data: {
        'option':1,
        'email-demandeur':$('#email-demandeur').val(),
        'contact-demandeur':$('#contact-demandeur').val(),
        'objetEmail':$('#objetEmail').val(),
      },
      dataType:'json'
    })
    .done(function(resultat) {
      console.log(resultat);
      // resultat = JSON.parse($.trim(res));
      // console.log(resultat);

      document.location.href = "https://wimmo-ci.com/_DEMO/";

      // if (resultat.error == 0) {
      //   W_LOADER_SPIN(btSubmit, "stop");
      //   alert(resultat.errorMsg);
      //   allButtonInForm.removeAttr("disabled");
        
      //   // document.location.reload();
      //   // document.location.href = "?page=bienDetails&id_biens="+resultat.id_biens;
      // }else if (resultat.status == 1) {//=== tous les locataires sont a jour
      //   alert("INFO : \n"+resultat.errorMsg);
      // }else{
      //   console.log("======>>>> Something going wrong");
      //   alert("ECHEC : \n"+resultat.errorMsg);
      //   allButtonInForm.removeAttr("disabled");
      // }

    })
    .fail(function() {
      allButtonInForm.removeAttr("disabled");
      alert("ALERTE \nEchec de l'opération : un problème est survenu lors de l'exécution");
      console.log("error");
    })
    .always(function() {
      console.log("complete");
      W_LOADER_SPIN(btSubmit, "stop");
    });

    console.log("Send");
  }

}



function W_LOADER_SPIN(target, status="start") {
  if (status=="start") {
    let targetInitContain = target.html();
    target.html("<span class='spinner-grow spinner-grow-sm'></span> Opération en cours...");
    target.attr('data-W_INIT_CONTAIN', targetInitContain);
  }else{
    target.html(target.attr('data-W_INIT_CONTAIN'));
  }
}



  function W_SHOW_HIDE(elementShow, elementHide){
    elementShow.removeAttr('hidden');
    elementHide.attr('hidden', 'hidden');
  }
