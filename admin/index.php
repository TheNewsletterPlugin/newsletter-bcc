<?php
defined('ABSPATH') || exit;

// This page is loaded by NewsletterBcc so you can use $this to reference it.
// This is just a way to create an admin panel, but you can change it totally.

/* @var $this NewsletterBcc */

// This is the class we use to manage the options, fields and so on. In some ways it is
// an historucal class with many pros and cons.
require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();

// The admin nonce check is included
if ($controls->is_action('save')) {
    // Options are saved, serialized, under the key "newsletter_bcc" (bcc is the slug specific on NewsletterBcc constructor)
    $this->save_options($controls->data);
    $controls->add_message_saved();
} else {
    // Give to $controls the options to be shown
    $controls->set_data($this->options);
}
?>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php' ?>

    <div id="tnp-heading">

        <h2>Bcc for Newsletter</h2>

    </div>

    <div id="tnp-body">

        <form method="post" action="">
            <?php $controls->init(); ?>

            <table class="form-table">
                <tr>
                    <th>Bcc email address</th>
                    <td>
                        <?php $controls->text_email('bcc'); ?>
                        <div class="tnpc-hint">
                            Every message will be sent even to this address.
                        </div>
                    </td>
                </tr>
            </table>
            
            <div class="tnp-buttons">
                <?php $controls->button_save() // Already translated and connected to the "save" action ?>
            </div>
        </form>

    </div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php' ?>

</div>
