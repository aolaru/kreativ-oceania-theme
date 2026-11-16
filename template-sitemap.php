<?php
/*
Template Name: Glossary
*/

get_header();
?>

<main id="primary" class="kreativ-content-shell" tabindex="-1">
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

            <div class="kreativ-glossary-grid">
                <section>
                    <h2><?php esc_html_e( 'Articles in alphabetic order', 'kreativ-core' ); ?></h2>
                    <ul class="page_column_list">
                        <?php wp_get_archives( array( 'type' => 'alpha' ) ); ?>
                    </ul>
                </section>

                <section>
                    <h2><?php esc_html_e( 'Articles by category', 'kreativ-core' ); ?></h2>
                    <ul class="page_column_list">
                        <?php wp_list_categories( array( 'show_count' => true, 'title_li' => '' ) ); ?>
                    </ul>

                    <h2><?php esc_html_e( 'Articles by month', 'kreativ-core' ); ?></h2>
                    <ul class="page_column_list">
                        <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                    </ul>
                </section>

                <section>
                    <h2><?php esc_html_e( 'Articles by tags', 'kreativ-core' ); ?></h2>
                    <?php wp_tag_cloud( array( 'smallest' => 8, 'largest' => 22, 'number' => 100 ) ); ?>
                </section>
            </div>

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
