<?php
/**
 * コメントテンプレート
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ($comment_count == 1) {
                echo 'コメント 1件';
            } else {
                printf('コメント %1$s件', number_format_i18n($comment_count));
            }
            ?>
        </h3>

        <?php the_comments_navigation(); ?>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'callback'   => 'tcolu_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
        ?>
            <p class="no-comments">コメントは受け付けていません。</p>
        <?php
        endif;

    endif;

    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'title_reply'        => 'コメントを残す',
        'label_submit'       => 'コメントを送信',
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">コメント <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required></textarea></p>',
        'fields'             => array(
            'author' => '<p class="comment-form-author"><label for="author">名前 <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">メールアドレス <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">ウェブサイト</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" /></p>',
        ),
    ));
    ?>
</div>