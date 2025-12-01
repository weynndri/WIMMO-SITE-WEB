<?php 
    
    include '_webSiteAssets/inc/bd.inc.php';

 ?>

<!DOCTYPE html>
<html lang="fr-FR">

<?php include '_webSiteAssets/inc/head.inc.php'; ?>

<body>

    <!--preloader start-->
    <!-- <div id="preloader">
        <div class="preloader-wrap">
            <img src="_webSiteAssets/assets/img/logo-color.png" alt="logo" class="img-fluid" />
            <div class="thecube">
                <div class="cube c1"></div>
                <div class="cube c2"></div>
                <div class="cube c4"></div>
                <div class="cube c3"></div>
            </div>
        </div>
    </div> -->
    <!--preloader end-->
    <!--header section start-->
    <?php include '_webSiteAssets/inc/header.inc.php'; ?>
    <!--header section end-->

    <div class="main">

      <!-- CONTENU PRINCIPAL -->
      <?php 

        $defaultPage = "landingPage";
        $page = isset($_GET["page"]) ? $_GET["page"] : $defaultPage;
        $path = "_webSiteAssets/pages/$page.php";
        // if(!is_file($path)){ $path = $defaultPage; }


        if(is_file($path)){ 
          include $path;
        }else {
          echo "<center class='mt-5'><i class=\"site-menu-icon wb-warning\" style='font-size: 47px;' aria-hidden=\"true\"></i> <h2>Page Introuvable<h2></center>";
        }
      ?>

    </div>

    
    <!-- footer section start -->
    <footer class="footer-1 gradient-bg ptb-60 footer-with-newsletter">
        <!-- subscribe newsletter start -->
        <div class="container">
            <div class="row newsletter-wrap primary-bg rounded shadow-lg p-5">
                <div class="col-12">
                    <div class="newsletter-content text-white text-center">
                        <h3 class="mb-0 text-white text-uppercase">
                            Obtenez <span class="text-warning">7 jours</span> supplémentaires pour votre premier abonnement
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- subscribe newsletter end -->

        <?php /** ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-4 mb-4 mb-md-4 mb-sm-4 mb-lg-0">
                        <a href="#" class="navbar-brand mb-2">
                            <img src="_webSiteAssets/assets/img/logoSite2.png" alt="logo" class="img-fluid">
                        </a>
                        <br>
                        <p>WIMMO est un logiciel de gestion immobilière conçu pour répondre aux besoins spécifiques des agences, propriétaires, et gestionnaires de biens en Afrique.</p>
                        <div class="list-inline social-list-default background-color social-hover-2 mt-2">
                            <li class="list-inline-item"><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="youtube" href="https://www.youtube.com/channel/UCiY3zoP-aFPweYFJGwAM5yw" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8">
                        <div class="row mt-0">
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                                <h6 class="text-uppercase">Resources</h6>
                                <ul>
                                    <li>
                                        <a href="#">Help</a>
                                    </li>
                                    <li>
                                        <a href="#">Events</a>
                                    </li>
                                    <li>
                                        <a href="#">Open source</a>
                                    </li>
                                    <li>
                                        <a href="#">Documentation</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                                <h6 class="text-uppercase">Le Produit</h6>
                                <ul>
                                    <li>
                                        <a href="#">Pricing</a>
                                    </li>
                                    <li>
                                        <a href="#">AI Studio</a>
                                    </li>
                                    <li>
                                        <a href="#">Performance</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3 mb-4 mb-sm-4 mb-md-0 mb-lg-0">
                                <h6 class="text-uppercase">Company</h6>
                                <ul>
                                    <li>
                                        <a href="#">About Us</a>
                                    </li>
                                    <li>
                                        <a href="#">Careers</a>
                                    </li>
                                    <li>
                                        <a href="#">Customers</a>
                                    </li>
                                    <li>
                                        <a href="#">Community</a>
                                    </li>
                                    <li>
                                        <a href="#">Our Team</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <h6 class="text-uppercase">Support</h6>
                                <ul>
                                    <li>
                                        <a href="#">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="#">Sells</a>
                                    </li>
                                    <li>
                                        <a href="#">Contact Support</a>
                                    </li>
                                    <li>
                                        <a href="#">Network Status</a>
                                    </li>
                                    <li>
                                        <a href="#">Product Services</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end of container-->
        <?php /**/ ?>
        <!-- contenu principal du footer désactivé via PHP commenté -->
    </footer>

    <!-- footer bottom copyright start -->
    <div class="footer-bottom py-3 gray-light-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="copyright-wrap small-text text-center">
                        <p class="mb-0">
                            <a class="facebook" href="https://web.facebook.com/wimmo.software" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a class="youtube" href="https://www.youtube.com/channel/UCiY3zoP-aFPweYFJGwAM5yw" target="_blank"><i class="fab fa-youtube"></i></a>
                            &nbsp;&copy; 2020 <a href="https://web.facebook.com/WimmoMultiServices" target="_blank">WIMMO SARL</a>, Tous droits réservés.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--footer bottom copyright end-->
    <!--footer section end-->
    <!--scroll bottom to top button start-->
    <div class="scroll-top scroll-to-target primary-bg text-white" data-target="html">
        <span class="fas fa-hand-point-up"></span>
    </div>
    <!--scroll bottom to top button end-->
    <!--build:js-->
    <script src="_webSiteAssets/assets/js/vendors/jquery-3.5.1.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/popper.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/bootstrap.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/jquery.easing.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/owl.carousel.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/countdown.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/jquery.waypoints.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/jquery.rcounterup.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/magnific-popup.min.js"></script>
    <script src="_webSiteAssets/assets/js/vendors/validator.min.js"></script>
    <script src="_webSiteAssets/assets/js/app.js"></script>
    <!--endbuild-->




    <!-- CAROUSSEL 1 -->
    <script>
    window.addEventListener("DOMContentLoaded", () => {
        const track = document.querySelector(".W_carousel_track");
        const container = document.querySelector(".W_carousel_container");

        // Dupliquer 1 seule fois tout le contenu
        const clone = track.innerHTML;
        track.innerHTML += clone;

        // Pause au survol
        container.addEventListener("mouseenter", () => {
            track.style.animationPlayState = "paused";
        });
        container.addEventListener("mouseleave", () => {
            track.style.animationPlayState = "running";
        });
    });

    </script>






</body>


</html>