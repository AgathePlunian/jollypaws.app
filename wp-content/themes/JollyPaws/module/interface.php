<!--About -->
<section class="interface-section">
  <div class="interface-container container"> 
    <h2 class="interface-title">Une interface simple et fluide</h2>

    <div class="interface-image">
        <?php 
         $interface_image = get_field('interface_image');
          if( !empty( $interface_image ) ): ?>
            <img class="illu-img" src="<?php echo esc_url($interface_image['url']); ?>" alt="<?php echo esc_attr($interface_image['alt']); ?>" />
          <?php endif; ?>
    </div>

    <a class="btn btn-white" href="#"><?php echo get_field('interface_button')['title']; ?></a>
  </div>
</section>



