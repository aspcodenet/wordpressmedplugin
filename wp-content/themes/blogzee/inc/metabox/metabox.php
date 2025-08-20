<?php
/**
 * Adds metabox in Blogzee Pro
 * 
 * @since 1.0.0
 * @package Blogzee Pro
 */

 define('BLOGZEE_IMAGE_URL', get_template_directory_uri() . '/assets/images/customizer/' );
 if( ! function_exists( 'blogzee_add_custom_metabox' ) ) :
    /**
     * register metabox in Blogzee Pro
     * 
     * @since 1.0.0
     */
    function blogzee_add_custom_metabox() {
        add_meta_box(
            'post_layouts',
            esc_html__( 'Layouts', 'blogzee' ),
            'blogzee_post_layouts_html',
            'post',
            'advanced',
            'default',
            [ 'type' => 'post' ]
        );
        add_meta_box(
            'page_layouts',
            esc_html__( 'Layouts', 'blogzee' ),
            'blogzee_post_layouts_html',
            'page',
            'advanced',
            'default',
            [ 'type' => 'page' ]
        );
    }
    add_action( 'add_meta_boxes', 'blogzee_add_custom_metabox' );
 endif;
 if( ! function_exists( 'blogzee_post_layouts_html' ) ) :
    /**
     * call back form posts layouts metabox
     * 
     * @since 1.0.0
     */
    function blogzee_post_layouts_html( $post, $metabox ) {
        $sidebar_layout_args = [ 
            'customizer-setting'    =>  BLOGZEE_IMAGE_URL . 'customizer_settings.png',
            'right-sidebar' =>  BLOGZEE_IMAGE_URL . 'right-sidebar.png',
            'left-sidebar'  =>  BLOGZEE_IMAGE_URL . 'left-sidebar.png',
            'no-sidebar'  =>  BLOGZEE_IMAGE_URL . 'no-sidebar.png'
        ];
        $post_sidebar_layout = metadata_exists( 'post', $post->ID, 'post_sidebar_layout' ) ? get_post_meta( $post->ID, 'post_sidebar_layout', true ) : 'customizer-setting';
        $page_sidebar_layout = metadata_exists( 'post', $post->ID, 'page_sidebar_layout' ) ? get_post_meta( $post->ID, 'page_sidebar_layout', true ) : 'customizer-setting';
        ?>
            <div class="sidebar-section">
                <h2 class="title"><?php echo esc_html__( 'Sidebar Layouts', 'blogzee' ); ?></h2>
                <div class="sidebar-layouts-wrap">
                    <?php 
                        if( $metabox['args']['type'] == 'post' ): 
                            $meta_key = 'post_sidebar_layout';
                            $meta_value = $post_sidebar_layout;
                        else:
                            $meta_key = 'page_sidebar_layout';
                            $meta_value = $page_sidebar_layout;
                        endif;
                        blogzee_metabox_loop_part( $sidebar_layout_args, $meta_key, $meta_value );
                    ?>
                </div>
            </div>
        <?php
    }
 endif;

 if( ! function_exists( 'blogzee_metabox_loop_part' ) ) :
    /**
     * adds radio images in metabox
     * 
     * @since 1.0.0
     * @param array key( id of radio image ), value( path of radio image )
     * @return html
     */
    function blogzee_metabox_loop_part( $layout_args, $meta_key, $meta_value ) {
        if( is_array( $layout_args ) && ! empty( $layout_args ) ) :
            $count = 0;
            foreach( $layout_args as $layout_key => $layout_value ) :
                $checked = ( $meta_value == $layout_key ) ? 'checked' : '';
                $isactive = ( $meta_value == $layout_key ) ? ' isactive' : '';
                ?>
                    <p class="layout-item<?php echo $isactive; ?>">
                        <input type="radio" name="<?php echo esc_attr( $meta_key ); ?>" id="<?php echo esc_attr( $layout_key ); ?>" value="<?php echo esc_attr( $layout_key ); ?>" <?php echo esc_attr( $checked ); ?>>
                        <label for="<?php echo esc_attr( $layout_key ); ?>">
                            <img src="<?php echo esc_attr( $layout_value ); ?>" loading="lazy">
                            <span class="title"><?php echo esc_html( ucfirst( $layout_key ) ); ?></span>
                        </label>
                    </p>
                <?php
                $count++;
            endforeach;
        endif;
    }
 endif;

 if( ! function_exists( 'blogzee_save_metabox_data' ) ) :
    /**
     * save values of metaboxes
     * 
     * @since 1.0.0 
     */
    function blogzee_save_metabox_data( $post_id ) {
        if( array_key_exists( 'post_sidebar_layout', $_POST ) ) update_post_meta( $post_id, 'post_sidebar_layout', sanitize_text_field( $_POST['post_sidebar_layout'] ) );
        if( array_key_exists( 'page_sidebar_layout', $_POST ) ) update_post_meta( $post_id, 'page_sidebar_layout', sanitize_text_field( $_POST['page_sidebar_layout'] ) );
    }
    add_action( 'save_post', 'blogzee_save_metabox_data' );
 endif;

 function blogzee_post_meta_scripts($hook) {
    if( ! in_array( $hook, [ 'post.php', 'edit-tags.php', 'term.php', 'post-new.php' ] ) ) {
        return;
    }
    wp_enqueue_style( 'blogzee-metaboxes', get_template_directory_uri() . '/inc/metabox/metabox.css', array(), BLOGZEE_VERSION );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/assets/external/fontawesome/css/all.min.css', [], '6.4.2', 'all' );
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'blogzee_post_meta_scripts' );

if( ! function_exists( 'blogzee_categories_custom_meta_fields' ) ) :
	/**
	 * Adds custom meta fields in categories dashboard
	 * 
	 * @since 1.0.0
	 */
	function blogzee_categories_custom_meta_fields( $term ) {
        $sidebar_meta = metadata_exists( 'term', $term->term_id, "_blogzee_{$term->taxonomy}_sidebar_custom_meta_field" ) ? get_term_meta( $term->term_id, "_blogzee_{$term->taxonomy}_sidebar_custom_meta_field", true ) : 'customizer-setting';
        $archive_meta = metadata_exists( 'term', $term->term_id, "_blogzee_{$term->taxonomy}_archive_custom_meta_field" ) ? get_term_meta( $term->term_id, "_blogzee_{$term->taxonomy}_archive_custom_meta_field", true ) : 'customizer-layout';
		$sidebar_layout_args = [ 
            'customizer-setting'    =>  BLOGZEE_IMAGE_URL . 'customizer_settings.png',
            'right-sidebar' =>  BLOGZEE_IMAGE_URL . 'right-sidebar.png',
            'left-sidebar'  =>  BLOGZEE_IMAGE_URL . 'left-sidebar.png',
            'no-sidebar'  =>  BLOGZEE_IMAGE_URL . 'no-sidebar.png'
        ];
		$archive_layout_args = [ 
            'customizer-layout'    =>  BLOGZEE_IMAGE_URL . 'customizer_settings.png',
            'list-two'  =>  BLOGZEE_IMAGE_URL . 'archive-list-two.png',
            'grid-two'  =>  BLOGZEE_IMAGE_URL . 'archive-grid-two.png'
        ];
        ?>
            <tr class="form-field">
                <th><?php echo esc_html__( 'Sidebar Layouts', 'blogzee' ); ?></th>
                <td>
                    <div class="taxonomy-sidebar-layouts-wrap">
                        <?php blogzee_metabox_loop_part( $sidebar_layout_args, "_blogzee_{$term->taxonomy}_sidebar_custom_meta_field", $sidebar_meta ); ?>
                    </div>
                </td>
            </tr>
            <tr class="form-field">
                <th><?php echo esc_html__( 'Archive Layouts', 'blogzee' ); ?></th>
                <td>
                    <div class="taxonomy-archive-layouts-wrap">
                        <?php blogzee_metabox_loop_part( $archive_layout_args, "_blogzee_{$term->taxonomy}_archive_custom_meta_field", $archive_meta ); ?>
                    </div>
                </td>
            </tr>
        <?php
	}
	add_action( 'category_edit_form_fields', 'blogzee_categories_custom_meta_fields' );
	add_action( 'post_tag_edit_form_fields', 'blogzee_categories_custom_meta_fields' );
 endif;
 
 if( ! function_exists( 'blogzee_category_custom_meta_field_save' ) ) :
	/**
	 * Save category custom meta fields
	 * 
	 * @since 1.0.0
	 */
	function blogzee_category_custom_meta_field_save( $term_id ) {
        if( array_key_exists( '_blogzee_category_sidebar_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_blogzee_category_sidebar_custom_meta_field', sanitize_text_field( $_POST['_blogzee_category_sidebar_custom_meta_field'] ) );
        if( array_key_exists( '_blogzee_category_archive_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_blogzee_category_archive_custom_meta_field', sanitize_text_field( $_POST['_blogzee_category_archive_custom_meta_field'] ) );
	}
	add_action( 'edited_category', 'blogzee_category_custom_meta_field_save' );
	add_action( 'create_category', 'blogzee_category_custom_meta_field_save' );
 endif;

 if( ! function_exists( 'blogzee_post_tag_custom_meta_field_save' ) ) :
    /**
     * Save tag custom meta fields
     * 
     * @since 1.0.0
     */
    function blogzee_post_tag_custom_meta_field_save( $term_id ) {
        if( array_key_exists( '_blogzee_post_tag_sidebar_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_blogzee_post_tag_sidebar_custom_meta_field', sanitize_text_field( $_POST['_blogzee_post_tag_sidebar_custom_meta_field'] ) );
        if( array_key_exists( '_blogzee_post_tag_archive_custom_meta_field', $_POST ) ) update_term_meta( $term_id, '_blogzee_post_tag_archive_custom_meta_field', sanitize_text_field( $_POST['_blogzee_post_tag_archive_custom_meta_field'] ) );
    }
    add_action( 'edited_post_tag', 'blogzee_post_tag_custom_meta_field_save' );
	add_action( 'create_post_tag', 'blogzee_post_tag_custom_meta_field_save' );
 endif;

 if( ! function_exists( 'blogzee_taxonomy_custom_meta_part' ) ) :
    /**
     * Adds custom meta fields in add new category page and add new tags page
     * 
     * @since 1.0.0
     */
    function blogzee_taxonomy_custom_meta_part( $this_taxonomy ) {
        $sidebar_layout_args = [ 
            'customizer-setting'    =>  BLOGZEE_IMAGE_URL . 'customizer_settings.png',
            'right-sidebar' =>  BLOGZEE_IMAGE_URL . 'right-sidebar.png',
            'left-sidebar'  =>  BLOGZEE_IMAGE_URL . 'left-sidebar.png',
            'no-sidebar'  =>  BLOGZEE_IMAGE_URL . 'no-sidebar.png'
        ];
		$archive_layout_args = [ 
            'customizer-layout'    =>  BLOGZEE_IMAGE_URL . 'customizer_settings.png',
            'list-two'  =>  BLOGZEE_IMAGE_URL . 'archive-list-two.png',
            'grid-two'  =>  BLOGZEE_IMAGE_URL . 'archive-grid-two.png'
        ];
        ?>
            <div class="form-field term-sidebar-layouts-wrap">
                <h2><?php echo esc_html__( 'Sidebar Layouts', 'blogzee' ); ?></h2>
                <td>
                    <div class="taxonomy-sidebar-layouts-wrap">
                        <?php
                            if( is_array( $sidebar_layout_args ) && ! empty( $sidebar_layout_args ) ) :
                                $count = 0;
                                foreach( $sidebar_layout_args as $sidebar_key => $sidebar_value ) :
                                    ?>
                                        <p class="layout-item<?php echo esc_attr( ( $count == 0 ) ? ' isactive' : '' ); ?>">
                                            <input type="radio" name="<?php echo esc_attr( "_blogzee_{$this_taxonomy}_sidebar_custom_meta_field" ); ?>" id="<?php echo esc_attr( $sidebar_key ); ?>" value="<?php echo esc_attr( $sidebar_key ); ?>" <?php echo esc_attr( ( $count == 0 ) ? 'checked' : '' ); ?>>
                                            <label for="<?php echo esc_attr( $sidebar_key ); ?>">
                                                <img src="<?php echo esc_attr( $sidebar_value ); ?>" loading="lazy">
                                                <span class="title"><?php echo esc_html( ucfirst( $sidebar_key ) ); ?></span>
                                            </label>
                                        </p>
                                    <?php
                                    $count++;
                                endforeach;
                            endif;
                        ?>
                    </div>
                </td>
            </div>
            <div class="form-field term-archive-layouts-wrap">
                <h2><?php echo esc_html__( 'Archive Layouts', 'blogzee' ); ?></h2>
                <td>
                    <div class="taxonomy-archive-layouts-wrap">
                        <?php
                            if( is_array( $archive_layout_args ) && ! empty( $archive_layout_args ) ) :
                                $count = 0;
                                foreach( $archive_layout_args as $archive_key => $archive_value ) :
                                    ?>
                                        <p class="layout-item<?php echo esc_attr( ( $count == 0 ) ? ' isactive' : '' ); ?>">
                                            <input type="radio" name="<?php echo esc_attr( "_blogzee_{$this_taxonomy}_archive_custom_meta_field" ); ?>" id="<?php echo esc_attr( $archive_key ); ?>" value="<?php echo esc_attr( $archive_key ); ?>" <?php echo esc_attr( ( $count == 0 ) ? 'checked' : '' ); ?>>
                                            <label for="<?php echo esc_attr( $archive_key ); ?>">
                                                <img src="<?php echo esc_attr( $archive_value ); ?>" loading="lazy">
                                                <span class="title"><?php echo esc_html( ucfirst( $archive_key ) ); ?></span>
                                            </label>
                                        </p>
                                    <?php
                                    $count++;
                                endforeach;
                            endif;
                        ?>
                    </div>
                </td>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'blogzee_categories_custom_meta' ) ) :
    /**
     * Adds custom meta in categories
     * 
     * @since 1.0.0
     */
    function blogzee_categories_custom_meta() {
        blogzee_taxonomy_custom_meta_part( 'category' );
    }
endif;

add_action( 'category_add_form_fields', 'blogzee_categories_custom_meta' );


if( ! function_exists( 'blogzee_tags_custom_meta' ) ) :
    /**
     * Adds custom meta in categories
     * 
     * @since 1.0.0
     */
    function blogzee_tags_custom_meta() {
        blogzee_taxonomy_custom_meta_part( 'post_tag' );
    }
endif;
add_action( 'post_tag_add_form_fields', 'blogzee_tags_custom_meta' );