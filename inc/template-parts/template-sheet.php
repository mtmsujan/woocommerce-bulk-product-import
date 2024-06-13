<?php

if ( file_exists( BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/vendor/autoload.php' ) ) {
    require_once BULK_PRODUCT_IMPORT_PLUGIN_PATH . '/vendor/autoload.php';
}

class Sheet_Import {
    private $client;
    private $service;
    private $spreadsheetID;
    private $sheetRange;
    private $credentialsPath = __DIR__ . '/credentials.json';

    public function __construct() {
        $this->client = new Google\Client();
        $this->client->setApplicationName( "goglesheetapi" );
        $this->client->setScopes( [ \Google_Service_Sheets::SPREADSHEETS ] );
        $this->client->setAccessToken( 'offline' );
        $this->client->setAuthConfig( $this->credentialsPath );
        $this->service       = new Google_Service_Sheets( $this->client );
        $this->spreadsheetID = '1igZQ5L-FlY7FTzqMpxPOzbscWLYo15hLW5s9YHwPRD4';
        $this->sheetRange    = 'products!A:G';
    }

    public function fetchProductsFromSheets() {
        $response = $this->service->spreadsheets_values->get( $this->spreadsheetID, $this->sheetRange );
        return $response->getValues();
    }

    public function insertProductsToDatabase() {

        // fetch products from sheet
        $products = $this->fetchProductsFromSheets();

        global $wpdb;
        $table_prefix   = get_option( 'be-table-prefix' ) ?? '';
        $products_table = $wpdb->prefix . $table_prefix . 'sync_products';
        // $wpdb->query( "TRUNCATE TABLE $products_table" );

        foreach ( $products as $product ) {

            // extract products
            $product_data = json_encode( $product );

            echo '<pre>';
            print_r( $product_data );
            echo '</pre>';

            /* $wpdb->insert(
                $products_table,
                [
                    'product_number' => '',
                    'product_data'   => $product_data,
                    'status'         => 'pending',
                ]
            ); */
        }
    }
}
?>


<form action="" method="post">
    <input type="submit" name="fetch_products" class="btn btn-primary" id="fetch_products" value="Fetch Products">
    <input type="submit" name="insert_products" class="btn btn-primary" id="insert_products" value="Insert Products">
</form>

<?php

if ( isset( $_POST['fetch_products'] ) ) {

    // instance of class
    $sheetProducts = new Sheet_Import();

    // fetch products
    $products = $sheetProducts->fetchProductsFromSheets();

    echo '<pre>';
    print_r( $products );
    echo '</pre>';
}

if ( isset( $_POST['insert_products'] ) ) {
    $sheetProducts = new Sheet_Import();
    $sheetProducts->insertProductsToDatabase();
}