<?php get_header(); ?>

<main id="primary" class="kreativ-content-shell" tabindex="-1">
    <section class="kreativ-empty-state" aria-labelledby="not-found-title">
        <p class="kreativ-post-index-kicker"><?php esc_html_e( '404', 'kreativ-core' ); ?></p>
        <h1 id="not-found-title"><?php esc_html_e( 'Nothing found', 'kreativ-core' ); ?></h1>
        <p><?php esc_html_e( 'The content you are looking for does not exist or may have been moved.', 'kreativ-core' ); ?></p>
        <?php get_search_form(); ?>
        <p><a class="kreativ-post-card-link" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return to the home page', 'kreativ-core' ); ?></a></p>
    </section>
</main>

<?php get_footer(); ?>
