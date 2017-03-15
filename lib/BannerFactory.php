<?php

namespace App;

require_once 'Banner.php';

use App\Banner;

class BannerFactory
{
    public static function renderBanner($bannerUrl, $startDateTime, $endDateTime) {
        return (new Banner($bannerUrl, $startDateTime, $endDateTime))->render();

    }
}