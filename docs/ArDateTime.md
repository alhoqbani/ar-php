# ArDateTime
 Date utility for Hijri Date conversion and calendar 
built on top of [Carbon](http://carbon.nesbot.com/) and [ar-php](http://ar-php.org/)

## Basic Usage

### Create DateTime from Hijri date:
```php
require_once __DIR__ . '/vendor/autoload.php';

use ArUtil\ArUtil;

$arD =  ArUtil::date()->arCreateFromDate(1405, 8, 10);
echo $arD->arToDateString();     // 1405-08-10
echo $arD->ToDateString();       // 1985-05-01

```
`$arD` is an instance of `ArDateTime` which extends `Carbon`.

In addition to the methods available from `Carbon`, 
`ArDateTime` provides some methods to deal with Hijri Date:


#### Create methods:
```
$arD = ArUtil::date()->arCreate($arYear, $arMonth, $arDay, $hour, $minute, $second, $tz); 
$arD = ArUtil::date()->arCreateFromDate(1405, 8, 10);
$arD = ArUtil::date()->arCreateFromDateString('1438-10-19', 'Asia/Riyadh');
$arD = ArUtil::date()->arCreateFromDateTimeString('1438-10-19 4:30:45');
$arD = ArUtil::date()->arCreateFromFormat('Y/m/d', '1430/10/01');

```


#### Getters methods:
```

echo sprintf('Toady is AH %s', ArUtil::date()->arToDateString());
// Toady is AH 1438-10-19

echo sprintf('Toady is %s', ArUtil::date()->ToDateString());
// Toady is 2017-07-14

echo sprintf('تاريخ اليوم %sهـ', ArUtil::date()->arFormat('Y/m/d'));
// تاريخ اليوم 1438/10/19هـ

$arD = ArUtil::date()->arCreate(1438, 10, 19, 02, 21, 39); 

echo $arD->arFormat('l dS F Y h:i:s A');
 // 'الجمعة 19 شوال 1438 02:21:39 صباحاً' 
 
 echo $arD->arToDateTimeString();
 // '1438-10-19 20:21:39'
 
 echo $arD->arToDateString();
 // '1438-10-19'

echo $arD->arToDayDateTimeString();
//  'الجمعة, شوال 19, 1438 8:21 مساءً'
```

