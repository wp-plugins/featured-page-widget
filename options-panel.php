<div class="wrap">
	<div class="icon32" id="icon-edit-pages"><br/>
	</div>
	<h2>Featured Page Widget &raquo; Default Settings</h2>
	<form method="post" action="options.php">
		<?php 
		if (function_exists('wpmu_create_blog'))
			wp_nonce_field('login_configurator-options');
		else
			wp_nonce_field('update-options');
	?>
		<div class="postbox" style="width:49%; float:left">
			<h3 class="handl" style="margin:0;padding:3px;cursor:default;"><?php _e('Default Content Settings'); ?></h3>
			<div class="table">
				<table class="form-table">
					<tr align="top">
						<th scope="row"><?php _e('Default Content Length'); ?></th>
						<td><input name="featured_page_widget_length" id="featured_page_widget_length" type="text" value="<?php echo $this->defaultLength; ?>" /></td>
					</tr>
				</table>
			</div>
			<h3 class="handl" style="margin:0;padding:3px;cursor:default;">
				<?php _e('Default Link Settings'); ?>
			</h3>
			<div class="table">
				<table class="form-table">
					<tr align="top">
						<th scope="row"><?php _e('Link Text when no link image is present'); ?></th>
						<td><input name="featured_page_widget_link_text" id="featured_page_widget_link_text" type="text" value="<?php print $this->defaultLinkText; ?>" /></td>
					</tr>
					<tr align="top">
						<th scope="row"><?php _e('Link Title to Post'); ?></th>
						<td><input name="featured_page_widget_link_title" id="featured_page_widget_link_title" type="checkbox" value="1" <?php if ($this->defaultLinkTitle) print "checked"; ?> /></td>
					</tr>
					<tr align="top">
						<th scope="row"><?php _e('Default Link Target'); ?></th>
						<td><select name="featured_page_widget_target" id="featured_page_widget_target">
								<option>None</option>
								<option value="_blank" <?php if ($this->defaultTarget == '_blank') echo 'selected'; ?>>New Window</option>
								<option value="_top" <?php if ($this->defaultTarget == '_top') echo 'selected'; ?>>Top Window</option>
							</select></td>
					</tr>
					<tr align="top">
						<th scope="row"><?php _e('Default Link Alignment'); ?></th>
						<td><select name="featured_page_widget_link_align" id="featured_page_widget_link_align">
								<option value="left" <?php if ($this->defaultLinkAlign == 'left') print 'selected'; ?> >Left</option>
								<option value="center" <?php if ($this->defaultLinkAlign == 'center') print 'selected'; ?> >Center</option>
								<option value="right" <?php if ($this->defaultLinkAlign == 'right') print 'selected'; ?> >Right</option>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<h3 class="handl" style="margin:0;padding:3px;cursor:default;">
				<?php _e('Default Image Settings'); ?>
			</h3>
			<div class="table">
				<table class="form-table">
					<tr align="top">
						<th scope="row"><?php _e('Default Image Alignment'); ?></th>
						<td><select name="featured_page_widget_image_align" id="featured_page_widget_image_align">
								<option value="left" <?php if ($this->defaultImageAlign == 'left') print 'selected'; ?> >Left</option>
								<option value="center" <?php if ($this->defaultImageAlign == 'center') print 'selected'; ?> >Center</option>
								<option value="right" <?php if ($this->defaultImageAlign == 'right') print 'selected'; ?> >Right</option>
							</select>
						</td>
					</tr>
					<tr align="top">
						<th scope="row"><?php _e('Link Image Width'); ?></th>
						<td><input name="featured_page_widget_image_width" id="featured_page_widget_image_width" type="text" value="<?php print $this->defaultImageWidth; ?>" /></td>
					</tr>
				</table>
				<input type="hidden" name="custom_page_extension_updated" value="1" />
				<input type="hidden" name="action" value="update" />
				<?php if (function_exists('wpmu_create_blog')) : ?>
				<input type="hidden" name="option_page" value="featured_page_options" />
				<?php  else : ?>
				<input type="hidden" name="page_options" value="featured_page_widget_length,featured_page_widget_link_title,featured_page_widget_link_text,featured_page_widget_target,featured_page_widget_link_align,featured_page_widget_image_align,featured_page_widget_image_width" />
				<?php endif; ?>
				<p class"submit" align="center">
					<input type="submit" name="Submit" value="<?php _e('Save Changes'); ?>" />
				</p>
			</div>
		</div>
	</form>
	<div class="postbox" style="width:49%; float:right">
		<h3 class="handl" style="margin:0; padding:3px;cursor:default;">Featured Page Widget &raquo; About</h3>
		<div style="padding:5px;">
			<p>This page sets the defaults for each widget. Each of these settings can be overridden when you add a featured page to the sidebar.</p>
			<p><span>You are using <strong> <a href="http://wordpress.grandslambert.com/plugins/featured-page-widget.html" target="_blank">Featured Page Widget <?php print $this->showVersion(); ?></a></strong> by <a href="http://grandslambert.com" target="_blank">GrandSlambert</a>.</span> </p>
		</div>
	</div>
	<div class="postbox" style="width:49%; float:right">
		<h3 class="handl" style="margin:0; padding:3px;cursor:default;">Featured Page Widget &raquo; Usage </h3>
		<div style="padding:5px;">
			<p>After setting the defaults, you can add widgets on the <a href="/wp-admin/widgets.php">Appearance &raquo; Widgets</a> screen. Each of the defaults to the left can be overridden for each individual instance. You can also customize how the widget text appears using the following custom fields on the page.</p>
			<ul>
				<li><strong>featured-text</strong>: The plugin will use the text in this custom field in place of an excerpt from the page. Full HTML is supported in this field.</li>
				<li><strong>featured-image</strong>: Add an image to the widget using the alignment set in the widget settings.</li>
				<li><strong>featured-link</strong>: A full URL to an image to use in place of a text link.</li>
			</ul>
		</div>
	</div>
	<div style="clear:both"></div>
	<div class="postbox" style="width:49%; height: 175px; float:left;">
		<h3 class="handl" style="margin:0; padding:3px;cursor:default;">Credits</h3>
		<div style="padding:8px;">
			<p>Thank you for trying the Featured Page Widget plugin - I hope you find it useful. For the latest updates on this plugin, visit the <a href="http://wordpress.grandslambert.com/plugins/featured-page-widget.html" target="_blank">official site</a>. If you have any questions or problems with this plugin, please use our <a href="http://support.grandslambert.com/forum/featured-page-widget" target="_blank">Support Forum</a>. As always, any comments or suggestions for improvements are welcome!</p>
			<p>This plugin is &copy;2009 by <a href="http://grandslambert.com" target="_blank">GrandSlambert, Inc.</a> and is released under the <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GNU General Public License</a>.</p>
		</div>
	</div>
	<div class="postbox" style="width:49%; height: 175px; float:right;">
		<h3 class="handl" style="margin:0; padding:3px;cursor:default;">Donate</h3>
		<div style="padding:8px">
			<p> If you find this plugin useful, please consider supporting our work and the development of  other great <a href="http://wordpress.grandslambert.com/plugins.html" target="_blank">plugins</a>. <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8971824" target="_blank">Donate</a> a few bucks and see what else we can come up with!</p>
			<p style="text-align: center;"><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8971824"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://wordpress.grandslambert.com/wp-content/uploads/2009/07/paypal_btn_donateCC_LG.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
		</div>
	</div>
</div>
