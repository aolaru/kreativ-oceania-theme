<?php
/*
Template Name: Links
*/

get_header();
?>

<main id="primary" class="kreativ-content-shell">
    <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'kreativ-entry kreativ-page' ); ?>>
            <header class="kreativ-entry-header">
                <p class="kreativ-post-index-kicker"><?php esc_html_e( 'Page', 'kreativ-core' ); ?></p>
                <h1><?php echo esc_html( get_the_title() ); ?></h1>
            </header>

            <div class="kreativ-entry-content">
                <?php the_content(); ?>
                <?php
                wp_link_pages(
                    array(
                        'before' => '<p class="page-links">' . esc_html__( 'Pages:', 'kreativ-core' ),
                        'after'  => '</p>',
                    )
                );
                ?>
            </div>

            <section class="kreativ-link-list" aria-labelledby="kreativ-bookmarks-title">
                <h2 id="kreativ-bookmarks-title"><?php esc_html_e( 'Bookmarks', 'kreativ-core' ); ?></h2>
                <ul>
                    <?php wp_list_bookmarks(); ?>
                </ul>
            </section>

            <footer class="kreativ-entry-footer">
                <?php edit_post_link( esc_html__( 'Edit', 'kreativ-core' ), '<p>', '</p>' ); ?>
            </footer>
        </article>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
