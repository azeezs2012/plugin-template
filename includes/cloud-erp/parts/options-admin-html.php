<?php
?>
<div class="main-wrapper">
    <h1>Cloud Erp Sync for E-Commerce</h1>
    <?php if(CloudErpAdmin::verified()) : ?>
    <div class="row verify">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">API endpoint url</th>
                <td>
                    <input type="text" name="cloud_erp_for_ecommerce[api_url]" value="<?php echo $options['api_url']; ?>"/>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">WP Token</th>
                <td>
                    <input type="text" name="cloud_erp_for_ecommerce[wp_token]" value="<?php echo $options['wp_token']; ?>"/>
                </td>
            </tr>
        </table>
        <input type="text" name="verify" id="verify" class="button button-primary" value="Verify">
    </div>
    <?php else: ?>
    <div class="row defaults">
        <?php echo 'defaults'; ?>
    </div>
    <?php endif; ?>
</div>


<form method="post" action="<?php echo admin_url( 'options.php' ); ?>">
<?php settings_fields( 'cloud_erp_for_ecommerce' ); ?>

    <input type="submit" name="submit" id="submit" class="button button-primary"
           value="<?php _e( 'Save', 'cloud_erp_sync' ); ?>"/>
</form>
