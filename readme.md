## WeatherArchive

![PHP Composer](https://github.com/ArtARTs36/php-weather-archive/workflows/Testing/badge.svg?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

---

### 1. Get weather by old Month (for Gismeteo, Voronezh)

```php
use ArtARTs36\WeatherArchive\DriverFactory;

$date = new \DateTime('2020-12-01');
$driver = (new DriverFactory())->byDate($date);

var_dump($driver->getOnMonth($date, new \ArtARTs36\WeatherArchive\Entities\Place('5026')));
```
