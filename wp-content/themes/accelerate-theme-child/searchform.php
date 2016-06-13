<?php 
/* Added this to the theme once I tried to include the search widget in the blog sidebar
*
* @package WordPress
* @subpackage Accelerate Marketing
* @since Accelerate Marketing 1.0
*/
?>

<form action="<?php echo site_url(); ?>" class="search-form" method="get">
     <form>
         <!-- <label for="s" class="screen-reader-text">Search for:</label> --> 
         <input type="text" class="search-box-text" placeholder="Search <?php esc_attr_x( 'Search &hellip;', 'placeholder' ) ?>" value="<?php get_search_query() ?>" name="s" title="<?php esc_attr_x( 'Search for:', 'label' )?>" />
		<input type="submit" id="searchsubmit" class="input-btn" value="<?php esc_attr_x( '', 'submit button' ) ?>" />
     </form>
</form>