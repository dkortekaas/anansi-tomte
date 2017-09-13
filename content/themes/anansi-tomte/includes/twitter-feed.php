<?php
/*
Name: 			Twitter Feed
Written by: 	Okler Themes - (http://www.okler.net)
Version: 		4.5.1
*/

require_once('tweet-php/TweetPHP.php');

// Step 1 - To interact with Twitter’s API you will need to create an API KEY, which you can create at: https://dev.twitter.com/apps

// Step 2 - After creating your API Key you will need to take note of following values: "Consumer key", "Consumer secret", "Access token", "Access token secret" and replace the vars below:

$consumer_key = "wXfdacmNtemIqWO6I6kVi45yW";
$consumer_secret = "mPjCucFwZjK2wSniy1buYdz9V2Y8TBtMRhiL6lBJX63seyAb1H";
$access_token = "3042147051-XwiopkNWRoX7SskzCR4n0IhocFwjam8f6F8dAV6";
$access_secret = "fllWMJAy0Yj3ZC8rJC6snad1569W2VjlHKPo8omyL6osi";

$twitter_screen_name = $_GET['twitter_screen_name'];
$tweets_to_display = (isset( $_GET['tweets_to_display'] ) AND $_GET['tweets_to_display'] != '') ? $_GET['tweets_to_display'] : 2;

$TweetPHP = new TweetPHP(array(
	'consumer_key'          => $consumer_key,
	'consumer_secret'       => $consumer_secret,
	'access_token'          => $access_token,
	'access_token_secret'   => $access_secret,
	'twitter_screen_name'   => $twitter_screen_name,
	'cache_file'            => dirname(__FILE__) . '/tweet-php/cache/twitter.txt', // Where on the server to save the cached formatted tweets
	'cache_file_raw'        => dirname(__FILE__) . '/tweet-php/cache/twitter-array.txt', // Where on the server to save the cached raw tweets
	'cachetime'             => 60, // Seconds to cache feed
	'tweets_to_display'     => $tweets_to_display, // How many tweets to fetch
	'ignore_replies'        => false, // Ignore @replies
	'ignore_retweets'       => false, // Ignore retweets
	'twitter_style_dates'   => true, // Use twitter style dates e.g. 2 hours ago
	'twitter_date_text'     => array('seconds', 'minutes', 'about', 'hour', 'ago'),
	'date_format'           => '%e %B %Y', // The defult date format e.g. 12:08 PM Jun 12th. See: http://php.net/manual/en/function.strftime.php
	'date_lang'             => 'nl_NL', // Language for date e.g. 'fr_FR'. See: http://php.net/manual/en/function.setlocale.php
	'format'                => 'html', // Can be 'html' or 'array'
	'twitter_wrap_open'     => '<ul class="testimonials">',
	'twitter_wrap_close'    => '</ul>',
	'tweet_wrap_open'       => '<li><p class="testimonial">',
	'meta_wrap_open'        => '<div class="actionbox">',
	'meta_wrap_close'       => '</div>',
	'tweet_wrap_close'      => '</p></li>',
	'error_message'         => 'Oops, our twitter feed is unavailable right now.',
	'error_link_text'       => 'Follow us on Twitter',
	'debug'                 => false
));

echo $TweetPHP->get_tweet_list();
?>