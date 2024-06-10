<?php

function mon_theme_supports() {
    add_theme_support('title-tag');
    
}


function mon_theme_assets() {
    wp_register_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'style');

    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js','','', true);
    wp_enqueue_script( 'bootstrap');
    wp_register_script('OwlCarousel', get_template_directory_uri() . '/js/owl.carousel.min.js','','', true);
    wp_register_script('JollyPaws', get_template_directory_uri() . '/js/index.js','','', true);
    wp_enqueue_script( 'OwlCarousel');
    wp_enqueue_script( 'JollyPaws');

     

    add_filter("script_loader_tag", "add_module_to_my_script", 10, 3);
    function add_module_to_my_script($tag, $handle, $src)
    {
        if ("JollyPaws" === $handle) {
            $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
        }

        return $tag;
    }

    
    }


add_action('after_setup_theme', 'mon_theme_supports');
add_action('wp_enqueue_scripts', 'mon_theme_assets');

add_filter( 'show_admin_bar', '__return_false' );


class found_directory_frontend {
    public $submitted_fields = '';
    public $validation_errors = '';

    public function __construct() {
        add_filter('acf/pre_save_post', array($this, 'pre_save_post'));
        add_action('acf/save_post', array($this, 'custom_handle_error'), 1);
  
    }

    function acf_create_fields($fields, $post_id) {
        foreach ($fields as &$field) {
            if ( array_key_exists($field['name'], $this->submitted_fields) )
                $field['value'] = $this->submitted_fields[$field['name']];
        }
        return $fields;
    }

    function add_error() {
        echo '<div id="message" class="error">';
        foreach ( $this->validation_errors as $key => $error ) {
            echo '<p class="' . $key . '">' . $error . '</p>';
        }
        echo '</div>';
    }
    
    function custom_handle_error($post_id) {
        if ('error' == $post_id) {
            unset($_POST['return']);
        }
    }
    
    function pre_save_post($post_id) {
        
        if (empty($_POST['fields']) || !is_array($_POST['fields'])){
            $this->validation_errors['empty'] = "One or more required fields have not been completed";
        } else {
            foreach($_POST['fields'] as $k => $v) {
                // get field
                $f = apply_filters('acf/load_field', false, $k );
                $f['value'] = $v;
                $this->submitted_fields[$f['name']] = $f;
            }
            $this->submitted_fields['post_title'] = $_POST['post_title'];
        }
        
        if( function_exists( 'cptch_check_custom_form' ) && cptch_check_custom_form() !== true ) {
            $this->validation_errors['empty'] = "Please complete the Anti-spam verification.";
        }
        
        if ($this->validation_errors) {
            // Output the messges area on the form
            add_filter( 'acf/get_post_id', array($this, 'add_error') );
            
            // Turn the post_id into an error
            $post_id = 'error';
            
            // Add submitted values to fields
            add_action('acf/create_fields', array($this, 'acf_create_fields'), 10, 2 );
            
            return $post_id;
        }
       
    }
}
?>