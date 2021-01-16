## WeatherArchive

---

### 1. Get weather by old Month (for Gismeteo, Voronezh)

```php
use ArtARTs36\WeatherArchive\DriverFactory;

$date = new \DateTime('2020-12-01');
$driver = (new DriverFactory())->byDate($date);

var_dump($driver->getOnMonth($date, new \ArtARTs36\WeatherArchive\Entities\Place('5026')));
```
