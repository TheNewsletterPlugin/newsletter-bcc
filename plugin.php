<?php
defined('ABSPATH') || exit;

/**
 * The class depends on NewsletterAddon, hence need to be loaded after Newsletter.
 */
class NewsletterBcc extends NewsletterAddon {
    public function __construct($version = '0.0.0') {
        
        // The 'bcc' name is internally used for name options and avoid conflicts
        parent::__construct('bcc', $version);
        
        // It prepares the internal $this->options array. You can late-call that only when needed to save
        // some processing time. It is optimized, you can call it more than once.
        $this->setup_options();
        
        // More contruction code. Sometimes you need to add it here, sometimes in the init() method.
    }
    
    /**
     * This is firect after Newsletter has been fully initialized. 
     */
    public function init() {
        // Attach our filter to change every message generated when sending a newsletter. We do not
        // attach the filter if there is no Bcc email address configured: just a bit of optimization.
        if (!empty($this->options['bcc'])) {
            add_filter('newsletter_message', [$this, 'filter_newsletter_message']); 
        }
        
        // Always optimize when possible...
        if (is_admin()) {
            // For this kind of configurationnwe allow only the administrators, it's reasonable
            if (current_user_can('administrator')) {
                add_action('admin_menu', [$this, 'action_admin_menu'], 100);
            }
        }
    }
    
    public function action_admin_menu() {
        // We add an entry under the Newsletter main menu, but you're free dto add it where you prefer!
        // For those cases I love the anonymous functions.
        add_submenu_page('newsletter_main_index', 'Bcc', 'Bcc', 'exist', 'newsletter_bcc_index', function () {
            require __DIR__ . '/admin/index.php';
        });
    }
    
    /**
     * We filter the message adding the Bcc header.
     * @param TNP_Mailer_Message $message
     */
    public function filter_newsletter_message($message) {
        // Email headers case does not matter: Bcc or BCC or bcc.
        $message->headers['Bcc'] = $this->options['bcc'];
        return $message;
    }
}

