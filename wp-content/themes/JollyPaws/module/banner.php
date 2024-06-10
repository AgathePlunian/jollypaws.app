<!--BANNER-->
<div class="banner" style="background-image: url('<?php echo get_template_directory_uri()?>/images/banner/bg-banner.png');">

    <div class="container banner-container" >
        <div class="content-banner">
            <h1><?php echo get_field('banner_title')?></h1>
            <p class="banner-sub-content"><?php echo get_field('banner_content')?></p>
            <div class="button-container">
                <a href="#" class="button-download"><img src="<?php echo get_template_directory_uri()?>/images/banner/button-google.png" alt="button google download"/></a>
                <a href="#" class="button-download"><img src="<?php echo get_template_directory_uri()?>/images/banner/button-apple.png" alt="button apple download" /></a>
            </div>
        </div>
        <?php 
    $image = get_field('banner_image');
    if( !empty( $image ) ): ?>
    <div class="banner-img col-md-7 col-sm-8 col-xs-12" style="background-image: url('<?php echo get_template_directory_uri()?>/images/banner/bg-banner-mobile.png');">
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    </div>
    <?php endif; ?>
      
   
     
    </div>
</div>
