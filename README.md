# Banner Code Sample
A simple class and test for managing the displaying of a banner

```php
require_once 'Banner.php';

$startDate = new (\DateTime('- 1 week'))->format(DATE_ISO8601);
$endDate = new (\DateTime('+ 1 week'))->format(DATE_ISO8601);

$banner = new App\Banner('test', $startDate, $endDate);

echo $banner->render();
```
