<section class="how-it-work-section">
  <div class="container how-it-works-container">

    <h2 class="show-it-works-title">Comment ça marche ?</h2>
    
    <div class="block-solution">
      <div class="block-image">
        <?php $solution_1 = get_field('how_it_work_1'); ?>
          <?php 
            $solution_image = $solution_1['block_image'];
            if( !empty( $solution_image ) ): ?>
              <img class="illu-img" src="<?php echo esc_url($solution_image['url']); ?>" alt="<?php echo esc_attr($solution_image['alt']); ?>" />
           <?php endif; ?>
        </div>
        <div class="block-content-container">
          <h3 class="solution-title"><?php echo $solution_1['block_title']; ?></h3>
          <div class="block-content"><?php echo $solution_1['block_content']; ?></div>
          <a class="btn btn-primary" href="#"><?php echo $solution_1['button_text']['title']; ?></a>
        </div>
    </div>


    <div class="block-solution reverse-block">
      <div class="block-image">
        <?php $solution_2 = get_field('how_it_work_2'); ?>
          <?php 
            $solution_image = $solution_2['block_image'];
            if( !empty( $solution_image ) ): ?>
              <img class="illu-img" src="<?php echo esc_url($solution_image['url']); ?>" alt="<?php echo esc_attr($solution_image['alt']); ?>" />
           <?php endif; ?>
        </div>
        <div class="block-content-container">
          <h3 class="solution-title"><?php echo $solution_2['block_title']; ?></h3>
          <div class="block-content"><?php echo $solution_2['block_content']; ?></div>
          <a class="btn btn-primary" href="#"><?php echo $solution_2['button_text']['title']; ?></a>
        </div>
    </div>

    <div class="block-solution">
      <div class="block-image">
        <?php $solution_3 = get_field('how_it_work_3'); ?>
          <?php 
            $solution_image_3 = $solution_3['block_image'];
            if( !empty( $solution_image_3 ) ): ?>
              <img class="illu-img" src="<?php echo esc_url($solution_image_3['url']); ?>" alt="<?php echo esc_attr($solution_image_3['alt']); ?>" />
           <?php endif; ?>
        </div>
        <div class="block-content-container">
          <h3 class="solution-title"><?php echo $solution_3['block_title']; ?></h3>
          <div class="block-content"><?php echo $solution_3['block_content']; ?></div>
          <a class="btn btn-primary" href="#"><?php echo $solution_3['button_text']['title']; ?></a>
        </div>
    </div>

    <div class="block-solution reverse-block">
      <div class="block-image">
        <?php $solution_4 = get_field('how_it_work_4'); ?>
          <?php 
            $solution_image = $solution_4['block_image'];
            if( !empty( $solution_image ) ): ?>
              <img class="illu-img" src="<?php echo esc_url($solution_image['url']); ?>" alt="<?php echo esc_attr($solution_image['alt']); ?>" />
           <?php endif; ?>
        </div>
        <div class="block-content-container">
          <h3 class="solution-title"><?php echo $solution_4['block_title']; ?></h3>
          <div class="block-content"><?php echo $solution_4['block_content']; ?></div>
          <a class="btn btn-primary" href="#"><?php echo $solution_4['button_text']['title']; ?></a>
        </div>
    </div>

    
   
  </div>
</section>