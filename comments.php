<?php
if ( post_password_required() ) :
    ?>
    <p class="nocomments">This article is password protected. Enter the password to view comments.</p>
    <?php
    return;
endif;
?>

<div class="post_comments">
    <?php if ( have_comments() ) : ?>
        <h3>
            <?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?>
            to &#8220;<?php the_title(); ?>&#8221;
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
        <p class="nocomments">Comments are closed.</p>
    <?php endif; ?>

    <?php
    comment_form(
        array(
            'title_reply'          => 'Leave a comment',
            'label_submit'         => 'Submit Comment',
            'comment_notes_before' => '',
            'comment_notes_after'  => '',
        )
    );
    ?>
</div>
