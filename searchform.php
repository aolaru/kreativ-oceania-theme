<?php
/**
 * The template for displaying search forms in Oceania
 *
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="s"><?php esc_html_e( 'Search for:', 'kreativ' ); ?></label>
    <input id="s" type="search" placeholder="<?php esc_attr_e('Search', 'kreativ'); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">

</form>
