<?php
/*
Plugin Name: SixGroups Live Community
Plugin URI: http://notizBlog.org
Description: <a href="http://sixgroups.com">sixgroups' livecommunity</a> plugin for wordpress.
Version: 0.2.1
Author: Matthias Pfefferle
Author URI: http://pfefferle.org/
*/

add_action( 'admin_menu', array('SixgroupsLiveCommunity', 'adminMenu'));
add_action( 'wp_footer', array('SixgroupsLiveCommunity', 'showCommunity' ));

if (is_plugin_page()) {
  $sglc = new SixgroupsLiveCommunity();
  $sglc->optionsPage();
} else {

class SixgroupsLiveCommunity {
	function showCommunity() {
    echo stripslashes(get_option('livecommunity_code'));
	}

	function adminMenu() {
	  add_options_page(
	    __('Sixgroups Livecommunity Options'),
	    __('Sixgroups Livecommunity'), 5, __FILE__);
  }

  function optionsPage() {
	  if (isset($_POST['Submit'])) {
	    update_option('livecommunity_code', $_POST['livecommunity_code']);
?>
<div class="updated">
  <p><strong><?php _e('Options saved.') ?></strong></p>
</div>
<?php
    }
?>

<div class="wrap">
<h2><?php echo __('Sixgroups Livecommunity-Options'); ?></h2>

<p><?php echo __('Copy your <a href="http://sixgroups.com">sixgroups</a> <a href="http://sixgroups.com/about-us/">livecommunity-code</a>* into the textbox and press "Update Options"... thats it!'); ?></p>

<form name="livecommunity" method="post" action="">
  <input type="hidden" name="action" value="update" />

  <textarea name="livecommunity_code" id="livecommunity_code" cols="100" rows="10"><?php echo stripslashes(get_option('livecommunity_code')); ?></textarea>

  <p class="submit">
    <input type="submit" name="Submit" value="<?php _e('Update Options') ?> &raquo;" />
  </p>
</form>

<p><?php echo __('* the code looks like:') ?></p>
<code><pre>&lt;script type="text/javascript" src="http://<strong>community-name</strong>.sixgroups.com/widgets/api/json/?v=0.2">&lt;/script&gt;
&lt;div id="sgBarContainer">
&lt;span style="font: 9px Arial, sans-serif; color: #ccc; ">
Livecommunity powered by &lt;a style="font: 9px Arial, sans-serif; color: #ccc; "
href="http://sixgroups.com" title="eigene Community erstellen"&gt;six groups&lt;/a&gt;&lt;/span&gt;
&lt;script type="text/javascript"&gt;if(sg){sg.addWidget({"type": "sgBar"});}&lt;/script&gt;
&lt;/div&gt;</pre></code>
</div>
<?php
	}
}

}
?>
