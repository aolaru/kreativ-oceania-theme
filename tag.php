<?php get_header(); ?>

<?php
$kreativ_tag = get_queried_object();
$sort        = kreativ_get_archive_sort();
$query       = kreativ_get_taxonomy_archive_query( 'post_tag', $kreativ_tag->term_id, $sort );
?>

<main id="primary" class="kreativ-post-index" tabindex="-1">
    <header class="kreativ-post-index-header">
        <p class="kreativ-post-index-kicker"><?php esc_html_e( 'Tag', 'kreativ-core' ); ?></p>
        <h1><?php echo esc_html( $kreativ_tag->name ); ?></h1>
        <?php if ( tag_description() ) : ?>
            <div class="kreativ-post-index-intro"><?php echo wp_kses_post( tag_description() ); ?></div>
        <?php endif; ?>
    </header>

    <nav class="kreativ-archive-sort" aria-label="<?php esc_attr_e( 'Sort posts', 'kreativ-core' ); ?>">
        <a href="<?php echo esc_url( add_query_arg( 'sort', 'latest' ) ); ?>" class="<?php echo esc_attr( 'latest' === $sort ? 'is-current' : '' ); ?>"><?php esc_html_e( 'Latest', 'kreativ-core' ); ?></a>
        <a href="<?php echo esc_url( add_query_arg( 'sort', 'popular' ) ); ?>" class="<?php echo esc_attr( 'popular' === $sort ? 'is-current' : '' ); ?>"><?php esc_html_e( 'Popular', 'kreativ-core' ); ?></a>
    </nav>

    <?php if ( $query->have_posts() ) : ?>
        <div class="kreativ-post-list">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php kreativ_render_post_card(); ?>
            <?php endwhile; ?>
        </div>
        <nav class="kreativ-post-index-pagination" aria-label="<?php esc_attr_e( 'Tag posts pagination', 'kreativ-core' ); ?>">
            <?php kreativ_render_pagination( $query, array( 'add_args' => array( 'sort' => $sort ) ) ); ?>
        </nav>
    <?php else : ?>
        <div class="kreativ-empty-state">
            <p><?php esc_html_e( 'No posts found with this tag.', 'kreativ-core' ); ?></p>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</main>

<?php get_footer(); ?>
