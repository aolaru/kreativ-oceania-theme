<?php get_header(); ?>

<main id="primary" class="kreativ-post-index" tabindex="-1">
    <header class="kreativ-post-index-header">
        <p class="kreativ-post-index-kicker"><?php esc_html_e( 'Archive', 'kreativ-core' ); ?></p>
        <?php the_archive_title( '<h1>', '</h1>' ); ?>
        <?php
        $archive_description = get_the_archive_description();

        if ( $archive_description ) :
            ?>
            <div class="kreativ-post-index-intro"><?php echo wp_kses_post( $archive_description ); ?></div>
            <?php
        endif;
        ?>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="kreativ-post-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php kreativ_render_post_card(); ?>
            <?php endwhile; ?>
        </div>
        <nav class="kreativ-post-index-pagination" aria-label="<?php esc_attr_e( 'Archive pagination', 'kreativ-core' ); ?>">
            <?php kreativ_render_pagination(); ?>
        </nav>
    <?php else : ?>
        <div class="kreativ-empty-state">
            <p><?php esc_html_e( 'No posts found in this archive.', 'kreativ-core' ); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
