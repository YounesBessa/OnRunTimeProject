<?php
session_start();

require('inc/pdo.php');
require('inc/function.php');


include('inc/header.php'); ?>

        <div class="clear"></div>
        <div class="content">
            <h1 class="aboutus">A propos de nous</h1>
            <div class="partie1">
                <h1 class="aboutenterprise">Notre entreprise...</h1>
                <p class="nindotitle">Nos trois mots d'ordre :</p>
                <div class="captions">
                    <div class="nindo">
                        <div class="icons">
                            <img class="reverse" src="assets/img/clock.png" alt="">  
                        </div>
                        <h4>Rapidité</h4>
                    </div>
                    <div class="nindo">
                        <div class="icons">
                            <img class="reverse" src="assets/img/lock.png" alt="">
                        </div>
                        <h4>Sécurité</h4>
                    </div>
                    <div class="nindo">
                        <div class="icons">
                            <img class="reverse" src="assets/img/zen.png" alt="">
                        </div>
                        <h4>Sérénité</h4>
                    </div>
                    <div class="nindo">

                    </div>
                </div>
                <p class="textabout">La société OnRunTime, fondée en 2000, est spécialisée en analyse réseau. Nos clients font confiance à notre expertise en matière d'architecture et de sécurité réseau depuis plusieurs années et font appel à nous pour les aider à protéger leur entreprise contre toutes les menaces auxquelles ils peuvent être exposés.</p>
            </div>
            <div class="clear"></div>
            <div class="partie2">
                <h1 class="teamTitle">Notre équipe est à votre écoute...</h1>
                <div class="groupeslider">
                    <div class="loremwrap">
                        <p class="loremslider">"Notre équipe est composée de personnes compétentes et talentueuses. Nous sommes là pour vous, nous mettons notre expertise et notre savoir-faire à votre disposition. Pour nous le client est roi, votre satisfaction est donc notre priorité, nous feront donc tout notre possible pour satisfaire vos exigences. <br> Nous encourageons nos clients à parler de nous à leur connaissance, le travail est toujours bien fait et dans les temps."</p>
                    </div>
                    <div class="carouselwrap">
                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
                                <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
                                <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
                                <li data-bs-target="#myCarousel" data-bs-slide-to="3"></li>
                            </ol>
                            <div class="team">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="assets/img/sahel.jpg" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Sahel JULIENNE</h5>
                                            <!-- <p>"Tout vient à point à qui sait attendre"</p> -->
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/Kristen.jpg" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kristen JAMET</h5>
                                            <!-- <p>"Pierre qui roule n'amasse pas mousse"</p> -->
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/younes.jpg" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Younès BESSA</h5>
                                            <!-- <p>"Salut à toi jeune entrepreneur"</p> -->
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="assets/img/maxime.jpg" class="d-block w-100" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Maxime KOCK BOUABID</h5>
                                            <!-- <p>"Je crois que la question elle est vite répondue"</p> -->
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="partie3">
                <h1>Nos serveurs</h1>
                <p>Nous sommes présents dans différents pays du globe :</p>
                <div class="list">
                    <div class="localisation">
                        <div class="img_box">
                            <img class="img_locaux reverse" src="assets/img/melbourne.png" alt="melbourne">
                        </div>
                        <span class="city">Melbourne</span>
                        <p>Australie</p>
                    </div>
                    <div class="localisation">
                        <div class="img_box">
                            <img class="img_locaux reverse" src="assets/img/los_angeles.png" alt="melbourne">
                        </div>
                        <span class="city">Los Angeles</span>
                        <p>Etats-Unis</p>
                    </div>
                    <div class="localisation">
                        <div class="img_box">
                            <img class="img_locaux reverse" src="assets/img/guadalajara.png" alt="melbourne">
                        </div>
                        <span class="city">Guadalajara</span>
                        <p>Mexique</p>
                    </div>
                    <div class="localisation">
                        <div class="img_box">
                            <img class="img_locaux reverse" src="assets/img/remote.png" alt="melbourne">
                        </div>
                        <span class="city">Remote Work</span>
                        <p>Partout depuis l'Australie</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        
<?php include('inc/footer.php');