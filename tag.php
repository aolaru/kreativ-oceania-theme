<?php
/*
 * Tag archive template.
 */
get_header();

/* --------------------------------------------
   TAG CONTEXT
--------------------------------------------- */
$tag      = get_queried_object();
$tag_id   = $tag->term_id;
$tag_slug = $tag->slug;
$tag_name = single_tag_title('', false);
$tag_desc = tag_description();

/* --------------------------------------------
   SORTING LOGIC
--------------------------------------------- */
$sort = isset( $_GET['sort'] ) ? sanitize_key( wp_unslash( $_GET['sort'] ) ) : 'latest';
$valid_sorts = array( 'latest', 'popular' );
if ( ! in_array( $sort, $valid_sorts, true ) ) {
    $sort = 'latest';
}

$orderby  = 'date';
$meta_key = '';

switch ($sort) {
    case 'popular':
        $orderby = 'comment_count';
        break;

}

/* Pagination */
$paged = max(1, get_query_var('paged'));

/* --------------------------------------------
   TAX QUERY
--------------------------------------------- */
$tax_query = [
    [
        'taxonomy' => 'post_tag',
        'field'    => 'term_id',
        'terms'    => [$tag_id],
    ]
];

/* --------------------------------------------
   FINAL QUERY
--------------------------------------------- */
$args = [
    'post_type'           => 'post',
    'posts_per_page'      => 24,
    'paged'               => $paged,
    'orderby'             => $orderby,
    'order'               => 'DESC',
    'meta_key'            => $meta_key ?: null,
    'ignore_sticky_posts' => true,
    'post_status'         => 'publish',
    'tax_query'           => $tax_query,
];

$query = new WP_Query($args);
?>

<!-- =====================================================
     TAG HEADER
===================================================== -->
<div class="container kreativ-category-bg">
    <div class="kreativ-category-header">
        <h1>
            <?php echo kreativ_render_icon( 'tag' ); ?>
            <?php
            printf(
                esc_html__( 'Tag: %s', 'kreativ-oceania-theme' ),
                esc_html( $tag_name )
            );
            ?>
        </h1>

        <?php if ($tag_desc): ?>
            <p><?php echo wp_kses_post($tag_desc); ?></p>
        <?php endif; ?>
    </div>
</div>

<!-- =====================================================
     SORT BAR
===================================================== -->
<div class="kreativ-sort-bar">
    <a href="<?php echo esc_url( add_query_arg( 'sort', 'latest' ) ); ?>" class="kreativ-sort-btn <?php echo $sort === 'latest' ? 'active' : ''; ?>"><?php esc_html_e( 'Latest', 'kreativ-oceania-theme' ); ?></a>
    <a href="<?php echo esc_url( add_query_arg( 'sort', 'popular' ) ); ?>" class="kreativ-sort-btn <?php echo $sort === 'popular' ? 'active' : ''; ?>"><?php esc_html_e( 'Popular', 'kreativ-oceania-theme' ); ?></a>
</div>

<!-- =====================================================
     POSTS GRID
===================================================== -->
<div class="container kreativ-category-grid kreativ-category-bg">
    <div class="row">

        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>

                <?php $is_new = (time() - get_the_time('U')) < 7 * DAY_IN_SECONDS; ?>

                <div class="col-md-4 col-lg-3 col-sm-6 kreativ-card-animate">
                    <div class="kreativ-font-card">

                        <a href="<?php the_permalink(); ?>">
                            <div class="kreativ-card-media">

                                <!-- Tag badge -->
                                <span class="kf-badge" style="background:#555;">
                                    #<?php echo esc_html($tag_name); ?>
                                </span>

                                <?php if ($is_new): ?>
                                    <span class="kf-badge kf-badge-new"><?php esc_html_e( 'New', 'kreativ-oceania-theme' ); ?></span>
                                <?php endif; ?>

                                <?php
                                echo kreativ_get_post_thumbnail_markup(
                                    get_the_ID(),
                                    'medium',
                                    array(
                                        'class' => 'card-img-top',
                                    )
                                );
                                ?>
                            </div>

                            <h3><?php the_title(); ?></h3>
                        </a>

                    </div>
                </div>

            <?php endwhile; ?>
        <?php else : ?>

            <div class="text-center my-5">
                <h2><?php esc_html_e( 'No posts found for this tag.', 'kreativ-oceania-theme' ); ?></h2>
                <p><?php esc_html_e( 'Try browsing another archive or returning to the homepage.', 'kreativ-oceania-theme' ); ?></p>
            </div>

        <?php endif; wp_reset_postdata(); ?>

    </div>

    <!-- Pagination -->
    <div class="kreativ-pagination">
        <?php
        echo paginate_links([
            'total'     => $query->max_num_pages,
            'current'   => $paged,
            'mid_size'  => 2,
            'prev_text' => esc_html__( 'Previous', 'kreativ-oceania-theme' ),
            'next_text' => esc_html__( 'Next', 'kreativ-oceania-theme' ),
            'add_args'  => ['sort' => $sort],
        ]);
        ?>
    </div>

</div>

<?php get_footer(); ?>
