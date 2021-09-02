<?php
  ob_start();
?>
<div class="banner-approche">
  <h1>Our approach</h1>
  <p class="banner-p">Patient experience and design are combined with medical research and cutting-edge technology to support millions of people suffering from Post Traumatic Stress Disorder.</p>
</div>

 <!--PRESENTATION BLOCS-->
<section class="blocs-presentation">

  <!--BLOC 1-->
  <div class="bloc bloc-1">
    <div class="text-bloc">
      <h2>Medically proven therapeutic programs and courses adapted to each stage</h2>
      <p>
        Thanks to our healthcare professionals, programs and exercises that have already provided clinical evidence are designed.
      </p>
    </div>
    <div class="bloc-image-container">
      <img src="/images/approche/bloc1.jpeg" alt="Medically proven therapeutic program adapted to each stage">
      <span class="finger-form-right"></span>
    </div>
  </div>

  <!--BLOC 2-->
  <div class="bloc bloc-2">
    <div class="bloc-image-container">
      <img src="/images/approche/bloc2.jpeg" alt="Follow-up">
      <span class="finger-form-left"></span>
    </div>
    <div class="text-bloc">
      <h2>Initiated and prescribed by health professionals to no longer be alone or in bad company</h2>
      <p>
        Care access problems are unaccetable, as well as bad practices and therapeutic wandering of traumatic events victims.
      </p>
      <p>
        Patients are supported throughout their nursing and their life journey.
      </p>
    </div>
  </div>

  <!--BLOC 3-->
  <div class="bloc bloc-3">
    <div class="text-bloc">
      <h2>Design and patient experience at the heart of our solutions</h2>
      <p>
        In advance of our developments, user experience is regarded highly by continually building our solutions with people going through traumatic events.
      </p>
    </div>
    <div class="bloc-image-container">
      <img src="/images/approche/bloc3.jpeg" alt="Design at the heart of our solutions">
      <span class="finger-form-right"></span>
    </div>
  </div>

    <!--BLOC 4-->
  <div class="bloc bloc-4">
    <div class="bloc-image-container">
      <img src="/images/approche/bloc4.jpeg" alt="A complete experience">
      <span class="finger-form-left"></span>
    </div>
    <div class="text-bloc">
      <h2>A complete, assisted and customised experience</h2>
      <p>
        Thanks to multidisciplinary players and our algorithms power, real-time measurements, physical and physiological parameters analyzes are offered to deliver predictive interventions and personalised courses covering the entire spectrum of psychotraumatic syndromes.
      </p>
    </div>
    
  </div>

  <!--BLOC 5-->
  <div class="bloc bloc-5">
    <div class="text-bloc">
      <h2>Health data transparency and security</h2>
      <p>Our solutions are built by holding health data security and confidentiality in high esteem.</p> 
      <p>
        Hosted by a French actor, on French soil and committed to our sovereignty preservation for total transparency, clear and explicit consent.
      </p> 
    </div>
    <div class="bloc-image-container">
      <img src="/images/approche/bloc5.jpeg" alt="Health data security">
      <span class="finger-form-right"></span>
    </div>
  </div>
</section>
<?php
  $content = ob_get_clean();
?>