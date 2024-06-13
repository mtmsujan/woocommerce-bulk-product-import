<?php
// Get the table prefix option from the WordPress options
$table_prefix = get_option( 'be-table-prefix' ) ?? '';
?>

<div id="db-tables" class="common-shadow">
    <!-- Form to set the table prefix -->
    <form action="" method="post">
        <div class="d-flex align-items-center">
            <!-- Label and input for Table Prefix -->
            <label class="form-label" for="table-prefix">
                <?php esc_html_e( 'Table Prefix', 'bulk-product-import' ); ?>
            </label>
            <input type="text" class="form-control w-50 ms-5" name="table-prefix" id="table-prefix"
                placeholder="<?php esc_attr_e( 'Enter Table Prefix', 'bulk-product-import' ); ?>"
                value="<?php echo esc_attr( $table_prefix ); ?>">
        </div>
        <!-- Submit button to save table prefix -->
        <input type="submit" class="btn btn-primary mt-3" id="save-table-prefix"
            value="<?php esc_attr_e( 'Save', 'bulk-product-import' ); ?>">
    </form>
</div>