<?php

namespace SiteManagement\Helpers;

class CommentForm
{
    public function __construct()
    {
        add_filter('comment_form_fields', [$this, 'comment_form_fields']);
    }

    public function comment_form_fields()
    {
        //$comment_field = $fields['comment'];
        //$author_field = $fields['author'];
        //$email_field = $fields['email'];
        $replace_author = __('Your Name', 'novakid');
        $replace_email = __('e.g. john.doe@gmail.com', 'novakid');
        $replace_comment = __('Start typing your message here', 'novakid');
        //$cookies_field = $fields['cookies'];
        unset( $fields['comment'] );
        unset( $fields['author'] );
        unset( $fields['email'] );
        unset( $fields['url'] );
        unset( $fields['cookies'] );
        //$fields['author'] = $author_field;
        //$fields['email'] = $email_field;
        //$fields['comment'] = $comment_field;
        $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'novakid' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
            '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20" required ' . $aria_req . ' /></p>';
        $fields['email'] = '<p class="comment-form-email"><label for="email">' . __( 'E-mail', 'novakid' ) . '</label> ' .
            ( $req ? '<span class="required">*</span>' : '' ) .
            '<input id="email" name="email" type="text" placeholder="'.$replace_email.'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30" required ' . $aria_req . ' /></p>';
        $fields['comment'] = '<p class="comment-form-comment"><label for="comment">' . __( 'Your message', 'novakid' ) .
            '</label><textarea id="comment" name="comment" cols="45" rows="4" placeholder="'.$replace_comment.'" aria-required="true" required></textarea></p>';

        return $fields;
    }
}
