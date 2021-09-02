<?php
  ob_start();
?>
<div class="banner-approche">
  <h1>Notre approche</h1>
  <p class="banner-p">Nous combinons expérience patient et design à la recherche médicale et la technologie de pointe pour accompagner des millions de personnes atteintes de stress post-traumatique.</p>
</div>

   <!--PRESENTATION BLOCS-->
<section class="blocs-presentation">

  <!--BLOC 1-->
  <div class="bloc bloc-1">
    <div class="text-bloc">
      <h2>Des programmes et des parcours thérapeutiques prouvés médicalement et adaptés à chaque stade</h2>
      <p>
        Grâce à nos professionnels de santé, nous concevons des programmes et des exercices ayant déjà apporté des preuves cliniques.
      </p>
    </div>
    <div class="bloc-image-container">
      <img src="/images/approche/bloc1.jpeg" alt="Parcours thérapeutiques prouvés médicalement">
      <span class="finger-form-right"></span>
    </div>
  </div>

  <!--BLOC 2-->
  <div class="bloc bloc-2">
    <div class="bloc-image-container">
      <img src="/images/approche/bloc2.jpeg" alt="Accompagnement thérapeutique">
      <span class="finger-form-left"></span>
    </div>
    <div class="text-bloc">
      <h2>Initiés et prescrits par des professionnels de santé pour ne plus être seul ou mal accompagné</h2>
      <p>
        Nous n'acceptons pas les problèmes d'accès aux soins, les mauvaises pratiques et l'errance thérapeutique des personnes victimes d'évènements traumatisants.
      </p>
      <p>
        Nous accompagnons les patients tout au long de leur prise en charge et de leur parcours de vie.
      </p>
    </div>
  </div>

  <!--BLOC 3-->
  <div class="bloc bloc-3">
    <div class="text-bloc">
      <h2>Le design et l'expérience patient ancrés au cœur de nos solutions</h2>
      <p>
        Nous plaçons l'expérience des utilisateurs en amont de nos développements en construisant continuellement nos solutions avec les personnes ayant vécu des évènements traumatisants.
      </p>
    </div>
    <div class="bloc-image-container">
      <img src="/images/approche/bloc3.jpeg" alt="Le design au cœur de nos solutions">
      <span class="finger-form-right"></span>
    </div>
  </div>

    <!--BLOC 4-->
  <div class="bloc bloc-4">
    <div class="bloc-image-container">
      <img src="/images/approche/bloc4.jpeg" alt="Experience complète, assitée et personnalisée">
      <span class="finger-form-left"></span>
    </div>
    <div class="text-bloc">
      <h2>Une expérience complète, assistée et personnalisée</h2>
      <p>
        Grâce à des acteurs pluridisciplinaires et la puissance de nos algorithmes, nous offrons des mesures et des analyses en temps réel de paramètres physiques et physiologiques pour délivrer des interventions prédictives et des parcours personnalisés couvrant tout le spectre des syndromes psychotraumatiques.
      </p>
    </div>
    
  </div>

  <!--BLOC 5-->
  <div class="bloc bloc-5">
    <div class="text-bloc">
      <h2>Une transparence et une sécurité des données de santé</h2>
      <p>Nous construisons nos solutions en mettant au cœur de notre architecture la sécurité et la confidentialité des données des patients et des professionnels.</p> 
      <p>Un hébergement par un acteur français, sur le sol français et engagé dans la préservation de notre souveraineté pour une transparence totale et un consentement clair et explicite.</p> 
    </div>
    <div class="bloc-image-container">
      <img src="/images/approche/bloc5.jpeg" alt="Transparence et sécurité des données">
      <span class="finger-form-right"></span>
    </div>
  </div>
</section>
<?php
  $content = ob_get_clean();
?>