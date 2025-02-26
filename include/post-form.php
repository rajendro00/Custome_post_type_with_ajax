
<?php  


class post_form{
    function __construct(){
        add_shortcode('post_form_forntend', [$this, 'post_form_forntend']);
        add_action('init', [$this, 'create_story_post']);
        add_action('wp_enqueue_scripts', [$this,'form_enqueue_script']);
        add_action('wp_ajax_custom_post_form_call', [$this,'custome_form_post_ajax']);
    }

    function post_form_forntend(){
        ob_start(); ?>
        <h1> Story Post Create  </h1>

        <form action="" method="post" class="custom_form">
            <table class="form-table">
                <tr class="row">
                    <th>
                        <label for="">Story Title</label>
                    </th>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>
                <tr class="row">
                    <th>
                        <label for="">Story Content</label>
                    </th>
                    <td>
                        <textarea name="content" id=""></textarea>
                    </td>
                </tr>
                <tr class="row">
                    <th>
                        <label for="">Story Category</label>
                    </th>
                    <td>
                        
                    <select name="post_category" id="">
                        <?php  
                        $terms = get_terms( array( 
                            'taxonomy' => 'stories_category',
                            'hide_empty' => false,
                        ) );
                        
                        foreach($terms as $cat){ ?>
                            <option value="<?php  echo esc_attr($cat->term_id) ?>"><?php  echo esc_html($cat->name) ?>  </option>
                       <?php }
                        ?>  
                    </select>
                    </td>
                </tr>
                <tr class="row">
                    <th>
                        <label for="">Story status</label>
                    </th>
                    <td>
                        
                    <select name="post_status" id="">
                        <?php  
                        
                        $post_status = get_post_statuses(); 
                        
                        foreach($post_status as $post_slug => $post_label ){ ?>
                            <option value="<?php  echo esc_attr($post_slug); ?>"><?php  echo esc_html($post_slug); ?>  </option>
                       <?php }
                        
                        ?>  
                    </select>
                    </td>
                </tr>
            </table>
            <div class="preloader">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle fill="#FF156D" stroke="#FF156D" stroke-width="3" r="15" cx="40" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4"></animate></circle><circle fill="#FF156D" stroke="#FF156D" stroke-width="3" r="15" cx="100" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2"></animate></circle><circle fill="#FF156D" stroke="#FF156D" stroke-width="3" r="15" cx="160" cy="65"><animate attributeName="cy" calcMode="spline" dur="2" values="65;135;65;" keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0"></animate></circle></svg>
            </div>
            <input type="submit" name="create_post" value="Create Post">
            <div class="error-show"></div>
        </form>

       <?php return ob_get_clean();
    }

    function create_story_post(){
        
        if(isset($_POST['create_post'])){
            $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
            $content = isset($_POST['content']) ? wp_kses_post($_POST['content']) : '';
            $category = isset($_POST['post_category']) ? intval($_POST['post_category']) : '';
            $post_status = isset($_POST['post_status']) ? sanitize_text_field($_POST['post_status']) : '';

            $args = [
                'post_type' => 'story',
                'post_title' =>  $title,
                'post_content' =>  $content,
                'post_status' =>  $post_status,
                'tax_input'     => [
                    'stories_category' => [$category]
               ]
            ];
            

            $post_id = wp_insert_post($args);
            if(is_wp_error($post_id)){
                echo 'Error'. $post_id->get_error_message();
              }else{
                echo "Post Create Successfully";
            }
        }
       
    }

    function form_enqueue_script(){
        wp_enqueue_style('form-css', PLUGIN_ASSETS_DIR_PUBLIC. 'css/style.css');
        wp_enqueue_script('form-js', PLUGIN_ASSETS_DIR_PUBLIC. 'js/main.js', ['jquery'], '1.0.0', true);
        wp_localize_script('form-js', 'custom_post_obj', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }

    function custome_form_post_ajax(){
        
        parse_str($_POST['post_id'], $form_data);

            $title =  sanitize_text_field($form_data['title']) ;
            $content =  sanitize_textarea_field($form_data['content']) ;
            $category =  intval($form_data['post_category']) ;
            $post_status =  sanitize_text_field($form_data['post_status']);

            $args = [
                'post_type' => 'story',
                'post_title' =>  $title,
                'post_content' =>  $content,
                'post_status' =>  $post_status,
                'tax_input'     => [
                    'stories_category' => [$category]
               ]
            ];
            

            $post_id = wp_insert_post($args);
            if(is_wp_error($post_id)){
                echo 'Error'. $post_id->get_error_message();
              }else{
                wp_send_json_success( "Success" );
            }
            

        wp_die();
    }
}
