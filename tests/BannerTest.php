<?php
require_once __DIR__ . '/../lib/Banner.php';

use PHPUnit\Framework\TestCase;
use App\Banner;

class BannerTest extends TestCase
{
    /**
     * @covers Banner::setBannerUrl
     */
    public function testSetBannerUrlSetsTheBannerUrl() {
        $bannerUrl = 'banner.jpg';

        $banner = new Banner();
        $banner->setBannerUrl($bannerUrl);

        $this->assertEquals($bannerUrl,$banner->getBannerUrl());
    }

    /**
     * @covers Banner::setStartDateTime
     */
    public function testSetStartDateTimeSetsTheStartDateTime() {
        $startDate = (new \DateTime('- 1 week'))->format(DATE_ISO8601);

        $banner = new Banner();
        $banner->setStartDateTime($startDate);

        $this->assertEquals($startDate,$banner->getStartDateTime()->format(DATE_ISO8601));
    }

    /**
     * @covers Banner::setEndDateTime
     */
    public function testSetEndDateTimeSetsTheEndDateTime() {
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $banner = new Banner();
        $banner->setEndDateTime($endDate);

        $this->assertEquals($endDate,$banner->getEndDateTime()->format(DATE_ISO8601));
    }

    /**
     * @covers Banner
     */
    public function testBannerConstructorSetsPropertiesCorrectlyIfProvided() {
        $bannerUrl = 'banner.jpg';
        $startDate = (new \DateTime('- 1 week'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $banner = new Banner($bannerUrl, $startDate, $endDate);

        $this->assertEquals($bannerUrl,$banner->getBannerUrl());
        $this->assertEquals($startDate,$banner->getStartDateTime()->format(DATE_ISO8601));
        $this->assertEquals($endDate,$banner->getEndDateTime()->format(DATE_ISO8601));

    }

    /**
     * @covers Banner::render
     */
    public function testBannerIsNotDisplayedIfCurrentDateNotBetweenStartAndEndDate() {
        $bannerUrl = 'banner.jpg';
        $startDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $banner = new Banner($bannerUrl, $startDate, $endDate);

        $this->assertEquals(null,$banner->render());
    }

    /**
     * @covers Banner::render
     */
    public function testBannerIsDisplayedIfCurrentDateBetweenStartAndEndDate() {
        $bannerUrl = 'banner.jpg';
        $startDate = (new \DateTime('- 1 week'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $banner = new Banner($bannerUrl, $startDate, $endDate);

        $this->assertEquals('<img src="'.$bannerUrl.'"/>',$banner->render());
    }

    /**
     * @covers Banner::render
     */
    public function testBannerIsDisplayedIfCurrentDateNotBetweenStartAndEndDateButIpInWhitelist() {
        $bannerUrl = 'banner.jpg';

        // Fake the Remote Address
        $_SERVER['REMOTE_ADDR'] = '10.0.0.1';

        $startDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $banner = new Banner($bannerUrl, $startDate, $endDate);

        $this->assertEquals('<img src="'.$bannerUrl.'"/>',$banner->render());
    }

    /**
     * @covers Banner::render
     */
    public function testBannerIsNotDisplayedIfCurrentDateNotBetweenStartAndEndDateAndIpNotInWhitelist() {
        $bannerUrl = 'banner.jpg';

        // Fake the Remote Address
        $_SERVER['REMOTE_ADDR'] = '10.0.0.3';

        $startDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $banner = new Banner($bannerUrl, $startDate, $endDate);

        $this->assertNull($banner->render());
    }
}