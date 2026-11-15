<?php
/**
 * Gutenberg patterns that establish the theme's editorial building blocks.
 *
 * @package Kreativ_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function kreativ_register_block_assets() {
    register_block_style(
        'core/button',
        array(
            'name'  => 'kreativ-outline',
            'label' => __( 'Kreativ Outline', 'kreativ-core' ),
        )
    );

    register_block_pattern_category(
        'kreativ',
        array(
            'label' => __( 'Kreativ', 'kreativ-core' ),
        )
    );

    register_block_pattern(
        'kreativ-core/callout',
        array(
            'title'       => __( 'Kreativ Callout', 'kreativ-core' ),
            'description' => __( 'A concise callout with a heading, text, and button.', 'kreativ-core' ),
            'categories'  => array( 'kreativ' ),
            'content'     => '<!-- wp:group {"className":"kreativ-callout"} --><div class="wp-block-group kreativ-callout"><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">' . esc_html__( 'Make it yours', 'kreativ-core' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Add a short message that guides visitors to your most important content.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-kreativ-outline"} --><div class="wp-block-button is-style-kreativ-outline"><a class="wp-block-button__link wp-element-button" href="#">' . esc_html__( 'Learn more', 'kreativ-core' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
        )
    );

    register_block_pattern(
        'kreativ-core/editorial-introduction',
        array(
            'title'       => __( 'Editorial introduction', 'kreativ-core' ),
            'description' => __( 'A lead-in for an essay, journal entry, or long-form story.', 'kreativ-core' ),
            'categories'  => array( 'kreativ' ),
            'content'     => '<!-- wp:group {"className":"kreativ-pattern-introduction"} --><div class="wp-block-group kreativ-pattern-introduction"><!-- wp:paragraph {"className":"kreativ-pattern-kicker"} --><p class="kreativ-pattern-kicker">' . esc_html__( 'Field note', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:heading {"level":1} --><h1 class="wp-block-heading">' . esc_html__( 'A considered beginning for your next story', 'kreativ-core' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph {"className":"kreativ-pattern-lead"} --><p class="kreativ-pattern-lead">' . esc_html__( 'Use this introduction to set the pace, establish a point of view, and invite readers into the work.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:group -->',
        )
    );

    register_block_pattern(
        'kreativ-core/feature-story',
        array(
            'title'       => __( 'Feature story', 'kreativ-core' ),
            'description' => __( 'A large editorial feature with a clear call to action.', 'kreativ-core' ),
            'categories'  => array( 'kreativ' ),
            'content'     => '<!-- wp:group {"className":"kreativ-pattern-feature"} --><div class="wp-block-group kreativ-pattern-feature"><!-- wp:paragraph {"className":"kreativ-pattern-kicker"} --><p class="kreativ-pattern-kicker">' . esc_html__( 'Featured story', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">' . esc_html__( 'Build a body of work that rewards a second look', 'kreativ-core' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"kreativ-pattern-lead"} --><p class="kreativ-pattern-lead">' . esc_html__( 'A flexible feature section for a launch, essay, portfolio project, or important announcement.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="#">' . esc_html__( 'Read the story', 'kreativ-core' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
        )
    );

    register_block_pattern(
        'kreativ-core/project-case-study',
        array(
            'title'       => __( 'Project case study', 'kreativ-core' ),
            'description' => __( 'A project overview with clear context and outcomes.', 'kreativ-core' ),
            'categories'  => array( 'kreativ' ),
            'content'     => '<!-- wp:group {"className":"kreativ-pattern-case-study"} --><div class="wp-block-group kreativ-pattern-case-study"><!-- wp:paragraph {"className":"kreativ-pattern-kicker"} --><p class="kreativ-pattern-kicker">' . esc_html__( 'Selected work', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">' . esc_html__( 'A project shaped around clarity and character', 'kreativ-core' ) . '</h2><!-- /wp:heading --><!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">' . esc_html__( 'The brief', 'kreativ-core' ) . '</h3><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Describe the problem, audience, and ambition in a few focused sentences.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3 class="wp-block-heading">' . esc_html__( 'The outcome', 'kreativ-core' ) . '</h3><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Explain what changed and why the result matters for the people using it.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:group -->',
        )
    );

    register_block_pattern(
        'kreativ-core/pull-quote',
        array(
            'title'       => __( 'Editorial pull quote', 'kreativ-core' ),
            'description' => __( 'A large pull quote for essays and feature stories.', 'kreativ-core' ),
            'categories'  => array( 'kreativ' ),
            'content'     => '<!-- wp:quote {"className":"kreativ-pattern-quote"} --><blockquote class="wp-block-quote kreativ-pattern-quote"><!-- wp:paragraph --><p>' . esc_html__( 'Make space for the idea that changes how the rest of the story is read.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><cite>' . esc_html__( 'Name or source', 'kreativ-core' ) . '</cite></blockquote><!-- /wp:quote -->',
        )
    );

    register_block_pattern(
        'kreativ-core/newsletter-invitation',
        array(
            'title'       => __( 'Newsletter invitation', 'kreativ-core' ),
            'description' => __( 'A quiet subscription prompt for the end of an article or page.', 'kreativ-core' ),
            'categories'  => array( 'kreativ' ),
            'content'     => '<!-- wp:group {"className":"kreativ-pattern-newsletter"} --><div class="wp-block-group kreativ-pattern-newsletter"><!-- wp:paragraph {"className":"kreativ-pattern-kicker"} --><p class="kreativ-pattern-kicker">' . esc_html__( 'Stay in the loop', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:heading {"level":2} --><h2 class="wp-block-heading">' . esc_html__( 'A thoughtful note, delivered occasionally', 'kreativ-core' ) . '</h2><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Use this space for your newsletter provider embed or a simple invitation to subscribe.', 'kreativ-core' ) . '</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"is-style-kreativ-outline"} --><div class="wp-block-button is-style-kreativ-outline"><a class="wp-block-button__link wp-element-button" href="#">' . esc_html__( 'Subscribe', 'kreativ-core' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
        )
    );
}
add_action( 'init', 'kreativ_register_block_assets' );
