<?php
/**
 * The template for displaying search forms in Kreativ Core
 *
 */

$search_field_id = wp_unique_id( 'kreativ-search-' );
?>
<form method="get" class="kreativ-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="<?php echo esc_attr( $search_field_id ); ?>"><?php esc_html_e( 'Search for:', 'kreativ-core' ); ?></label>
    <input id="<?php echo esc_attr( $search_field_id ); ?>" type="search" placeholder="<?php esc_attr_e( 'Search', 'kreativ-core' ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
    <button class="kreativ-search-submit" type="submit"><?php esc_html_e( 'Search', 'kreativ-core' ); ?></button>
</form>
