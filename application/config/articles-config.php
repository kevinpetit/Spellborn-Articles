<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| SMF SSI LOCATION
|--------------------------------------------------------------------------
|
| URL to your SMF Forum it's SSI file. 
| If this is not set, the script will not work
|
*/
$config['ssi_url']	= '';

/*
|--------------------------------------------------------------------------
| CLASS-IXR WORDPRESS LOCATION
|--------------------------------------------------------------------------
|
| URL to your WordPress installation it's class-IXR file. Normally it is located in the wp-includes folder. 
| If this is not set, the script will not work
|
*/
$config['ixr_url']	= '../wp-includes/class-IXR.php';

/*
|--------------------------------------------------------------------------
| XML-RPC WORDPRESS FILE
|--------------------------------------------------------------------------
|
| URL to your WordPress installation it's XML-RPG file. Normally it is located in the WordPress root folder. 
| If this is not set, the script will not work
|
*/
$config['xmlrpc_url']	= 'http://www.yoursite.org/xmlrpc.php';

/*
|--------------------------------------------------------------------------
| WORDPRESS LOGIN INFORMATION
|--------------------------------------------------------------------------
|
| Your login information for WordPress. This user will be the author in WordPress.
| If this is not set, the script will not work
|
*/
$config['wp_username']	= 'youruser'; // Your WordPress username
$config['wp_password'] = 'yourpassword'; // Your WordPress password

/*
|--------------------------------------------------------------------------
| GENERAL SITE INFORMATION
|--------------------------------------------------------------------------
|
| General site information
|
*/
$config['sitename']	= 'Spellborn-Articles'; // Your site's name. Will be used in emails and in the title tag of your browser.
$config['admin_email'] = 'your@ema.il'; // Your email. You will get notifications on this email address.

/*
|--------------------------------------------------------------------------
| ADMIN NOTIFICATION EMAIL
|--------------------------------------------------------------------------
|
| This is the notification email that will be sent to admins when a new article gets submitted.
|
*/
$config['admin_newarticle_subject']	= 'New article submitted!'; // The email subject
$config['admin_newarticle_body'] = 'Hello! This is a quick post to let you know that there has been a new article submitted. Time to check it out?'; // The body of the email

/*
|--------------------------------------------------------------------------
| ENABLE EMAIL DEBUGGER
|--------------------------------------------------------------------------
|
| If you enable this, then each and every time an email will be sent the debugger will be printed. 
| DO NOT ENABLE THIS ON A LIVE PRODUCTION SITE / USE ONLY FOR ERROR SOLVING
| To enable change FALSE to TRUE.
|
*/
$config['enable_maildebugger']	= FALSE; // The email subject


/* Location: ./application/config/articles-config.php */