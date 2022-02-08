<?php

defined('ABSPATH') || exit;

/*
  Plugin Name: Newsletter - Bcc
  Plugin URI: https://www.thenewsletterplugin.com/
  Description: Build email series for your customers and keep them engaged
  Version: 1.0.0
  Requires PHP: 5.6
  Requires at least: 4.6
  Author: The Newsletter Team
  Author URI: https://www.thenewsletterplugin.com
  Disclaimer: Use at your own risk. No warranty expressed or implied is provided.
 */

// This code is not required if the plugin can be loaded even before Newsletter
add_action('newsletter_loaded', function ($version) {
    // Version check of Newsletter, you can use version compare as well (actually our version is always x.y.z with a single digit per element)
    if ($version < '7.3.1') {
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Newsletter plugin upgrade required for Bcc Addon.</p></div>';
        });
    } else {
        include_once __DIR__ . '/plugin.php';
        // This is the addon version number, it is used to fire the upgrade() method but it's not required
        new NewsletterBcc('1.0.0');
    }
});

// Here you should add code that needs to be loaded
// WARNINGS
// DO NOT USE THIS CODE IN PRODUCTION
// BE SURE TO KEEP ONLY THE RELEVANT PARTS
// TO TEST KEEP ONLY ONE "add_filter(...)" AT TIME
// This is the minimal code you can use to force every newsletter to be sent via Bcc
// to a specific address.
add_filter('newsletter_message', 'my_bcc_header_1');

function my_bcc_header_1($message) {
    $message->headers['Bcc'] = 'name@example.com';
    return $message;
}

// If you love anonymous functions...
/*
  add_filter('newsletter_message', function ($message) {
  $message->headers['Bcc'] = 'name@example.com';
  return $message;
  });
 */

// Getting even the newsletter from which the message is created and the subscriber
//add_filter('newsletter_message', 'my_bcc_header_2', 10, 3);
function my_bcc_header_2($message, $email, $subscriber) {
    // Add here some nice conditional code based in the newsletter and the subscriber
    // Add the Bcc header for subscribers in the list number 1
    if ($subscriber->list_1) {
        $message->headers['Bcc'] = 'name@example.com';
    } else {
        // ...
    }
    return $message;
}
