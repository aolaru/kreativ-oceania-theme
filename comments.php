<?php
if ( post_password_required() ) :
    ?>
    <p class="nocomments"><?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'kreativ-oceania-theme' ); ?></p>
    <?php
    return;
endif;
?>

<div class="post_comments">
    <?php if ( have_comments() ) : ?>
        <h3>
            <?php comments_number( esc_html__( 'No Comments', 'kreativ-oceania-theme' ), esc_html__( 'One Comment', 'kreativ-oceania-theme' ), esc_html__( '% Comments', 'kreativ-oceania-theme' ) ); ?>
            <?php esc_html_e( 'to', 'kreativ-oceania-theme' ); ?> &#8220;<?php the_title(); ?>&#8221;
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
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'kreativ-oceania-theme' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form(
        array(
            'title_reply'          => esc_html__( 'Leave a comment', 'kreativ-oceania-theme' ),
            'label_submit'         => esc_html__( 'Submit Comment', 'kreativ-oceania-theme' ),
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
        )
    );
    ?>
</div>
