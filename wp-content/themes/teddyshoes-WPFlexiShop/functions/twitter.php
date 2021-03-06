<?php

/**
* A simple Twitter status display script.
* Useful as a status badge for JavaScript non-compliant browsers, where the
* insertion of the status message must be performed on the server.
*
* @author Manas Tungare, manas@tungare.name
* @version 1.1
* @copyright Manas Tungare, 2007 - 2009 and onwards.
* @license Creative Commons Attribution ShareAlike 3.0.
*/
function getTwitterStatus($twitterUser, $howMany = 5) {
  $url = sprintf("http://twitter.com/statuses/user_timeline/%s.xml?count=%d",
      $twitterUser, $howMany);
  $parsed = new SimpleXMLElement(file_get_contents($url));

  $tweets = array();
  foreach($parsed->status as $status) {
    $message = preg_replace("/http:\/\/(.*?)\/[^ ]*/", '<a href="\\0">\\0</a>',
        $status->text);
    $time = niceTime(strtotime(str_replace("+0000", "", $status->created_at)));
    $tweets[] = array('message' => $message, 'time' => $time);
  }
  return $tweets;
}

/**
* Formats a timestamp nicely with an adaptive "x units of time ago" message.
* Based on the original Twitter JavaScript badge. Only handles past dates.
* @return string Nicely-formatted message for the timestamp.
* @param $time Output of strtotime() on your choice of timestamp.
*/
function niceTime($time) {
  $delta = time() - $time;
  if ($delta < 60) {
    return 'less than a minute ago.';
  } else if ($delta < 120) {
    return 'about a minute ago.';
  } else if ($delta < (45 * 60)) {
    return floor($delta / 60) . ' minutes ago.';
  } else if ($delta < (90 * 60)) {
    return 'about an hour ago.';
  } else if ($delta < (24 * 60 * 60)) {
    return 'about ' . floor($delta / 3600) . ' hours ago.';
  } else if ($delta < (48 * 60 * 60)) {
    return '1 day ago.';
  } else {
    return floor($delta / 86400) . ' days ago.';
  }
}

// Example: Get a single tweet.
$options = get_option('site_basic_options');
$username = $options['twitter'];
$status = getTwitterStatus($username);
foreach ($status as $twit){
echo "<p class='twitter-message'>" . ($twit['message'] . ' - ' . $twit['time']) . "</p>";
}
?>