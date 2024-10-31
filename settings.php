<?php
function One_Login_Settings() {
    add_menu_page('One-Login', 'One-Login', 'administrator', 'one_login_settings', 'OL_Display_Settings',plugins_url().'/one-login/fav_icon.png');
}

function register_mysettings() {
	register_setting( 'one-login', 'one_login_api_key' );
	register_setting( 'one-login', 'one_login_api_domain' );
}

function OL_Display_Settings() {
?>
<div class="wrap">
  <h2>One-Login Settings</h2>
  <form method="post" action="options.php">
    <?php settings_fields( 'one-login' ); ?>
    <?php do_settings_sections( 'one-login' ); ?>
    <table width="100%" border="0" cellpadding="5" cellspacing="5" class="form-table">
      <tr valign="top">
        <th align="left" scope="row"><h2>Settings for One-Login plugin</h2>
          <ol>
            <li> Login or Register to <a href="http://one-login.info" target="_blank">http://one-login.info</a> </li>
            <li>Add your site</li>
            <li>Make your settings for networks</li>
            <li>Activate network</li>
            <li>Copy / Paste your Api and Domain key here</li>
            <li>Go to widget settings in your Blog (Appearance-&gt;Widget) and move your widget in your sidebar.</li>
          </ol></th>
        <th align="left" scope="row"> <h2>Settings for Email Invest API - Optional</h2>
          <ol>
            <li>Login or Register to <a href="http://emailinvest.com" target="_blank">http://emailinvest.com</a></li>
            <li>Create new group for your contacts</li>
            <li>Create two fields - First Name and Last Name</li>
            <li>Copy group ID,  fields Codes, and your API key from Email Invest to One-Login</li>
          </ol></th>
      </tr>
      <tr valign="top">
        <th colspan="2" align="left" scope="row"><h2>Enter your settings</h2></th>
      </tr>
      <tr valign="top">
        <th width="350" align="left" scope="row">Your website API KEY:</th>
        <td align="left"><input name="one_login_api_key" type="text" value="<?php echo get_option('one_login_api_key'); ?>" size="50" /></td>
      </tr>
      <tr valign="top">
        <th align="left" scope="row">Your website DOMAIN KEY:</th>
        <td align="left"><input name="one_login_api_domain" type="text" value="<?php echo get_option('one_login_api_domain'); ?>" size="50" /></td>
      </tr>
    </table>
    <?php submit_button(); ?>
  </form>
</div>
<?php
}
?>
