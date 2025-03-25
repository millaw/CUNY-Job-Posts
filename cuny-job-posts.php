<?php
/**
 * CUNY Job Posts
 *
 * @package       CUNY Job Posts
 * @author        Milla Wynn
 * @license       GPLv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   CUNY Job Posts
 * Plugin URI:    https://github.com/millaw/cuny-job-posts
 * Description:   Job postings for CUNY colleges. Use the shortcode [cunyc_job_posts college_url="https://cuny.jobs/<college>/new-jobs/feed/json"] to display current job openings from any CUNY college.
 * Version:       1.0.0
 * Author:        Milla Wynn
 * Author URI:    https://github.com/millaw
 * License:       GPLv2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Register and enqueue necessary JavaScript and CSS
function cunyc_job_posts_enqueue_assets() {
    wp_register_script( 'cunyc_job_posts_script', plugins_url( '/js/cuny-jp-script.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
    wp_register_style( 'cunyc_job_posts_style', plugins_url( '/css/cuny-jp-style.css', __FILE__ ), false, '1.0.0', 'all' );

    wp_enqueue_script( 'cunyc_job_posts_script' );
    wp_enqueue_style( 'cunyc_job_posts_style' );
}
add_action( 'wp_enqueue_scripts', 'cunyc_job_posts_enqueue_assets' );

// Shortcode function to display job posts
function cunyc_job_posts_shortcode( $atts ) {
    // Set default college URL
    $default_college_url = 'https://cuny.jobs/laguardia-community-college/new-jobs/feed/json';

    // Parse attributes passed to the shortcode, with default for college URL
    $atts = shortcode_atts( array(
        'college_url' => $default_college_url,
    ), $atts, 'cunyc_job_posts' );

    // Sanitize the URL to ensure it's valid and safe
    $college_url = esc_url_raw( $atts['college_url'] );

    // Get the job posts from the JSON feed
    $job_posts = cunyc_job_posts_get_feed( $college_url );

    // Return output
    return $job_posts;
}
add_shortcode( 'cunyc_job_posts', 'cunyc_job_posts_shortcode' );

// Fetch the job posts from the provided URL
function cunyc_job_posts_get_feed( $url ) {
    // Get the JSON data from the feed
    $response = wp_remote_get( $url );

    // Check if the request was successful
    if ( is_wp_error( $response ) ) {
        return '<p>Error fetching job postings. Please try again later.</p>';
    }

    // Get the body of the response
    $json = wp_remote_retrieve_body( $response );

    // Decode JSON
    $data = json_decode( $json, true );

    if ( empty( $data ) ) {
        return '<p>No job postings at this moment. Please come back and check later.</p>';
    }

    // Start generating the HTML output
    $output = '';
    foreach ( $data as $job ) {
        $job_title = esc_html( $job['title'] );
        $job_url = esc_url( $job['url'] );
        $job_date = esc_html( date( 'F d, Y', strtotime( $job['date_new'] ) ) );
        $job_id = esc_html( $job['reqid'] );
        $job_description = esc_html( $job['description'] );

        // Generate HTML for each job post
        $output .= '<div class="job-card">';
        $output .= '<h3><a href="' . $job_url . '" target="_blank">' . $job_title . '</a></h3>';
        $output .= '<p><strong>Date Posted:</strong> ' . $job_date . '</p>';
        $output .= '<p><strong>Job ID:</strong> ' . $job_id . '</p>';
        $output .= '<p><strong>POSITION DETAILS:</strong></p>';
        $output .= '<p>' . $job_description . '</p>';
        $output .= '<p><a href="https://home.cunyfirst.cuny.edu/psp/cnyihprd/EMPLOYEE/HRMS/c/HRS_HRAM_EMP_FL.HRS_CG_SEARCH_FL.GBL?Page=HRS_APP_JBPST_FL&Action=U&FOCUS=Employee&SiteId=1&PostingSeq=1&JobOpeningId=' . $job_id . '" target="_blank">Current CUNY Employees</a> | ';
        $output .= '<a href="https://hrsa.cunyfirst.cuny.edu/psp/erecruit/EMPLOYEE/HRMSCG/c/HRS_HRAM_FL.HRS_CG_SEARCH_FL.GBL?Page=HRS_APP_JBPST_FL&Action=U&FOCUS=Applicant&SiteId=1&PostingSeq=1&JobOpeningId=' . $job_id . '" target="_blank">External Applicants</a></p>';
        $output .= '</div>';
    }

    return $output;
}
