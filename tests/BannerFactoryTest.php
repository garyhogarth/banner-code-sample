<?php
require_once __DIR__ . '/../lib/BannerFactory.php';

use PHPUnit\Framework\TestCase;
use App\BannerFactory;

class BannerFactoryTest extends TestCase
{

    /**
     * @covers BannerFactory::renderBanner
     */
    public function testBannerIsNotDisplayedIfCurrentDateNotBetweenStartAndEndDate() {
        $bannerUrl = '350x150.png';
        $startDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $this->assertEquals(null,BannerFactory::renderBanner($bannerUrl, $startDate, $endDate));
    }

    /**
     * @covers BannerFactory::renderBanner
     */
    public function testBannerIsDisplayedIfCurrentDateBetweenStartAndEndDate() {
        $bannerUrl = '350x150.png';
        $startDate = (new \DateTime('- 1 week'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        $this->assertEquals('<img src="'.$bannerUrl.'"/>',BannerFactory::renderBanner($bannerUrl, $startDate, $endDate));
    }

    /**
     * @covers BannerFactory::renderBanner
     */
    public function testBannerIsDisplayedIfCurrentDateNotBetweenStartAndEndDateButIpInWhitelist() {
        $bannerUrl = '350x150.png';
        $startDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        // Fake the Remote Address
        $_SERVER['REMOTE_ADDR'] = '10.0.0.1';

        $this->assertEquals('<img src="'.$bannerUrl.'"/>',BannerFactory::renderBanner($bannerUrl, $startDate, $endDate));
    }

    /**
     * @covers BannerFactory::renderBanner
     */
    public function testBannerIsNotDisplayedIfCurrentDateNotBetweenStartAndEndDateAndIpNotInWhitelist() {
        $bannerUrl = 'http://placehold.it/350x150';
        $startDate = (new \DateTime('+ 1 day'))->format(DATE_ISO8601);
        $endDate = (new \DateTime('+ 1 week'))->format(DATE_ISO8601);

        // Fake the Remote Address
        $_SERVER['REMOTE_ADDR'] = '10.0.0.3';


        $this->assertNull(BannerFactory::renderBanner($bannerUrl, $startDate, $endDate));
    }
}