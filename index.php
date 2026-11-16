<?php get_header(); ?>

<main id="primary" class="kreativ-post-index" tabindex="-1">
    <header class="kreativ-post-index-header">
        <p class="kreativ-post-index-kicker"><?php esc_html_e( 'Journal', 'kreativ-core' ); ?></p>
        <h1><?php echo esc_html( kreativ_get_posts_index_heading() ); ?></h1>
        <?php if ( kreativ_get_archive_intro() ) : ?>
            <p class="kreativ-post-index-intro"><?php echo esc_html( kreativ_get_archive_intro() ); ?></p>
        <?php endif; ?>
    </header>

    <div class="kreativ-post-list">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php kreativ_render_post_card(); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="kreativ-post-card">
                <h2><?php esc_html_e( 'Post not found', 'kreativ-core' ); ?></h2>
                <p><?php esc_html_e( 'The post you are looking for does not exist or has been moved. Please use the search form to find what you are looking for.', 'kreativ-core' ); ?></p>
            </div>
        <?php endif; ?>

        <div class="kreativ-post-index-pagination">
            <?php the_posts_pagination(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
