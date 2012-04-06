<?php
/**
 * Plugin name: Simple Download Button Shortcode
 * Plugin URI: http://tech.halulu.org/?p=849
 * Author: <a href="http://www.halulu.tech/">Halulu</a>
 * Author URI: http://tech.halulu.org/?p=849
 * Version: 1.0
 * Description:ショートコードでダウンロードボタンを表示。DLプログラム付きでソースコードや画像もダウンロードできます。Display CSS3 dwonload bottons by simple Shortcode. This plugin comes with a downloading program that let site visitors donwload source code and images, such as html, php and jpeg.
 */

 /*  Copyright 2012 Halulu (email : info@halulu.org)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function disp_downloadButton($atts) {

	// set the download program php
	$plugin_url = plugins_url( basename(dirname(__FILE__))). '/simple-download-button_dl.php'; 
	$html = '';

	$style 			= '';
	$label			= '';
	
	/* Shortcode Settings */
	extract(shortcode_atts(array(
		"file" => '',
		"label" => get_option('label'),
		"btn" => get_option('btn_type')
	), $atts));
	
	if(!$label){ $label = 'DOWNLOAD'; }

	// button style
	switch ($btn) {
		case 1:
			$style = 'class="minimal"';
			break;
		case 2:
			$style = 'class="clean-gray"';
			break;
		case 3:
			$style = 'class="cupid-green"';
			break;
		case 4:
			$style = 'class="cupid-blue"';
			break;
		case 5:
			$style = 'class="blue-pill"';
			break;
		case 6:
			$style = 'class="thoughtbot"';
			break;
		case 7:
			$style = 'class="punch"';
			break;
		case 8:
			$style = 'class="purple-candy"';
			break;
		case 9:
			$style = 'class="shiny-blue"';
			break;
		case 10:
			$style = 'class="skip"';
			break;
		case 11:
			$style = 'class="download-itunes"';
			break;
		default;
			break; // keep it empty.			
	}

	$html .= str_replace(
		array(
			'%style%',
			'%plugin_url%',
			'%file%',
			'%label%',
			'%name%',
			'%download_dir%'
		),
		array(
			$style,
			$plugin_url,
			$file,
			$label,
			$download_dir
		),
		'<div id="simple-download-button"><button %style% onclick="location.href=\'%plugin_url%?file=%file%&download_dir=%download_dir%\'"><b>%label%</b></button></div>'
	);	
	
	return $html;
}

/**
 * Shortcode hock
 */
add_shortcode('dlbt', 'disp_downloadButton');

/**
 * plugin init
 */
function downloadbutton_init() {
 load_plugin_textdomain('sm-downloadbutton', false, basename( dirname( __FILE__ ) ) . '/languages' );  
}
add_action('init', 'downloadbutton_init');

/**
 * add stylesheet for the plugin
 */
function add_downloadbutton_css() {
	$cssPath = plugin_dir_path( __FILE__ ). '/style.css';
	if(file_exists($cssPath)){
	  wp_register_style('style', plugins_url('style.css', __FILE__));
	  wp_register_style('buttons', plugins_url('buttons.css', __FILE__) );
	  wp_enqueue_style('style');
	  wp_enqueue_style('buttons');
	}
}
add_action('wp_print_styles', 'add_downloadbutton_css');


/**
 * Register plugin options page
 */
add_action('admin_init', 'downloadbutton_admin_init' );
add_action('admin_menu', 'downloadbutton_menu');

/* Add stylesheet to the option page. */
function downloadbutton_admin_init() {
   wp_register_style( 'style', plugins_url('style.css', __FILE__) );
   wp_register_style( 'buttons', plugins_url('buttons.css', __FILE__) );
}
function downloadbutton_menu() {
	$page = add_options_page('Plugin Options', 'Download Button', 8, __FILE__, 'downloadbutton_options');
	add_action( 'admin_print_styles-' . $page, 'downloadbutton_admin_styles' );
}
function downloadbutton_admin_styles() {
   wp_enqueue_style( 'style' );
   wp_enqueue_style( 'buttons' );
}

/**
 * plugin options page
 */
function downloadbutton_options() {

?> 
    <div class="wrap">
	<div id="simple-download-button">
        <h2>Simple Download Button Options</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options'); ?>
            <div class="box2">
			<h3><?php _e('Absolute path to download file containing directory', 'sm-downloadbutton') ?></h3>
			<p><?php _e('your-wordpress-home', 'sm-downloadbutton') ?>/wp-content/plugins/simple-download-button/download/</p>
			<p><font color="red"><?php _e('ATTENTION: All user downloads have to be uploaded to the directory indicated above.', 'sm-downloadbutton') ?></font></p>
			<h3><?php _e('Short Code Parameters', 'sm-downloadbutton') ?></h3>
			<ul>
			<li><strong>file</strong> = <?php _e('user download file name with its extention (must given)', 'sm-downloadbutton') ?></li>
			<li><strong>label</strong> = <?php _e('letters to display on the donwload button (optional)', 'sm-downloadbutton') ?></li>
			<li><strong>btn</strong> = <?php _e('button design number 0 to 11 (optional) *see the design option', 'sm-downloadbutton') ?></li>	
			</ul>
			<p>
			<br />[dlbt file=sample.html]
			<br />[dlbt file=sample.html label=<?php _e('SAMPLE', 'sm-downloadbutton') ?>]
			<br />[dlbt file=sample.html label=<?php _e('SAMPLE', 'sm-downloadbutton') ?> btn=10]</p>
			</div>
            <div class="box">
			<h3><?php _e('Label on the button (option)', 'sm-downloadbutton') ?></h3>
			<p><?php _e('letters to display on the donwload button.', 'sm-downloadbutton') ?></p>
			<p><?php _e('Default', 'sm-downloadbutton') ?>: DOWNLOAD</p>
			<input type="text" size="50" name="label" value="<?php echo get_option('label'); ?>" />
			</div>
            <div class="box">
			<h3><?php _e('Design for download button (option)', 'sm-downloadbutton') ?></h3>
			<table>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="0" <?php if (!get_option('btn_type')) : ?>checked<?php endif; ?> /></td>
					<td><?php _e('no style', 'sm-downloadbutton') ?><?php _e(' (default)', 'sm-downloadbutton') ?></td>
					<td><a>DOWNLOAD</a></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="1" <?php if (get_option('btn_type')=='1') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style1', 'sm-downloadbutton') ?></td>
					<td><button class="minimal" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="2" <?php if (get_option('btn_type')=='2') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style2', 'sm-downloadbutton') ?></td>
					<td><button class="clean-gray" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="3" <?php if (get_option('btn_type')=='3') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style3', 'sm-downloadbutton') ?></td>
					<td><button class="cupid-green" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="4" <?php if (get_option('btn_type')=='4') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style4', 'sm-downloadbutton') ?></td>
					<td><button class="cupid-blue" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="5" <?php if (get_option('btn_type')=='5') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style5', 'sm-downloadbutton') ?></td>
					<td><button class="blue-pill" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="6" <?php if (get_option('btn_type')=='6') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style6', 'sm-downloadbutton') ?></td>
					<td><button class="thoughtbot" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="7" <?php if (get_option('btn_type')=='7') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style7', 'sm-downloadbutton') ?></td>
					<td><button class="punch" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="8" <?php if (get_option('btn_type')=='8') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style8', 'sm-downloadbutton') ?></td>
					<td><button class="purple-candy" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="9" <?php if (get_option('btn_type')=='9') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style9', 'sm-downloadbutton') ?></td>
					<td><button class="shiny-blue" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="10" <?php if (get_option('btn_type')=='10') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style10', 'sm-downloadbutton') ?></td>
					<td><button class="skip" onclick="return false;">DOWNLOAD</button></td>
                </tr>
                <tr valign="top">
                    <td><input type="radio" name="btn_type" value="11" <?php if (get_option('btn_type')=='11') : ?>checked<?php endif; ?> /></td>
					<td><?php _e('style11', 'sm-downloadbutton') ?></td>
					<td><button class="download-itunes" onclick="return false;">DOWNLOAD</button></td>
                </tr>
			</table>
			<p>*All buttons are designed & shared by <a href="http://hellohappy.org/css3-buttons/" target="_blank">Chad Mazzola</a>.</p>
			</div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="path,label,btn_type" />
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
            </p>
        </form>
    </div>
    </div>
<p><?php _e('To send feedback, requests or find more about the plugin, visit <a href="tech.halulu.org" target="_blank">here</a> or feel free to <a href="mailto:info@halulu.org">email</a> me. Thank you!', 'sm-downloadbutton') ?><p>
<?php
}
?>
