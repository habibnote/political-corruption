<?php

namespace PoliticalCorrption\App;

/**
 * Acf class
 */
class Acf {

    /**
     * class constructor
     */
    function __construct() {
        add_action( 'acf/include_fields', [$this, 'acf_pc_all_meta_fields'] );
        add_action( 'init', [$this, 'pc_register_post_type'] );
        add_filter( 'acf/settings/show_admin', '__return_false' );
    }

    /**
     * register all meta field
     */
    function acf_pc_all_meta_fields() {
        acf_add_local_field_group( array(
            'key' => 'group_6558749c0e8f4',
            'title' => 'CP All Meta Fileds',
            'fields' => array(
                array(
                    'key' => 'field_6558749c88eb7',
                    'label' => 'State',
                    'name' => 'state',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_655874cf88eb8',
                    'label' => 'Country',
                    'name' => 'country',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_655874e188eb9',
                    'label' => 'City',
                    'name' => 'city',
                    'aria-label' => '',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'maxlength' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ),
                array(
                    'key' => 'field_655874eb88eba',
                    'label' => 'Audio',
                    'name' => 'audio',
                    'aria-label' => '',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_6558757188ebb',
                    'label' => 'Video',
                    'name' => 'video',
                    'aria-label' => '',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
                array(
                    'key' => 'field_6558757f88ebc',
                    'label' => 'Document',
                    'name' => 'document',
                    'aria-label' => '',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'url',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'political-corruption',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
            'show_in_rest' => 0,
        ) );
    }

    /**
     * Register post type
     */
    function pc_register_post_type() {
        register_post_type( 'political-corruption', array(
            'labels' => array(
                'name' => 'Political Corruptions',
                'singular_name' => 'Political Corruption',
                'menu_name' => 'Political Corruptions',
                'all_items' => 'All Political Corruptions',
                'edit_item' => 'Edit Political Corruption',
                'view_item' => 'View Political Corruption',
                'view_items' => 'View Political Corruptions',
                'add_new_item' => 'Add New Political Corruption',
                'new_item' => 'New Political Corruption',
                'parent_item_colon' => 'Parent Political Corruption:',
                'search_items' => 'Search Political Corruptions',
                'not_found' => 'No political corruptions found',
                'not_found_in_trash' => 'No political corruptions found in Trash',
                'archives' => 'Political Corruption Archives',
                'attributes' => 'Political Corruption Attributes',
                'insert_into_item' => 'Insert into political corruption',
                'uploaded_to_this_item' => 'Uploaded to this political corruption',
                'filter_items_list' => 'Filter political corruptions list',
                'filter_by_date' => 'Filter political corruptions by date',
                'items_list_navigation' => 'Political Corruptions list navigation',
                'items_list' => 'Political Corruptions list',
                'item_published' => 'Political Corruption published.',
                'item_published_privately' => 'Political Corruption published privately.',
                'item_reverted_to_draft' => 'Political Corruption reverted to draft.',
                'item_scheduled' => 'Political Corruption scheduled.',
                'item_updated' => 'Political Corruption updated.',
                'item_link' => 'Political Corruption Link',
                'item_link_description' => 'A link to a political corruption.',
            ),
            'public' => true,
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-table-col-delete',
            'supports' => array(
                0 => 'title',
                1 => 'editor',
                2 => 'custom-fields',
                3 => 'thumbnail'
            ),
            'delete_with_user' => false,
        ) );
    }

}