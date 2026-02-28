<?php
/*
 * Kreativ – Enhanced Category Template (FINAL)
 */
get_header();

/* --------------------------------------------
   CATEGORY CONTEXT
--------------------------------------------- */
$category = get_queried_object();
$cat_id   = $category->term_id;
$cat_slug = $category->slug;
$cat_name = $category->name;
$cat_desc = category_description();

$cat_icon = in_array( $cat_slug, array( 'fonts', 'templates-themes', 'graphics', 'photos', 'videos', 'sounds', 'free' ), true ) ? $cat_slug : 'folder';

/* --------------------------------------------
   SORTING LOGIC
--------------------------------------------- */
$sort = isset( $_GET['sort'] ) ? sanitize_key( wp_unslash( $_GET['sort'] ) ) : 'latest';
$valid_sorts = [ 'latest', 'popular', 'free', 'ai' ];
if ( ! in_array( $sort, $valid_sorts, true ) ) {
    $sort = 'latest';
}

$meta_key = '';

switch ($sort) {
    case 'popular':
        $orderby = 'comment_count';
        break;

    case 'free':
        $orderby = 'date';
        break;

    case 'ai':
        $orderby = 'meta_value_num';
        $meta_key = 'ai_score';
        break;

    default:
        $orderby = 'date';
}

/* Pagination */
$paged = max(1, get_query_var('paged'));

/* --------------------------------------------
   TAX QUERY (CORRECT)
--------------------------------------------- */
$tax_query = [
    [
        'taxonomy' => 'category',
        'field'    => 'term_id',
        'terms'    => [$cat_id],
    ]
];

if ($sort === 'free') {
    $tax_query[] = [
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => ['free'],
    ];
}

/* --------------------------------------------
   FINAL QUERY (CORRECT PAGINATION)
--------------------------------------------- */
$args = [
    'post_type'          => 'post',
    'posts_per_page'     => 24,
    'paged'              => $paged,
    'orderby'            => $orderby,
    'order'              => 'DESC',
    'meta_key'           => $meta_key ?: null,
    'ignore_sticky_posts'=> true,
    'post_status'        => 'publish',
    'tax_query'          => $tax_query,
];

$query = new WP_Query($args);
?>

<!-- =====================================================
     GRADIENT HEADER
===================================================== -->
<div class="container kreativ-category-bg">
    <div class="kreativ-category-header">
        <h1>
            <?php echo kreativ_render_icon( $cat_icon ); ?>
            Browse <?php echo esc_html($cat_name); ?>
        </h1>

		<?php if ($cat_desc): ?>
			<p><?php echo wp_kses_post($cat_desc); ?></p>
		<?php endif; ?>

		<?php
		// Suggest an update CTA (always available for this category)
		echo do_shortcode('[kcc_suggest_update]');
		?>
		
		
    </div>
</div>


<!-- =====================================================
     SORT BAR
===================================================== -->
<div class="kreativ-sort-bar">
    <a href="<?php echo esc_url( add_query_arg( 'sort', 'latest' ) ); ?>" class="kreativ-sort-btn <?php echo $sort==='latest'?'active':''; ?>">Latest</a>
    <a href="<?php echo esc_url( add_query_arg( 'sort', 'popular' ) ); ?>" class="kreativ-sort-btn <?php echo $sort==='popular'?'active':''; ?>">Popular</a>
    <a href="<?php echo esc_url( add_query_arg( 'sort', 'free' ) ); ?>" class="kreativ-sort-btn <?php echo $sort==='free'?'active':''; ?>">Free</a>
    <a href="<?php echo esc_url( add_query_arg( 'sort', 'ai' ) ); ?>" class="kreativ-sort-btn <?php echo $sort==='ai'?'active':''; ?>">AI Recommended</a>
</div>



<!-- =====================================================
     POSTS GRID
===================================================== -->
<div class="container kreativ-category-grid kreativ-category-bg">
    <div class="row">

        <?php if ($query->have_posts()) : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>

                <?php
                $img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                $thumb = $img[0] ?? kreativ_get_fallback_image_url();
                ?>

                <div class="col-md-4 col-lg-3 col-sm-6 kreativ-card-animate">
                    <div class="kreativ-font-card">

                        <a href="<?php the_permalink(); ?>">
                            <div class="kreativ-card-media">

                                <!-- Category badge -->
                                <span class="kf-badge kf-badge-<?php echo esc_attr($cat_slug); ?>">
                                    <?php echo esc_html($cat_name); ?>
                                </span>

                                <img class="lazyload"
                                     loading="lazy"
                                     decoding="async"
                                     alt="<?php the_title_attribute(); ?>"
                                     data-src="<?php echo esc_url($thumb); ?>"
                                     src="<?php echo esc_url(get_template_directory_uri() . '/img/loading.gif'); ?>"
                                />
                            </div>

                            <h3><?php the_title(); ?></h3>
                        </a>

                    </div>
                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <h2 class="text-center my-5">No creatives found.</h2>

        <?php endif; wp_reset_postdata(); ?>

    </div>


    <!-- Pagination -->
    <div class="kreativ-pagination">
        <?php
        echo paginate_links([
            'total'     => $query->max_num_pages,
            'current'   => $paged,
            'mid_size'  => 2,
            'prev_text' => '&laquo; Previous',
            'next_text' => 'Next &raquo;',
            'add_args'  => ['sort' => $sort],
        ]);
        ?>
    </div>

</div>

<?php get_footer(); ?>
