<?php
    if(isset($success) && $success == true){     
        $content =  $content = '
        <div class="unsubscribe-page-container">
            <div class="unsubscribe-img-container-success">
                <img src="/images/illustrations/success-unsubscribe.png" alt="Unsubscribe success">
            </div>
            <div class="text-unsubscribe-container">
                <p class="text-unsubscribe"> 
                You have been successfully unsubscribed from the newsletter.
                </p>
                <p class="text-unsubscribe">
                We look forward to seeing you soon!
                </p>
            </div>
         </div>
    ';
    }
    
    else{
        $content ='
        <div class="unsubscribe-page-container">
            <div class="unsubscribe-img-container-fail">
                <img src="/images/illustrations/error-alert.png" alt="Unsubscribe fail">
            </div>
            <div class="text-unsubscribe-container">
                <p class="text-unsubscribe-fail"> 
                    Sorry, a technical problem occured.
                </p>
                <p class="text-error-contact">
                   Please contact us at: <a class="mailto" href="mailto: contact@resileyes.com">contact@resileyes.com</a> so we can save this problem quickly.
                </p>
            </div>
        </div>
   ';
    }
?>