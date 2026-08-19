<?php
function wpp_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>">
            <div class="comment-author vcard comments__author">
                <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author()) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.') ?></em>
                <br>
            <?php endif; ?>
            <div class="comment-meta commentmetadata comments__date">
                <?= get_comment_date('d.m.Y') ?> <?= get_comment_time('H:i') ?>
                <?php edit_comment_link(__('(Edit)'),'  ','') ?>
            </div>
            <div class="comments__content">
                <?php comment_text() ?>
            </div>

            <div class="reply comments__reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
        </div>
<?php
}