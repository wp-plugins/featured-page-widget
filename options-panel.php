<div class="wrap">
    <div class="icon32" id="icon-edit-pages"><br/>
    </div>
    <h2><?php print $this->pluginName; ?> &raquo; <?php _e('Default Settings', 'featured-page-widget'); ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields($this->optionsName); ?>
        <div style="width:49%; float:left">

            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;"><?php _e('Default Content Settings', 'featured-page-widget'); ?></h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="widget_length"><?php _e('Default Content Length', 'featured-page-widget'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[length]" id="widget_length" type="text" value="<?php echo $this->options['length']; ?>" /></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="allowed_tags"><?php _e('Allowed Tags', 'featured-page-widget'); ?></label></th>
                            <td>
                                <input name="<?php print $this->optionsName; ?>[allowed-tags]" id="allowed_tags" type="text" value="<?php echo $this->options['allowed-tags']; ?>" /><br />
                                <small><?php _e('A comma seperated list of tags to allow', 'featured-page-widget'); ?></small>
                            </td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_hide_widget"><?php _e('Hide on Selected Page', 'featured-page-widget'); ?></label></th>
                            <td>
                                <input name="<?php print $this->optionsName; ?>[hide_widget]" id="widget_hide_widget" type="checkbox" value="1" <?php checked($this->options['hide_widget'],1); ?> /><br />
                                <small><?php _e('If only one page is selected, otherwise a different random page is displayd', 'featured-page-widget'); ?></small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Default Link Settings', 'featured-page-widget'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="widget_link_text"><?php _e('Link Text when no link image is present', 'featured-page-widget'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[link_text]" id="widget_link_text" type="text" value="<?php print $this->options['link_text']; ?>" /></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_link_title"><?php _e('Link Title to Post', 'featured-page-widget'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[link_title]" id="widget_link_title" type="checkbox" value="1" <?php checked($this->options['link_title'],1); ?> /></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_target"><?php _e('Default Link Target', 'featured-page-widget'); ?></label></th>
                            <td><select name="<?php print $this->optionsName; ?>[target]" id="widget_target">
                                    <option><?php _e('No Link target', 'featured-page-widget'); ?></option>
                                    <option value="_blank" <?php selected($this->options['target'], '_blank'); ?> ><?php _e('New Window', 'featured-page-widget'); ?></option>
                                    <option value="_top" <?php selected($this->options['target'], '_top'); ?> ><?php _e('Top Window', 'featured-page-widget'); ?></option>
                                </select></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_link_align"><?php _e('Default Link Alignment', 'featured-page-widget'); ?></label></th>
                            <td><select name="<?php print $this->optionsName; ?>[link_align]" id="widget_link_align">
                                    <option value="none" <?php selected($this->options['link_align'], 'none'); ?> ><?php _e('No Link Alignment', 'featured-page-widget'); ?></option>
                                    <option value="left" <?php selected($this->options['link_align'], 'left'); ?> ><?php _e('Align Left', 'featured-page-widget'); ?></option>
                                    <option value="center" <?php selected($this->options['link_align'], 'center'); ?> ><?php _e('Align Centered', 'featured-page-widget'); ?></option>
                                    <option value="right" <?php selected($this->options['link_align'], 'right'); ?> ><?php _e('Align Right', 'featured-page-widget'); ?></option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Default Image Settings', 'featured-page-widget'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="widget_image_align"><?php _e('Default Image Alignment', 'featured-page-widget'); ?></label></th>
                            <td><select name="<?php print $this->optionsName; ?>[image_align]" id="widget_image_align">
                                    <option value="none" <?php selected($this->options['image_align'], 'none'); ?> ><?php _e('No Image Alignment', 'featured-page-widget'); ?></option>
                                    <option value="left" <?php selected($this->options['image_align'], 'left'); ?> ><?php _e('Align Left', 'featured-page-widget'); ?></option>
                                    <option value="center" <?php selected($this->options['image_align'], 'center'); ?> ><?php _e('Align Centered', 'featured-page-widget'); ?></option>
                                    <option value="right" <?php selected($this->options['image_align'], 'right'); ?> ><?php _e('Align Right', 'featured-page-widget'); ?></option>
                                </select>
                            </td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_image_width"><?php _e('Link Image Width', 'featured-page-widget'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[image_width]" id="widget_image_width" type="text" value="<?php print $this->options['image_width']; ?>" /></td>
                        </tr>
                    </table>
                </div>
            </div>
            <input type="hidden" name="custom_page_extension_updated" value="1" />
            <input type="hidden" name="action" value="update" />
            <?php if (function_exists('wpmu_create_blog')) : ?>
            <input type="hidden" name="option_page" value="<?php print $this->optionsName; ?>" />
            <?php  else : ?>
            <input type="hidden" name="page_options" value="<?php print $this->optionsName; ?>" />
            <?php endif; ?>
            <p class="submit" align="center">
                <input type="submit" name="Submit" value="<?php _e('Save Changes', 'featured-page-widget'); ?>" />
            </p>
        </div>
    </form>
    <div style="width:49%; float:right">
        <div class="postbox" >
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('About', 'featured-page-widget'); ?></h3>
            <div style="padding:5px;">
                <p><?php _e('This page sets the defaults for each widget. Each of these settings can be overridden when you add a featured page to the sidebar.', 'featured-page-widget'); ?></p>
                <p><?php _e('You are using', 'featured-page-widget'); ?> <strong> <a href="http://wordpress.grandslambert.com/plugins/featured-page-widget.html" target="_blank"><?php print $this->pluginName; ?> <?php print $this->showVersion(); ?></a></strong> by <a href="http://grandslambert.com" target="_blank">GrandSlambert</a>.</p>
            </div>
        </div>
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Usage', 'featured-page-widget'); ?></h3>
            <div style="padding:5px;">
                <?php
                /* translators: This is displayed in the "Usage" on the settings page. The parameter will be replaced with a link to the Appearance > Widgets page. */
                printf(__('<p>After setting the defaults, you can add widgets on the %1$s screen. Each of the defaults to the left can be overridden for each individual instance. You can also customize how the widget text appears using the following custom fields on the page.</p>', 'featured-page-widget'), '<a href="' . get_option('siteurl') . '/wp-admin/widgets.php">' . __('Appearance &raquo; Widgets', 'featured-page-widget') . '</a>');
                ?>
                <ul>
                    <li><?php _e('<strong>featured-text</strong>: The plugin will use the text in this custom field in place of an excerpt from the page. Full HTML is supported in this field.', 'featured-page-widget'); ?></li>
                    <li><?php _e('<strong>featured-image</strong>: Add an image to the widget using the alignment set in the widget settings.', 'featured-page-widget'); ?></li>
                    <li><?php _e('<strong>featured-link</strong>: A full URL to an image to use in place of a text link.', 'featured-page-widget'); ?></li>
                </ul>
            </div>
        </div>
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;">
                <?php _e('Recent Contributors', 'featured-page-widget'); ?>
            </h3>
            <div style="padding:5px;">
                <p><?php _e('GrandSlambert would like to thank these wonderful contributors to this plugin!', 'featured-page-widget'); ?></p>
                <?php $this->contributorList(); ?>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="postbox" style="width:49%; height: 175px; float:left;">
        <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Credits', 'featured-page-widget'); ?></h3>
        <div style="padding:8px;">
            <p>
                <?php
                /* translators: This is displayed in the credits. Parameters are plugin name, link to plugin page, link to support page. */
                printf(__('Thank you for trying the %1$s plugin - I hope you find it useful. For the latest updates on this plugin, vist the %2$s. If you have problems with this plugin, please use our %3$s', 'featured-page-widget'),
                    $this->pluginName,
                    '<a href="http://wordpress.grandslambert.com/plugins/featured-page-widget.html" target="_blank">' . __('official site', 'featured-page-widget') . '</a>',
                    '<a href="http://support.grandslambert.com/forum/featured-page-widget" target="_blank">' . __('Support Forum', 'featured-page-widget') . '</a>'
                ); ?>
            </p>
            <p>
                <?php
                /* translators: Displayed under the credits. Parameters are the copyright dates, link to author, link to license. */
                printf(__('This plugin is &copy; %1$s by %2$s and is released under the %3$s', 'featured-page-widget'),
                    '2009-' . date("Y"),
                    '<a href="http://grandslambert.com" target="_blank">GrandSlambert, Inc.</a>',
                    '<a href="http://www.gnu.org/licenses/gpl.html" target="_blank">' . __('GNU General Public License', 'featured-page-widget') . '</a>'
                ); ?>
            </p>        </div>
    </div>
    <div class="postbox" style="width:49%; height: 175px; float:right;">
        <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Donate', 'featured-page-widget'); ?></h3>
        <div style="padding:8px">
            <p>
                <?php
                /* translators: This is the text in the donate box. Parameter is replaced with link to the plugins page of the authors site. */
                printf(__('If you find this plugin useful, please consider supporting this and our other great %1$s.', 'featured-page-widget'), '<a href="http://wordpress.grandslambert.com/plugins.html" target="_blank">' . __('plugins', 'featured-page-widget') . '</a>');
                ?>
                <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8971824" target="_blank"><?php _e('Donate a few bucks!', 'featured-page-widget'); ?></a>
            </p>
            <p style="text-align: center;"><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8971824"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://wordpress.grandslambert.com/wp-content/uploads/2009/07/paypal_btn_donateCC_LG.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
        </div>
    </div>
</div>
