<?php

/**
 * API Endpoints file
 */

// create an api endpoint for products
add_action( 'rest_api_init', 'bulk_products_import' );

function bulk_products_import() {

    // add new api endpoint to get products from api and add them to database
    register_rest_route( 'bulk-import/v1', '/sync-products', [
        'methods'  => 'GET',
        'callback' => 'sync_products_api_callback',
    ] );

    register_rest_route( 'bulk-import/v1', '/insert-products-db', [
        'methods'  => 'GET',
        'callback' => 'insert_products_db_api_callback',
    ] );

    register_rest_route( 'bulk-import/v1', '/insert-price-db', [
        'methods'  => 'GET',
        'callback' => 'insert_price_db_api_callback',
    ] );

    register_rest_route( 'bulk-import/v1', '/insert-stock-db', [
        'methods'  => 'GET',
        'callback' => 'insert_stock_db_api_callback',
    ] );

}

function sync_products_api_callback() {
    return products_import_woocommerce();
}

function insert_products_db_api_callback() {
    return insert_products_db();
}

function insert_price_db_api_callback() {
    return insert_price_db();
}

function insert_stock_db_api_callback() {
    return insert_stock_db();
}