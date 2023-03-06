<?php
// Define regex patterns for emojis and hashtags
define('EMOJI_PATTERN', '/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u');
define('HASHTAG_PATTERN', '/#\w+/u');
?>
