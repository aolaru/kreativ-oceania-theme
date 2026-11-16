<?php get_header(); ?>

<?php
$author = get_queried_object();
$name   = $author instanceof WP_User ? $author->display_name : get_the_author_meta( 'display_name', get_query_var( 'author' ) );
?>

<main id="primary" class="kreativ-post-index" tabindex="-1">
    <header class="kreativ-post-index-header">
        <p class="kreativ-post-index-kicker"><?php esc_html_e( 'Author', 'kreativ-core' ); ?></p>
        <h1>
            <?php /* translators: %s: author display name. */ ?>
            <?php printf( esc_html__( 'Posts by %s', 'kreativ-core' ), esc_html( $name ) ); ?>
        </h1>
        <?php if ( $author instanceof WP_User && $author->user_description ) : ?>
            <p class="kreativ-post-index-intro"><?php echo esc_html( $author->user_description ); ?></p>
        <?php endif; ?>
    </header>

    <?php if ( have_posts() ) : ?>
        <div class="kreativ-post-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php kreativ_render_post_card(); ?>
            <?php endwhile; ?>
        </div>
        <nav class="kreativ-post-index-pagination" aria-label="<?php esc_attr_e( 'Author posts pagination', 'kreativ-core' ); ?>">
            <?php kreativ_render_pagination(); ?>
        </nav>
    <?php else : ?>
        <div class="kreativ-empty-state">
            <p><?php esc_html_e( 'No posts by this author yet.', 'kreativ-core' ); ?></p>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
