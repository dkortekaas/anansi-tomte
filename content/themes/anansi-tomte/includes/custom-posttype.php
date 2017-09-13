<?php
/**
 * Register custom post type.
 *
 * @package WordPress
 * @subpackage WeblogiqPress
 * @since WeblogiqPress 1.0.0
 */

// Services
add_action('init', 'weblogiqpress_services');
function weblogiqpress_services() {

   register_taxonomy(
      'service_type',
      'service',
      array(
          'label'          => __( 'Categories', 'weblogiq' ),
          'singular_label' => __( 'Category', 'weblogiq' ),
          'hierarchical'   => true,
          'query_var'      => true,
          'rewrite'        => array('slug' => 'services'),
      )
   );

    $labels = array(
        'name'                => _x( 'Service', 'Post Type General Name', 'anansi-tomte' ),
        'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'anansi-tomte' ),
        'menu_name'           => __( 'Services', 'anansi-tomte' ),
        'all_items'           => __( 'All Services', 'anansi-tomte' ),
        'view_item'           => __( 'View Service', 'anansi-tomte' ),
        'add_new_item'        => __( 'Add New Service', 'anansi-tomte' ),
        'add_new'             => __( 'Add New', 'anansi-tomte' ),
        'edit_item'           => __( 'Edit Service', 'anansi-tomte' ),
        'update_item'         => __( 'Update Service', 'anansi-tomte' ),
        'search_items'        => __( 'Search Service', 'anansi-tomte' )
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'menu_position'         => null,
        'supports'              => array('title','editor', 'thumbnail'),
        'rewrite'               => array(
            'slug'              => 'service',
            'with_front'        => false
        ),
        'has_archive'           => 'service',
        'menu_icon'             => 'dashicons-calendar-alt',
        'taxonomies'            => array('tag')
    );

    register_post_type( 'service' , $args );
    flush_rewrite_rules();
}

add_action('save_post', 'save_details');

// A callback function to add a custom field to our "presenters" taxonomy  
/*function service_type_taxonomy_custom_fields($tag) {  
   // Check for existing taxonomy meta for the term you're editing  
    $t_id = $tag->term_id; // Get the ID of the term you're editing  
    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
?>  
  
<tr class="form-field">  
    <th scope="row" valign="top">  
        <label for="presenter_id"><?php _e('Subtitle', 'anansi-tomte'); ?></label>  
    </th>  
    <td>  
        <input type="text" name="term_meta[subtitle]" id="term_meta[subtitle]" size="25" style="width:60%;" value="<?php echo $term_meta['subtitle'] ? $term_meta['subtitle'] : ''; ?>"><br />  
        <span class="description"><?php _e('Enter the subtitle', 'anansi-tomte'); ?></span>  
    </td>  
</tr>  
  
<?php  
} */

// A callback function to save our extra taxonomy field(s)  
// function save_taxonomy_custom_fields( $term_id ) {  
//     if ( isset( $_POST['term_meta'] ) ) {  
//         $t_id = $term_id;  
//         $term_meta = get_option( "taxonomy_term_$t_id" );  
//         $cat_keys = array_keys( $_POST['term_meta'] );  
//             foreach ( $cat_keys as $key ){  
//             if ( isset( $_POST['term_meta'][$key] ) ){  
//                 $term_meta[$key] = $_POST['term_meta'][$key];  
//             }  
//         }  
//         //save the option array  
//         update_option( "taxonomy_term_$t_id", $term_meta );  
//     }  
// }  

// Add the fields to the "presenters" taxonomy, using our callback function  
//add_action( 'service_type_edit_form_fields', 'service_type_taxonomy_custom_fields', 10, 2 );  
  
// Save the changes made on the "presenters" taxonomy, using our callback function  
//add_action( 'edited_service_type', 'save_taxonomy_custom_fields', 10, 2 );  


// Tags
// function create_tag_taxonomies() {
//     $labels = array(
//         'name' => _x( 'Tags', 'taxonomy general name' ),
//         'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
//         'search_items' =>  __( 'Search Tags' ),
//         'popular_items' => __( 'Popular Tags' ),
//         'all_items' => __( 'All Tags' ),
//         'parent_item' => null,
//         'parent_item_colon' => null,
//         'edit_item' => __( 'Edit Tag' ), 
//         'update_item' => __( 'Update Tag' ),
//         'add_new_item' => __( 'Add New Tag' ),
//         'new_item_name' => __( 'New Tag Name' ),
//         'separate_items_with_commas' => __( 'Separate tags with commas' ),
//         'add_or_remove_items' => __( 'Add or remove tags' ),
//         'choose_from_most_used' => __( 'Choose from the most used tags' ),
//         'menu_name' => __( 'Tags' ),
//     ); 

//     register_taxonomy('tag','portfolio',array(
//         'hierarchical' => false,
//         'labels' => $labels,
//         'show_ui' => true,
//         'update_count_callback' => '_update_post_term_count',
//         'query_var' => true,
//         'rewrite' => array( 'slug' => 'tag' ),
//     ));
// }
// add_action( 'init', 'create_tag_taxonomies', 0 );


//add_filter('post_type_link', 'projects_permalink_structure', 10, 4);
//function projects_permalink_structure($post_link, $post, $leavename, $sample)
//{
//    if ( false !== strpos( $post_link, '%project_type%' ) ) {
//        $event_type_term = get_the_terms( $post->ID, 'project_type' );
//        $post_link = str_replace( '%project_type%', array_pop( $event_type_term )->slug, $post_link );
//    }
//    return $post_link;
//}

//// Projects - Add Category column to list view
//add_filter("manage_edit-project_columns", "add_new_project_columns");
//function add_new_project_columns($gallery_columns) {
//    $new_columns['title'] = _x('Project', 'column name');
//    $new_columns['types'] = __('Type', 'weblogiqpress');
//    $new_columns['date'] = _x('Date', 'column name');
//    return $new_columns;
//}

//// Projects - Add to admin_init function
//add_action('manage_project_posts_custom_column', 'manage_project_columns', 10, 2);
//function manage_project_columns($column_name, $id) {
//    global $wpdb;
//    switch ($column_name) {
//        case 'types':
//            // Get types
//            $terms = get_the_terms( $post->ID,'project_type', true);
//            foreach ( $terms as $term ) {
//                echo $term->name;
//            }
//            break;
//        default:
//            break;
//    }
//}

//// Projects - Register the column as sortable
//add_filter( 'manage_edit-project_sortable_columns', 'project_column_register_sortable' );
//function project_column_register_sortable( $columns ) {
//    $columns['types'] = 'project_type';
//    return $columns;
//}

//// Sort
//add_filter( 'pre_get_posts','posts_column_orderby');
//function posts_column_orderby( $query ) {
//    if( ! is_admin() )
//        return;

//    $orderby = $query->get( 'orderby');
//    if ( 'types' == $orderby ) {
//        //alter the query args
//        $query->set('meta_key',$orderby);
//        $query->set('orderby','meta_value_num');
//    }
//}

?>