<?php

require_once '../lib/Banner.php';
require_once '../lib/BannerFactory.php';

use App\Banner;
use App\BannerFactory;

$startDate = (new \DateTime('- 1 week'))->format(DATE_ISO8601);
$futureStartDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);

$endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);
$pastEndDate = (new \DateTime('- 1 day'))->format(DATE_ISO8601);



echo '<h1 style="font-family: Arial">Current IP</h1>';
echo '<h1 style="font-family: Arial">Current DateTime: ' . (new \DateTime())->format(DATE_ISO8601) . '</h1>';

$banner = new Banner('/images/350x150.png', $startDate, $endDate);

echo '<h3 style="font-family: Arial">Local Banner Rendered Using Banner Class</h3>';
echo $banner->render();

echo '<h3 style="font-family: Arial">Local Banner Rendered Using Banner Factory</h1>';
echo $banner = BannerFactory::renderBanner('/images/350x150.png', $startDate, $endDate);

echo '<h3 style="font-family: Arial">Externally Hosted Banner Rendered Using Banner Factory</h1>';
echo $banner = BannerFactory::renderBanner('http://placehold.it/350x150', $startDate, $endDate);
