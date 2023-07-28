<?php
// Task 1:Write a function that will redirect 
// the user away from the site if their IP address starts with 77.29. Use WordPress native hooks and APIs to handle this

function redirect_with_ip()
{

    $user_ip = $_SERVER['REMOTE_ADDR'];


    if (strpos($user_ip, '77.29.') === 0) {

        wp_redirect('https://example.com/away-page/');
        exit();
    }
}
add_action('init', 'redirect_with_ip');

//Task2: register post type
require_once get_template_directory() . '/includes/custom-post-type.php';


//Task 3 


// Custom AJAX endpoint to fetch projects
function custom_ajax_project_endpoint()
{
    // Check if the user is logged in
    $is_user_logged_in = is_user_logged_in();


    $query_args = array(
        'post_type'      => 'projects',
        'posts_per_page' => $is_user_logged_in ? 6 : 3,
        'tax_query'      => array(
            array(
                'taxonomy' => 'project_type',
                'field'    => 'slug',
                'terms'    => 'architecture',
            ),
        ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $projects = get_posts($query_args);

    // Prepare the response data
    $response_data = array();
    foreach ($projects as $project) {
        $response_data[] = array(
            'id'    => $project->ID,
            'title' => $project->post_title,
            'link'  => get_permalink($project->ID),
        );
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode(array('success' => true, 'data' => $response_data));
    exit();
}

add_action('wp_ajax_custom_project_endpoint', 'custom_ajax_project_endpoint');
add_action('wp_ajax_nopriv_custom_project_endpoint', 'custom_ajax_project_endpoint');

// Enqueue your JavaScript file with AJAX URL
function custom_enqueue_scripts()
{
    wp_enqueue_script('jquery');
    // wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '1.0', true);
    wp_localize_script('custom-script', 'custom_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts');


//Task 4

function hs_give_me_coffee()
{
    $api_url = 'https://api.example.com/coffee';
    $response = wp_remote_get($api_url);
    if (is_wp_error($response)) {
        return 'Failed to fetch coffee link.';
    }
    // Parse the JSON response
    $coffee_data = json_decode(wp_remote_retrieve_body($response), true);

    if (empty($coffee_data) || !isset($coffee_data['link'])) {
        return 'Invalid coffee data received.';
    }
    // Return the direct link to a cup of coffee
    return $coffee_data['link'];
}
add_shortcode('coffee_give_link', 'hs_give_me_coffee');



//Task 5

// Function to fetch quotes from the Kanye West API
function kanye_quotes()
{
    $num_quotes = 5;
    $api_url = 'https://api.kanye.rest/';

    $quotes = array();

    for ($i = 0; $i < $num_quotes; $i++) {
        $response = wp_remote_get($api_url);

        if (is_wp_error($response)) {
            continue;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);

        if (isset($data['quote'])) {
            $quotes[] = $data['quote'];
        }
    }

    return $quotes;
}

// Function to display the Kanye West quotes using a shortcode
function display_kanye_quotes_shortcode()
{
    $quotes = kanye_quotes();

    if (empty($quotes)) {
        return 'Failed to fetch quotes.';
    }

    $output = '<h2>Kanye West Quotes</h2>';
    $output .= '<ul>';

    foreach ($quotes as $quote) {
        $output .= '<li>"' . $quote . '"</li>';
    }

    $output .= '</ul>';

    return $output;
}
add_shortcode('kanye_quotes', 'display_kanye_quotes_shortcode');
