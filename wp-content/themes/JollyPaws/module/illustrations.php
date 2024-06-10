<!--COMPÉTENCES-->

<section class="illustrations">

  <div class="container illustrations-container">
    <div class="illustrations-block">

      <div class="illustration-group">
        <div class="illustration-img">
          <?php $illustration_groupe_1 = get_field('illustration_groupe_1'); ?>
          <?php 
            $illustration_1 = $illustration_groupe_1['illustration_image'];
            if( !empty( $illustration_1 ) ): ?>
              <img class="illu-img" src="<?php echo esc_url($illustration_1['url']); ?>" alt="<?php echo esc_attr($illustration_1['alt']); ?>" />
           <?php endif; ?>
        </div>
        <p class="illustation-text"><?php echo $illustration_groupe_1['illustration_text']; ?></p>
      </div>

      <div class="illustration-group">
        <div class="illustration-img">
          <?php $illustration_groupe_2 = get_field('illustration_groupe_2'); ?>
            <?php 
              $illustration_2 = $illustration_groupe_2['illustration_image'];
              if( !empty( $illustration_2 ) ): ?>
                <img class="illu-img" src="<?php echo esc_url($illustration_2['url']); ?>" alt="<?php echo esc_attr($illustration_2['alt']); ?>" />
            <?php endif; ?>
        </div>
          <p class="illustation-text"><?php echo $illustration_groupe_2['illustration_text']; ?></p>
      </div>

      <div class="illustration-group">
        <div class="illustration-img">
          <?php $illustration_groupe_3 = get_field('illustration_groupe_3'); ?>
            <?php 
              $illustration_3 = $illustration_groupe_3['illustration_image'];
              if( !empty( $illustration_3 ) ): ?>
                <img class="illu-img" src="<?php echo esc_url($illustration_3['url']); ?>" alt="<?php echo esc_attr($illustration_3['alt']); ?>" />
            <?php endif; ?>
          </div>
          <p class="illustation-text"><?php echo $illustration_groupe_3['illustration_text']; ?></p>
      </div>

    </div>

  </div>
</section>