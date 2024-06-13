<?php

// TRUNCATE Table
function truncate_table( $table_name ) {
    global $wpdb;
    $wpdb->query( "TRUNCATE TABLE $table_name" );
}

// fetch products from api
function fetch_products_from_api() {

    $curl = curl_init();
    curl_setopt_array( $curl, [
        CURLOPT_URL            => '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => [
            '',
        ],
    ] );

    $response = curl_exec( $curl );

    curl_close( $curl );
    return $response;
}

// insert products to database
function insert_products_db() {

    ob_start();

    /* $api_response = fetch_products_from_api();
    $products     = json_decode( $api_response, true );

    // Insert to database
    global $wpdb;
    $table_prefix   = get_option( 'be-table-prefix' ) ?? '';
    $products_table = $wpdb->prefix . $table_prefix . 'sync_products';
    truncate_table( $products_table );

    foreach ( $products as $product ) {

        // extract products
        $product_data = json_encode( $product );

        $wpdb->insert(
            $products_table,
            [
                'product_number' => '',
                'product_data'   => $product_data,
                'status'         => 'pending',
            ]
        );
    } */

    echo '<h4>Products inserted successfully DB</h4>';

    return ob_get_clean();
}


// +++++++++++++++++++++++++++++++++
// fetch price from api
function fetch_price_from_api() {

    $curl = curl_init();
    curl_setopt_array( $curl, [
        CURLOPT_URL            => '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => [
            '',
        ],
    ] );

    $response = curl_exec( $curl );

    curl_close( $curl );
    return $response;

}

// insert price to database
function insert_price_db() {

    ob_start();

    /* $api_response = fetch_price_from_api();
    $products     = json_decode( $api_response, true );

    // Insert to database
    global $wpdb;
    $table_prefix = get_option( 'be-table-prefix' ) ?? '';
    $price_table  = $wpdb->prefix . $table_prefix . 'sync_price';
    truncate_table( $price_table );

    foreach ( $products as $product ) {

        // extract price

        $wpdb->insert(
            $price_table,
            [
                'product_number' => '',
                'regular_price'  => 0,
                'sale_price'     => 0,
            ]
        );
    } */

    echo '<h4>Prices inserted successfully DB</h4>';

    return ob_get_clean();

}


// +++++++++++++++++++++++++++++++++
// fetch price from api
function fetch_stock_from_api() {

    $curl = curl_init();
    curl_setopt_array( $curl, [
        CURLOPT_URL            => '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => [
            '',
        ],
    ] );

    $response = curl_exec( $curl );

    curl_close( $curl );
    return $response;

}

// insert stock to database
function insert_stock_db() {

    ob_start();

    /* $api_response = fetch_stock_from_api();
    $products     = json_decode( $api_response, true );

    // Insert to database
    global $wpdb;
    $table_prefix = get_option( 'be-table-prefix' ) ?? '';
    $stock_table  = $wpdb->prefix . $table_prefix . 'sync_stock';
    truncate_table( $stock_table );

    foreach ( $products as $product ) {

        // extract stock

        $wpdb->insert(
            $stock_table,
            [
                'product_number' => '',
                'stock'          => 0,
            ]
        );
    } */

    echo '<h4>Stocks inserted successfully DB</h4>';

    return ob_get_clean();

}