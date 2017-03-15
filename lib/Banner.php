<?php

namespace App;

class Banner
{
    private $bannerUrl;
    private $startDateTime;
    private $endDateTime;
    private $allowedIPs = ['10.0.0.1','10.0.0.2']; // In a real world app these would not be hardcoded

    /**
     * Banner constructor.
     *
     * @param string $bannerUrl
     * @param string $startDateTime
     * @param string $endDateTime
     */
    public function __construct($bannerUrl=null, $startDateTime=null, $endDateTime=null) {
        if ($bannerUrl) {
            $this->setBannerUrl($bannerUrl);
        }

        if ($startDateTime) {
            $this->setStartDateTime($startDateTime);
        }

        if ($endDateTime) {
            $this->setEndDateTime($endDateTime);
        }
    }

    /**
     * Set the bannerURL property if valid
     *
     * @param $bannerUrl
     */
    public function setBannerUrl($bannerUrl) {
        // @improvement - Add a check to make sure file exists
        $this->bannerUrl = $bannerUrl;
    }

    /**
     * Get the bannerUrl private property
     *
     * @return string
     */
    public function getBannerUrl() {
        return $this->bannerUrl;
    }

    /**
     * Set the startDateTime parameter from an ISO-8601 string
     *
     * @param $startDateTime
     */
    public function setStartDateTime($startDateTime) {
        // @improvement - Check string is ISO-8601 format
        $this->startDateTime = new \DateTime($startDateTime);
    }


    /**
     * Gets the startDateTime as a PHP DateTime Object
     *
     * @return \DateTime
     */
    public function getStartDateTime() {
        return $this->startDateTime;
    }

    /**
     * Set the endDateTime parameter from an ISO-8601 string
     *
     * @param $endDateTime
     */
    public function setEndDateTime($endDateTime) {
        // @improvement - Check string is ISO-8601 format
        $this->endDateTime = new \DateTime($endDateTime);
    }


    /**
     * Gets the startDateTime as a PHP DateTime Object
     *
     * @return \DateTime
     */
    public function getEndDateTime() {
        return $this->endDateTime;
    }

    /**
     * @return array
     */
    public function getAllowedIPs() {
        return $this->allowedIPs;
    }

    public function isValid() {

    }

    /**
     * Render the banner if:
     * - in list of allowed IP addresses
     * - current DateTime is inbetween the start date and end date
     *
     * @return mixed
     */
    public function render() {
        $currentDateTime = new \DateTime();
        $ipAddress = isset($_SERVER['REMOTE_ADDR'])? $_SERVER['REMOTE_ADDR'] : null;

        if (in_array($ipAddress,$this->getAllowedIPs())) {
            return $this->bannerUrl;
        }

        if ((!$this->getStartDateTime() || $currentDateTime >= $this->getStartDateTime()) &&
            (!$this->getEndDateTime() || $currentDateTime <= $this->getEndDateTime())) {
            return $this->bannerUrl;
        }

        return false;
    }
}