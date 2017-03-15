<?php

require_once 'Banner.php';

$startDate = new \DateTime('- 1 week');
$endDate = new \DateTime('+ 1 week');

$banner = new App\Banner('test', $startDate->format(DATE_ISO8601), $endDate->format(DATE_ISO8601));

echo $banner->render();