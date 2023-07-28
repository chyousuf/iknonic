<?php
// Register Custom Post Type
function custom_post_type_projects()
{
    $labels = array(
        'name'                  => 'Projects',
        'singular_name'         => 'Project',
        'menu_name'             => 'Projects',
        'name_admin_bar'        => 'Projects',
        'archives'              => 'Project Archives',
        'attributes'            => 'Project Attributes',
        'parent_item_colon'     => 'Parent Project:',
        'all_items'             => 'All Projects',
        'add_new_item'          => 'Add New Project',
        'add_new'               => 'Add New',
        'new_item'              => 'New Project',
        'edit_item'             => 'Edit Project',
        'update_item'           => 'Update Project',
        'view_item'             => 'View Project',
        'view_items'            => 'View Projects',
        'search_items'          => 'Search Project',
        'not_found'             => 'Project not found',
        'not_found_in_trash'    => 'Project not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into Project',
        'uploaded_to_this_item' => 'Uploaded to this Project',
        'items_list'            => 'Projects list',
        'items_list_navigation' => 'Projects list navigation',
        'filter_items_list'     => 'Filter Projects list',
    );
    $args = array(
        'label'                 => 'Project',
        'description'           => 'Custom post type for projects',
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies'            => array('project_type'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-clipboard',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );
    register_post_type('projects', $args);
}
add_action('init', 'custom_post_type_projects', 0);

// Register Custom Taxonomy
function custom_taxonomy_project_type()
{
    $labels = array(
        'name'                       => 'Project Types',
        'singular_name'              => 'Project Type',
        'menu_name'                  => 'Project Types',
        'all_items'                  => 'All Project Types',
        'parent_item'                => 'Parent Project Type',
        'parent_item_colon'          => 'Parent Project Type:',
        'new_item_name'              => 'New Project Type Name',
        'add_new_item'               => 'Add New Project Type',
        'edit_item'                  => 'Edit Project Type',
        'update_item'                => 'Update Project Type',
        'view_item'                  => 'View Project Type',
        'separate_items_with_commas' => 'Separate Project types with commas',
        'add_or_remove_items'        => 'Add or remove Project types',
        'choose_from_most_used'      => 'Choose from the most used',
        'popular_items'              => 'Popular Project Types',
        'search_items'               => 'Search Project Types',
        'not_found'                  => 'Project Type Not Found',
        'no_terms'                   => 'No Project types',
        'items_list'                 => 'Project types list',
        'items_list_navigation'      => 'Project types list navigation',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('project_type', array('projects'), $args);
}
add_action('init', 'custom_taxonomy_project_type', 0);
