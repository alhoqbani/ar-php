# ArDateTime
 Date utility for Hijri Date conversion and calendar 
built on top of [Carbon](http://carbon.nesbot.com/) and [ar-php](http://ar-php.org/)

## Basic Usage

### Create DateTime from Hijri date:
```php
$arD =  ArUtil::date()->arCreateFromDate(1405, 8, 10);
echo $arD->arToDateString();      // 1985-06-14
```
`$arD` is an instance of `ArDateTime` which extends `Carbon`.

In addition to the methods available from `Carbon`, 
`ArDateTime` provides some methods to deal with Hijri Date:

```
$arD = ArUtil::date()->arCreate($arYear, $arMonth, $arDay, $hour, $minute, $second, $tz); 


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

