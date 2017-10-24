<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>
<div class="container">
    <div id="comments" class="comments-area">
        <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
            ?>
            <p class="no-comments"><?php _e('Comments are closed.', 'twentysixteen'); ?></p>
        <?php endif; ?>
        <?php
        comment_form(array(
            'title_reply' => 'Post a Comment</br><div class="text-center" style="margin-top: 25px">' . do_shortcode("[custom_social_links]") . '</div>',
            'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
            'title_reply_after' => '</h2>',
        ));
        ?>
        <!-- <h2 id="reply-title" class="comment-reply-title">LEAVE A COMMENT</h2> -->
        <?php if (have_comments()) : ?>

            <?php the_comments_navigation(); ?>

            <ol class="comment-list">
                <?php
                $comments = get_comments(array(
                    'post_id' => $post->ID,
                    'number' => 4,
                    'status' => 'approve'
                ));
                foreach ($comments as $comment) :
                    echo "<li class='row'><div class='col-sm-12 name-date'><span class=comment-author>{$comment->comment_author}</span><span class=comment-date>" . date('d F Y', strtotime($comment->comment_date)) . "</span></div><div class='col-sm-12'><span class=comment-details>{$comment->comment_content}</span></div></li>";
                endforeach;

                //comment_date( , $comment_ID );
                ?>
            </ol><!-- .comment-list -->

            <?php the_comments_navigation(); ?>

        <?php endif; // Check for have_comments(). ?>

    </div><!-- .comments-area -->
</div>