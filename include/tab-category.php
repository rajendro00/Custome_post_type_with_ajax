<?php  


class custom_tab_category{
    function __construct(){
        add_shortcode( 'custom_tab_category_display', [$this, 'custom_tab_category_display']);
        add_action('wp_enqueue_scripts', [$this , 'tab_category_script']);
        add_action('wp_ajax_tab_category_ajax', [$this, 'tab_category_ajax']);
    }

    function custom_tab_category_display(){
        ob_start(); ?>

        <div class="tabs">
            <ul class="nav-items">
                <?php  
                
                $terms = get_terms( array(
                    'taxonomy'   => 'stories_category',
                    'hide_empty' => false,
                ) );

                foreach($terms as $cat){ ?>
                    <li class="nav-item" data-target="<?php  echo esc_attr($cat->term_id) ?> "><?php  echo esc_html($cat->name) ?>  </li>
                <?php  }
                
                ?>  
            </ul>
            <div class="content-wrapper">
                <div class="content-item">
                    
                </div>
            </div>
        </div>

       <?php return ob_get_clean();
    }

    function tab_category_script(){
        wp_enqueue_style('category-css', PLUGIN_ASSETS_DIR_PUBLIC. 'css/style2.css' );
        wp_enqueue_script('category-js', PLUGIN_ASSETS_DIR_PUBLIC. 'js/main2.js', ['jquery'], time(), true );
        wp_localize_script( 'category-js', 'category_obj', [
            'ajax_url' => admin_url('admin-ajax.php')
        ] );
    }

    function tab_category_ajax(){

        $args = [
           'post_type'      => 'story',
            'tax_query'      => [
                [
                    'taxonomy' => 'stories_category',
                    'field'    => 'term_id',
                    'terms'    => $_POST['id'],
                ],
            ],
        ];

        $query = new \WP_Query($args);

            
        while($query-> have_posts(  )): $query->the_post(); ?>
        <h1><?php  the_title(); ?>  </h1>
        <?php  the_content(); ?>
        <?php  if(has_post_thumbnail()){
            the_post_thumbnail();
        } ?>    
       <?php endwhile;
       wp_die();
    }
}