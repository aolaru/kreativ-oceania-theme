<?php
if ( post_password_required() ) :
    ?>
    <p class="nocomments"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'kreativ-core' ); ?></p>
    <?php
    return;
endif;
?>

<div class="post_comments">
    <?php if ( have_comments() ) : ?>
        <h3>
            <?php comments_number( esc_html__( 'No Comments', 'kreativ-core' ), esc_html__( 'One Comment', 'kreativ-core' ), esc_html__( '% Comments', 'kreativ-core' ) ); ?>
            <?php esc_html_e( 'to', 'kreativ-core' ); ?> &#8220;<?php the_title(); ?>&#8221;
        </h3>

        <ol class="commentlist">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 32,
                )
            );
            ?>
        </ol>
    <?php elseif ( ! comments_open() ) : ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'kreativ-core' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form(
        array(
            'title_reply'          => esc_html__( 'Leave a comment', 'kreativ-core' ),
            'label_submit'         => esc_html__( 'Submit Comment', 'kreativ-core' ),
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
        )
    );
    ?>
</div>
