<!--About -->
<section class="testimonies">
  <div class="testimonies-container container"> 
    <h2 class="testimonies-title">Ils ont testé JollyPaws !</h2>

    <div class="owl-carousel owl-theme">
     <div class="item card-testimony">
      <?php $testimony_1 = get_field('testimony_1'); ?>
        <?php 
            $image_author = $testimony_1['testimony_image'];
            if( !empty( $image_author ) ): ?>
                <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
            <?php endif; ?>
          <div class="content-flex-testimony">
            <p class="testimony-content"><?php echo $testimony_1['testimony_content']; ?></p>
            <p class="testimony-author"><?php echo $testimony_1['testimony_author']; ?></p>
          </div>
      </div>

      <div class="item card-testimony">
        <?php $testimony_2 = get_field('testimony-2'); ?>
        <?php 
          $image_author = $testimony_2['testimony_image'];
          if( !empty( $image_author ) ): ?>
              <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
          <?php endif; ?>
          <div class="content-flex-testimony">
            <p class="testimony-content"><?php echo $testimony_2['testimony_content']; ?></p>
            <p class="testimony-author"><?php echo $testimony_2['testimony_author']; ?></p>
          </div>
      </div>

    <div class="item card-testimony">
      <?php $testimony_3 = get_field('testimony-3'); ?>
        <?php 
            $image_author = $testimony_3['testimony_image'];
            if( !empty( $image_author ) ): ?>
                <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
            <?php endif; ?>
            <div class="content-flex-testimony">
              <p class="testimony-content"><?php echo $testimony_3['testimony_content']; ?></p>
              <p class="testimony-author"><?php echo $testimony_3['testimony_author']; ?></p>
          </div>
      </div>

      <div class="item card-testimony">
        <?php $testimony_1 = get_field('testimony_1'); ?>
        <?php 
            $image_author = $testimony_1['testimony_image'];
            if( !empty( $image_author ) ): ?>
                <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
            <?php endif; ?>
          <div class="content-flex-testimony">
            <p class="testimony-content"><?php echo $testimony_1['testimony_content']; ?></p>
            <p class="testimony-author"><?php echo $testimony_1['testimony_author']; ?></p>
          </div>
      </div>

      <div class="item card-testimony">
      <?php $testimony_2 = get_field('testimony-2'); ?>
        <?php 
          $image_author = $testimony_2['testimony_image'];
          if( !empty( $image_author ) ): ?>
              <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
          <?php endif; ?>
          <div class="content-flex-testimony">
            <p class="testimony-content"><?php echo $testimony_2['testimony_content']; ?></p>
            <p class="testimony-author"><?php echo $testimony_2['testimony_author']; ?></p>
          </div>
      </div>

    <div class="item card-testimony">
      <?php $testimony_3 = get_field('testimony-3'); ?>
        <?php 
            $image_author = $testimony_3['testimony_image'];
            if( !empty( $image_author ) ): ?>
                <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
            <?php endif; ?>
            <div class="content-flex-testimony">
              <p class="testimony-content"><?php echo $testimony_3['testimony_content']; ?></p>
              <p class="testimony-author"><?php echo $testimony_3['testimony_author']; ?></p>
          </div>
      </div>

      <div class="item card-testimony">
      <?php $testimony_1 = get_field('testimony_1'); ?>
        <?php 
            $image_author = $testimony_1['testimony_image'];
            if( !empty( $image_author ) ): ?>
                <img class="testimony-img" src="<?php echo esc_url($image_author['url']); ?>" alt="<?php echo esc_attr($image_author['alt']); ?>" />
            <?php endif; ?>
          <div class="content-flex-testimony">
            <p class="testimony-content"><?php echo $testimony_1['testimony_content']; ?></p>
            <p class="testimony-author"><?php echo $testimony_1['testimony_author']; ?></p>
          </div>
      </div>



    </div>
  </div>
</section>



