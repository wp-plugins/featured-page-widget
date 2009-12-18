<div class="wrap">
    <div class="icon32" id="icon-edit-pages"><br/>
    </div>
    <h2><?php _e($this->pluginName); ?> &raquo; <?php _e('Default Settings'); ?></h2>
    <form method="post" action="options.php">
        <?php settings_fields($this->optionsName); ?>
        <div style="width:49%; float:left">

            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;"><?php _e('Default Content Settings'); ?></h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="widget_length"><?php _e('Default Content Length'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[length]" id="widget_length" type="text" value="<?php echo $this->options['length']; ?>" /></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_hide_widget"><?php _e('Hide Widget on Selected Page<br /><small>If only one page is selected</small>'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[hide_widget]" id="widget_hide_widget" type="checkbox" value="1" <?php checked($this->options['hide_widget'],1); ?> /></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Default Link Settings'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="widget_link_text"><?php _e('Link Text when no link image is present'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[link_text]" id="widget_link_text" type="text" value="<?php print $this->options['link_text']; ?>" /></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_link_title"><?php _e('Link Title to Post'); ?></label></th>
                            <td><input name="<?php print $this->optionsName; ?>[link_title]" id="widget_link_title" type="checkbox" value="1" <?php checked($this->options['link_title'],1); ?> /></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_target"><?php _e('Default Link Target'); ?></label></th>
                            <td><select name="<?php print $this->optionsName; ?>[target]" id="widget_target">
                                    <option>None</option>
                                    <option value="_blank" <?php selected($this->options['target'], '_blank'); ?> >New Window</option>
                                    <option value="_top" <?php selected($this->options['target'], '_top'); ?> >Top Window</option>
                                </select></td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_link_align"><?php _e('Default Link Alignment'); ?></label></th>
                            <td><select name="<?php print $this->optionsName; ?>[link_align]" id="widget_link_align">
                                    <option value="left" <?php selected($this->options['link_align'], 'left'); ?> >Left</option>
                                    <option value="center" <?php selected($this->options['link_align'], 'center'); ?> >Center</option>
                                    <option value="right" <?php selected($this->options['link_align'], 'right'); ?> >Right</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="postbox">
                <h3 class="handl" style="margin:0;padding:3px;cursor:default;">
                    <?php _e('Default Image Settings'); ?>
                </h3>
                <div class="table">
                    <table class="form-table">
                        <tr align="top">
                            <th scope="row"><label for="widget_image_align"><?php _e('Default Image Alignment'); ?></label></th>
                            <td><select name="<?php print $this->optionsName; ?>[image_align]" id="widget_image_align">
                                    <option value="left" <?php selected($this->options['image_align'], 'left'); ?> >Left</option>
                                    <option value="center" <?php selected($this->options['image_align'], 'center'); ?> >Center</option>
                                    <option value="right" <?php selected($this->options['image_align'], 'right'); ?> >Right</option>
                                </select>
                            </td>
                        </tr>
                        <tr align="top">
                            <th scope="row"><label for="widget_image_width"><?php _e('Link Image Width'); ?></label></th>
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
                <input type="submit" name="Submit" value="<?php _e('Save Changes'); ?>" />
            </p>
        </div>
    </form>
    <div style="width:49%; float:right">
        <div class="postbox" >
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('About'); ?></h3>
            <div style="padding:5px;">
                <p>This page sets the defaults for each widget. Each of these settings can be overridden when you add a featured page to the sidebar.</p>
                <p><span>You are using <strong> <a href="http://wordpress.grandslambert.com/plugins/featured-page-widget.html" target="_blank">Featured Page Widget <?php print $this->showVersion(); ?></a></strong> by <a href="http://grandslambert.com" target="_blank">GrandSlambert</a>.</span> </p>
            </div>
        </div>
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Usage'); ?></h3>
            <div style="padding:5px;">
                <p>After setting the defaults, you can add widgets on the <a href="<?php print get_option('siteurl'); ?>/wp-admin/widgets.php">Appearance &raquo; Widgets</a> screen. Each of the defaults to the left can be overridden for each individual instance. You can also customize how the widget text appears using the following custom fields on the page.</p>
                <ul>
                    <li><strong>featured-text</strong>: The plugin will use the text in this custom field in place of an excerpt from the page. Full HTML is supported in this field.</li>
                    <li><strong>featured-image</strong>: Add an image to the widget using the alignment set in the widget settings.</li>
                    <li><strong>featured-link</strong>: A full URL to an image to use in place of a text link.</li>
                </ul>
            </div>
        </div>
        <div class="postbox">
            <h3 class="handl" style="margin:0; padding:3px;cursor:default;">
                <?php _e('Recent Contributors'); ?>
            </h3>
            <div style="padding:5px;">
                <p><?php _e('GrandSlambert would like to thank these wonderful contributors to this plugin!'); ?></p>
                <?php $this->contributorList(); ?>
            </div>
        </div>
    </div>
    <div style="clear:both"></div>
    <div class="postbox" style="width:49%; height: 175px; float:left;">
        <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Credits'); ?></h3>
        <div style="padding:8px;">
            <p>Thank you for trying the Featured Page Widget plugin - I hope you find it useful. For the latest updates on this plugin, visit the <a href="http://wordpress.grandslambert.com/plugins/featured-page-widget.html" target="_blank">official site</a>. If you have any questions or problems with this plugin, please use our <a href="http://support.grandslambert.com/forum/featured-page-widget" target="_blank">Support Forum</a>. As always, any comments or suggestions for improvements are welcome!</p>
            <p>This plugin is &copy;2009 by <a href="http://grandslambert.com" target="_blank">GrandSlambert, Inc.</a> and is released under the <a href="http://www.gnu.org/licenses/gpl.html" target="_blank">GNU General Public License</a>.</p>
        </div>
    </div>
    <div class="postbox" style="width:49%; height: 175px; float:right;">
        <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Donate'); ?></h3>
        <div style="padding:8px">
            <p> If you find this plugin useful, please consider supporting our work and the development of  other great <a href="http://wordpress.grandslambert.com/plugins.html" target="_blank">plugins</a>. <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8971824" target="_blank">Donate</a> a few bucks and see what else we can come up with!</p>
            <p style="text-align: center;"><a target="_blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=8971824"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://wordpress.grandslambert.com/wp-content/uploads/2009/07/paypal_btn_donateCC_LG.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
        </div>
    </div>
</div>
