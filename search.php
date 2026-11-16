<?php get_header(); ?>

<main id="primary" class="kreativ-post-index" tabindex="-1">
    <header class="kreativ-post-index-header">
        <p class="kreativ-post-index-kicker"><?php esc_html_e( 'Search', 'kreativ-core' ); ?></p>
        <h1>
            <?php
            if ( have_posts() ) {
                /* translators: %s: search query. */
                printf( esc_html__( 'Results for "%s"', 'kreativ-core' ), esc_html( get_search_query() ) );
            } else {
                /* translators: %s: search query. */
                printf( esc_html__( 'No results for "%s"', 'kreativ-core' ), esc_html( get_search_query() ) );
            }
            ?>
        </h1>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="kreativ-post-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php kreativ_render_post_card(); ?>
            <?php endwhile; ?>
        </div>
        <nav class="kreativ-post-index-pagination" aria-label="<?php esc_attr_e( 'Search results pagination', 'kreativ-core' ); ?>">
            <?php kreativ_render_pagination(); ?>
        </nav>
    <?php else : ?>
        <div class="kreativ-empty-state">
            <p><?php esc_html_e( 'Try another keyword or browse the latest posts.', 'kreativ-core' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
