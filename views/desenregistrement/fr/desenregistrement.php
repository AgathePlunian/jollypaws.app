<?php
    if(isset($success) && $success == true){
        $content = '
                        <div class="unsubscribe-page-container">
                            <div class="unsubscribe-img-container-success">
                                <img src="/images/illustrations/success-unsubscribe.png" alt="Succès de la désinscription">
                            </div>
                            <div class="text-unsubscribe-container">
                                <p class="text-unsubscribe"> 
                                Vous avez correctement été désinscrit de la newsletter. 
                                </p>
                                <p class="text-unsubscribe">
                                En espérant vous revoir très vite !
                                </p>
                            </div>
                         </div>
                    ';
    }
    else {
        $content = '
                        <div class="unsubscribe-page-container">
                            <div class="unsubscribe-img-container-fail">
                                <img src="/images/illustrations/error-alert.png" alt="Erreur lors de la désinscription">
                            </div>
                            <div class="text-unsubscribe-container">
                                <p class="text-unsubscribe-fail"> 
                                    Toutes nos excuses, un problème technique est survenu.
                                </p>
                                <p class="text-error-contact">
                                    Veuillez nous contacter à l\'adresse suivante : <a class="mailto" href="mailto: contact@resileyes.com">contact@resileyes.com</a> afin que nous puissions résoudre ce soucis au plus vite.
                                </p>
                            </div>
                        </div>
                   ';
    }
?>