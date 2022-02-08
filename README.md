# Bcc all messages sent by Newsletter

This ultra-simple plugin adds a Bcc (Blind Carbon Copy) email address to every outgoing message generated while sending a newsletter.

The Bcc address will receive a copy of every message, but it is not disclosed to the destination subscriber.

The only pratical usage, other than testing, is to send a copy of each message to a CRM which needs to track down all communication with customers, leads, contacts.

The code contains some examples, you should activate only one at the time. With the full example, you can even conditionally change the message headers (or generally the
whole message) using the current newsletter or the current subscriber's data.

Being a one file with few line of code plugin, should be easy to understand and install in a blog. You can even use it as a "must-use" plugin or add the code directly in your theme inside the `functions.php` file.
