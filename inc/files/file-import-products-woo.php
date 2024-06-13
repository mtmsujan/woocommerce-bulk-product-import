<?php

/**
 * Import Products to WooCommerce template
 */

defined( "ABSPATH" ) || exit( "Direct Access Not Allowed" );

if ( file_exists( BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/vendor/autoload.php' ) ) {
    require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/vendor/autoload.php';
}

use Automattic\WooCommerce\Client;

// Function to insert products into WooCommerce
function products_import_woocommerce() {

    // Get global $wpdb object
    global $wpdb;

    // get table prefix
    $table_prefix = get_option( 'be-table-prefix' ) ?? '';

    // define products table
    $products_table = $wpdb->prefix . $table_prefix . 'sync_products';

    // define price table
    $price_table = $wpdb->prefix . $table_prefix . 'sync_price';

    // define stock table
    $stock_table = $wpdb->prefix . $table_prefix . 'sync_stock';

    // WooCommerce store information
    $website_url     = home_url();
    $consumer_key    = get_option( 'be-client-id' ) ?? '';
    $consumer_secret = get_option( 'be-client-secret' ) ?? '';

    // Retrieve pending products from the database
    // $products = $wpdb->get_results( "SELECT * FROM $products_table WHERE status = 'pending' LIMIT 1" );

    /* foreach ( $products as $product ) {

        // Retrieve product data
        $serial_id = $product->id;
        $sku       = '';
        $title     = '';
        $quantity  = 0;
        $images    = [];

        // Set up the API client with WooCommerce store URL and credentials
        $client = new Client(
            $website_url,
            $consumer_key,
            $consumer_secret,
            [
                'verify_ssl' => false,
                'wp_api'     => true,
                'version'    => 'wc/v3',
                'timeout'    => 400,
            ]
        );

        // Check if the product already exists in WooCommerce
        $args = array(
            'post_type'  => 'product',
            'meta_query' => array(
                array(
                    'key'     => '_sku',
                    'value'   => $sku,
                    'compare' => '=',
                ),
            ),
        );

        // Check if the product already exists
        $existing_products = new WP_Query( $args );

        if ( $existing_products->have_posts() ) {
            $existing_products->the_post();

            // Get product id
            $_product_id = get_the_ID();

            // Update the status of the processed product in your database
            $wpdb->update(
                $products_table,
                [ 'status' => 'completed' ],
                [ 'id' => $serial_id ]
            );

            // Update the variable product if it already exists
            $product_data = [
                'name'        => $title,
                'sku'         => $sku,
                'type'        => 'variable',
                'description' => '',
                'attributes'  => [],
            ];

            // Update product
            $client->put( 'products/' . $_product_id, $product_data );

        } else {
            // Create a new variable product if it does not exist
            $_product_data = [
                'name'        => $title,
                'sku'         => $sku,
                'type'        => 'variable',
                'description' => '',
                'attributes'  => [],
            ];

            // Create the product
            $_products  = $client->post( 'products', $_product_data );
            $product_id = $_products->id;

            // Set product information
            wp_set_object_terms( $product_id, 'variable', 'product_type' );
            update_post_meta( $product_id, '_visibility', 'visible' );

            // Update product meta data in WordPress
            update_post_meta( $product_id, '_stock', $quantity );

            // display out of stock message if stock is 0
            if ( $quantity <= 0 ) {
                update_post_meta( $product_id, '_stock_status', 'outofstock' );
            } else {
                update_post_meta( $product_id, '_stock_status', 'instock' );
            }
            update_post_meta( $product_id, '_manage_stock', 'yes' );

            // Set product image gallery and thumbnail
            foreach ( $images as $image ) {

                // Extract image name
                $image_name = basename( $image );

                // Get WordPress upload directory
                $upload_dir = wp_upload_dir();

                // Download the image from URL and save it to the upload directory
                $image_data = file_get_contents( $image );

                if ( $image_data !== false ) {
                    $image_file = $upload_dir['path'] . '/' . $image_name;
                    file_put_contents( $image_file, $image_data );

                    // Prepare image data to be attached to the product
                    $file_path = $upload_dir['path'] . '/' . $image_name;
                    $file_name = basename( $file_path );

                    // Insert the image as an attachment
                    $attachment = [
                        'post_mime_type' => mime_content_type( $file_path ),
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', $file_name ),
                        'post_content'   => '',
                        'post_status'    => 'inherit',
                    ];

                    $attach_id = wp_insert_attachment( $attachment, $file_path, $product_id );

                    // Add the image to the product gallery
                    $gallery_ids   = get_post_meta( $product_id, '_product_image_gallery', true );
                    $gallery_ids   = explode( ',', $gallery_ids );
                    $gallery_ids[] = $attach_id;
                    update_post_meta( $product_id, '_product_image_gallery', implode( ',', $gallery_ids ) );

                    set_post_thumbnail( $product_id, $attach_id );

                    // if not set post-thumbnail then set a random thumbnail from gallery
                    if ( !has_post_thumbnail( $product_id ) ) {
                        if ( !empty( $gallery_ids ) ) {
                            $random_attach_id = $gallery_ids[array_rand( $gallery_ids )];
                            set_post_thumbnail( $product_id, $random_attach_id );
                        }
                    }

                }
            }

            // Update the status of the processed product in your database
            $wpdb->update(
                $products_table,
                [ 'status' => 'completed' ],
                [ 'id' => $serial_id ]
            );

            return new \WP_REST_Response( [
                'success' => true,
                'message' => 'Product import successfully',
            ] );
        }
    } */
}