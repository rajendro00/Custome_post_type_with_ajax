<?php  


class post_paginations{
    function __construct(){
        add_shortcode('paginatins_display', [$this, 'paginatins_display']);
        add_action("wp_enqueue_scripts", [$this,  'pagination_script']);
        add_action("wp_ajax_pagination", [$this,  'pagination_ajax']);
    }

    function paginatins_display(){
        ob_start() ;

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        
        $args = [
            'post_type' => "story",
            'posts_per_page' => 2,
            'paged' => $paged
        ];



        $query = new WP_Query($args);

        if(!empty($query)){
            while($query->have_posts(  )) : $query->the_post(  ); ?>
            <div class="post">
                <h1><?php  the_title() ?>  </h1>
                <?php  the_content(); ?>  
                <?php  if(has_post_thumbnail()){
                    the_post_thumbnail();
                } ?>  
            </div>
       <?php endwhile;

    //    mauel pagination
    $total_page = $query->max_num_pages; 
    
    
    ?>

    <div class="pagination-button"> 
        <?php  
        if( $paged > 1): ?>
            <a class="prev btn " href="<?php echo esc_url(get_pagenum_link( $paged - 1  )) ?>" data-page="<?php echo $paged - 1; ?>">Previous</a>
        <?php endif; 

        for($i = 1; $i<=$total_page; $i++){
            if($i == $paged){
                echo '<span class="current-page" style="color:green;">' . $i . '</span>';
            }else{
                echo '<a class="btn" data-page=" '.$i .' " href=" '. esc_url( get_pagenum_link($i) ).' ">' . $i . '</a>';
            }
        }

       if( $paged < $total_page): ?>
            <a class="next btn" data-page="<?php echo $paged + 1; ?>" href="<?php echo esc_url(get_pagenum_link( $paged + 1  )) ?>">Next</a>
        <?php endif
        
        ?>  
    </div>

       <?php }else{
            echo "Post not Found";
        }
        

         return ob_get_clean();
    }

    function pagination_script(){
        wp_enqueue_style('page-css', PLUGIN_ASSETS_DIR_PUBLIC. 'css/style3.css');
        wp_enqueue_script('page-js', PLUGIN_ASSETS_DIR_PUBLIC. 'js/main3.js', ['jquery'], time(), true);
        wp_localize_script( 'page-js', 'page_obj', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ] );
    }

    function pagination_ajax(){
        echo "hello";
        
        wp_die();
    }

}  