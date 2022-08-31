

	<!--=================== PAS ENCORE PRET !!!! -->
	<!-- MODAL GLOBALE --> 
	<div class="modal fade" id="modalGlobal" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<?php /** ?>
				<center><i class="fa fa-circle-notch fa-5x text-info fa-spin"></i></center>
				<center><i class="fa fa-compact-disc fa-5x text-info fa-spin"></i></center>
				<center><i class="fa fa-compass fa-5x text-info fa-spin"></i></center>
				<center><i class="fa fa-fan fa-5x text-info fa-spin"></i></center>
				<center><i class="fa fa-sync-alt fa-5x text-info fa-spin"></i></center>
				<?php /**/ ?>
			</div>
		</div>
	</div>




  	<!--Modal: modalPush-->
  	<div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999!important;">
	    <div class="modal-dialog modal-notify modal-info" role="document">
	      <!--Content-->
	    
	      <div class="modal-content text-center">
	        <!--Header-->
	        <div class="modal-header">
	          <div class="col-6"><button type="button" class="btn btn-info btn-block" onclick="
	          W_SHOW_HIDE($('#demoOnline'), $('#demoVideo'));
	          ">Démo en ligne</button></div>
	          <div class="col-6"><button type="button" class="btn btn-outline-info btn-block" onclick="
	          W_SHOW_HIDE($('#demoVideo'), $('#demoOnline'));
	          ">Démo en vidéo</button></div>

	          <!-- <img class="avatar avatar-xxl avatar-4by3" src="assets/svg/illustrations/unlock.svg" style="width: 200px;" alt="Image Description"> -->
	        </div>
	        <!--Body-->
	        <form action="process/demandeDemo.process.php" method="POST" id="demoOnline" 
				name="formDemande" id="formDemande" 
				onsubmit="W_ENREGISTREMENT_DEMANDE($(this),event);">

	          <input type="hidden" name="option" value="1">
	          <input type="hidden" name="objetEmail" id="objetEmail" value="Demo WIMMO : Gestion Immobiliere">
	          
	          <div class="modal-body">

	            <div class="mb-5 mt-4">
	              <h4>Démo En Ligne</h4>
	              <p class="heading text-danger">Remplissez le formulaire pour accéder à la démo en ligne</p>
	            </div>
	            <!-- <i class="fas fa-bell icofont-email fa-4x animated rotateIn mb-4"></i> -->
	            <p>
	              <div class="input-group mb-3">
	                <div class="input-group-prepend">
	                  <span class="input-group-text" id="basic-addon1"><i class="icofont-email"></i></span>
	                </div>
	                <input type="email" name='email-demandeur' id='email-demandeur' class="form-control Wrequired" placeholder="Votre e-mail..." aria-label="Email" aria-describedby="basic-addon1" required>
	              </div>

	              <div class="input-group mb-3">
	                <div class="input-group-prepend">
	                  <span class="input-group-text" id="basic-addon1"><i class="icofont-mobile-phone"></i></span>
	                </div>
	                <input type="text" name='contact-demandeur' id='contact-demandeur' class="form-control Wrequired Wnumeric" placeholder="Votre numéro de téléphone mobile..." aria-label="Contact" aria-describedby="basic-addon1" maxlength="10" required>
	              </div>
	            </p>
	          </div>

	          <!--Footer-->
	          <div class="modal-footer flex-center" style=' background-color:#3498db;'>
	            <a type="button" class="btn text-light" data-dismiss="modal"><i class="icofont-close"></i> Annuler</a>
	            <button type="submit" class="btn btn-success"><i class="icofont-check"></i> Envoyer</button>
	          </div>
	        </form>

	        <div class="modal-body" id="demoVideo" hidden>
	            <div class="mb-5 mt-4">
	              <h4>Démo Vidéo</h4>
	              <p class="heading text-danger">Présentation du logiciel</p>
	            </div>

	          	<iframe width="100%" height="315" src="https://www.youtube.com/embed/K4gSvPYR4h8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	        </div>

	      </div>

	      <!--/.Content-->
	    </div>
  	</div>
  	<!--Modal: modalPush-->

