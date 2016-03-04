<?php
/**
 * Displays the "System Info" tab.
 *
 * @link       http://expandedfronts.com/better-search-replace/
 * @since      1.1
 *
 * @package    Better_Search_Replace
 * @subpackage Better_Search_Replace/templates
 */

// Prevent direct access.
if ( ! defined( 'BSR_PATH' ) ) exit;

?>

<h3><?php _e( 'Help & Troubleshooting', 'better-search-replace' ); ?></h3>

<p><?php printf( __( 'Found a bug or have a feature request? Please submit an issue on <a href="%s">GitHub</a>!', 'better-search-replace' ), 'https://github.com/expandedfronts/better-search-replace' ); ?></p>

<textarea readonly="readonly" onclick="this.focus(); this.select()" style="width:750px;height:500px;font-family:Menlo,Monaco,monospace; margin-top: 15px;" name='bsr-sysinfo'><?php echo BSR_Compatibility::get_sysinfo(); ?></textarea>

<p class="submit">
	<input type="hidden" name="action" value="bsr_download_sysinfo" />
	<?php submit_button( __( 'Download System Info', 'better-search-replace' ), 'primary', 'bsr-download-sysinfo', false ); ?>
</p>
