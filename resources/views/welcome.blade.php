<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$target = '/public_html/test.travelwheel.ng/storage/app/public/';
$shortcut = '/public_html/test.travelwheel.ng/public/storage';

symlink($target, $shortcut);
?>
