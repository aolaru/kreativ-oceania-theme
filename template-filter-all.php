<?php
/*
Template Name: Kreativ Unified Home
*/
get_header();

/**
 * CATEGORY LABELS + ICONS
 */
$kreativ_category_labels = [
    'fonts'            => 'Fonts',
    'templates-themes' => 'Templates',
    'graphics'         => 'Graphics',
    'photos'           => 'Photos',
    'videos'           => 'Videos',
    'sounds'           => 'Sounds',
    'free'             => 'Freebies',
];
?>



<!-- =====================================================
     HERO SECTION WITH TOOLS
===================================================== -->
<div class="kreativ-hero container">

    <p class="kreativ-hero-subtitle">
        Fonts, Templates, Graphics, Photos, Videos & Sounds — updated daily.
    </p>

    <div class="kreativ-hero-tools">
        <span class="kreativ-hero-tools-label">Tools:</span>

        <a href="<?php echo esc_url( kreativ_get_internal_url( 'tools/kreativ-font-pairing-tools' ) ); ?>" class="kreativ-hero-tool-card">
            <?php echo kreativ_render_icon( 'search' ); ?>
            <span>Font Pairing Tools</span>
            <small class="kreativ-tool-new">NEW</small>
        </a>

        <a href="<?php echo esc_url( kreativ_get_internal_url( 'tools/kreativ-font-identifier' ) ); ?>" class="kreativ-hero-tool-card">
            <?php echo kreativ_render_icon( 'search' ); ?>
            <span>Font Identifier</span>
        </a>

        <a href="<?php echo esc_url( kreativ_get_internal_url( 'tools/fancy-text-generator' ) ); ?>" class="kreativ-hero-tool-card">
            <?php echo kreativ_render_icon( 'magic' ); ?>
            <span>Fancy Text Generator</span>
        </a>

        <a href="<?php echo esc_url( kreativ_get_internal_url( 'tools/kreativ-font-name-generator' ) ); ?>" class="kreativ-hero-tool-card">
            <?php echo kreativ_render_icon( 'idea' ); ?>
            <span>Font Name Generator</span>
        </a>
    </div>

</div>



<!-- =====================================================
     LATEST BY CATEGORY
===================================================== -->
<?php
$home_sections = [
    'fonts'            => 'Latest Fonts',
    'templates-themes' => 'Latest Templates',
    'graphics'         => 'Latest Graphics',
    'photos'           => 'Latest Photos',
    'videos'           => 'Latest Videos',
    'sounds'           => 'Latest Sounds',
];

foreach ( $home_sections as $slug => $title ) :
    ?>
    <div class="container kreativ-section kreativ-section-<?php echo esc_attr( $slug ); ?>">

        <div class="kreativ-section-header">
            <h2 class="kreativ-section-title">
                <?php echo kreativ_render_icon( $slug ); ?>
                <?php echo esc_html( $title ); ?>
            </h2>
            <a href="<?php echo esc_url( kreativ_get_category_url( $slug ) ); ?>" class="kf-view-all">View All &rsaquo;</a>
        </div>

        <div class="row">
            <?php
            $query = new WP_Query( [
                'posts_per_page'         => 8,
                'post_status'            => 'publish',
                'ignore_sticky_posts'    => true,
                'no_found_rows'          => true, // perf
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false,
                'tax_query'              => [
                    [
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => [ $slug ],
                    ],
                ],
            ] );

            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();

                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                    $thumb_url = $thumb[0] ?? kreativ_get_fallback_image_url();
                    $is_new    = kf_is_new_post( get_the_ID() );
                    ?>
                    <div class="col-md-3 col-sm-6 kreativ-card-animate">
                        <div class="kreativ-font-card">
                            <a href="<?php the_permalink(); ?>">
                                <div class="kreativ-card-media">

                                    <span class="kf-badge kf-badge-<?php echo esc_attr( $slug ); ?>">
                                        <?php echo esc_html( $kreativ_category_labels[ $slug ] ); ?>
                                    </span>

                                    <?php if ( $is_new ) : ?>
                                        <span class="kf-badge-new">NEW</span>
                                    <?php endif; ?>

                                    <img class="lazyload"
                                         loading="lazy"
                                         decoding="async"
                                         alt="<?php the_title_attribute(); ?>"
                                         data-src="<?php echo esc_url( $thumb_url ); ?>"
                                         src="<?php echo esc_url( get_template_directory_uri() . '/img/loading.gif' ); ?>" />
                                </div>
                                <h3><?php the_title(); ?></h3>
                            </a>
                        </div>
                    </div>
                <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php endforeach; ?>



<!-- =====================================================
     FREEBIES
===================================================== -->
<div class="container kreativ-section kreativ-section-free">

        <div class="kreativ-section-header">
        <h2 class="kreativ-section-title">
            <?php echo kreativ_render_icon( 'free' ); ?>
            Free Creative Resources
        </h2>
        <a href="<?php echo esc_url( kreativ_get_category_url( 'free' ) ); ?>" class="kf-view-all">View All &rsaquo;</a>
    </div>

    <div class="row">
        <?php
        $free = new WP_Query( [
            'category_name'           => 'free',
            'posts_per_page'          => 8,
            'post_status'             => 'publish',
            'ignore_sticky_posts'     => true,
            'no_found_rows'           => true,
            'update_post_term_cache'  => false,
            'update_post_meta_cache'  => false,
        ] );

        if ( $free->have_posts() ) :
            while ( $free->have_posts() ) :
                $free->the_post();

                $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
                $thumb_url = $thumb[0] ?? kreativ_get_fallback_image_url();
                $is_new    = kf_is_new_post( get_the_ID() );
                ?>
                <div class="col-md-3 col-sm-6 kreativ-card-animate">
                    <div class="kreativ-font-card">
                        <a href="<?php the_permalink(); ?>">
                            <div class="kreativ-card-media">

                                <span class="kf-badge kf-badge-free">Free</span>

                                <?php if ( $is_new ) : ?>
                                    <span class="kf-badge-new">NEW</span>
                                <?php endif; ?>

                                <img class="lazyload"
                                     loading="lazy"
                                     decoding="async"
                                     alt="<?php the_title_attribute(); ?>"
                                     data-src="<?php echo esc_url( $thumb_url ); ?>"
                                     src="<?php echo esc_url( get_template_directory_uri() . '/img/loading.gif' ); ?>" />
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </a>
                    </div>
                </div>
            <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php get_footer(); ?>
