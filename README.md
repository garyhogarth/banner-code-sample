# Banner Code Sample
A simple class and test for managing the displaying of a banner.

In a real environment this would be too verbose, however for the point of demonstration I have completed it. 

## Conditions
- A banner should be displayed during its display period
- Outside of the display period, a banner should be displayed if the user’s device has a specific IP address
- In all other instances, no banner should be displayed
- A banner’s display period can be set by passing the start/end times as ISO 8601 character strings
- For testing the allowed IPs will be 10.0.0.1 and 10.0.0.2

### To Use
```php
require_once 'Banner.php';
use App\Banner;

$startDate = new (\DateTime('- 1 week'))->format(DATE_ISO8601);
$endDate = new (\DateTime('+ 1 week'))->format(DATE_ISO8601);

$banner = new Banner('test', $startDate, $endDate);

echo $banner->render();
```

### Alternative use
```php
require_once 'Banner.php';
use App\Banner;

$startDate = new (\DateTime('- 1 week'))->format(DATE_ISO8601);
$endDate = new (\DateTime('+ 1 week'))->format(DATE_ISO8601);

$banner = new Banner();
$banner->setBannerUrl('image.png');
$banner->setStartDateTime($startDate);
$banner->setEndDateTime($endDate);

echo $banner->render();

```
### Render using Factory
```php
echo BannerFactory::renderBanner('http://placehold.it/350x150', $startDate, $endDate);
```
