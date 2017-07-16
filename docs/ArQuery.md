# ArQuery
 Expanding Arabic word queries in MySQL by using REGEXP function.

 This library willl transform each Arabic word to to A Regex pattern that include all variations of the word.

## Install
```php
composer require arutil/ar-php
```

## Basic Usage

### Create SQL statement:
```
require_once __DIR__ . '/vendor/autoload.php';

use ArUtil\ArUtil;

$arD =  ArUtil::query()->select(['id', 'title', 'body'])->from('posts')->whereReg('title', 'العالمين');

echo $arD->toFullSql();

// "SELECT `id`, `title`, `body` FROM `posts` WHERE `title` REGEXP '((ا|أ|إ|آ)ل)?ع(ا|أ|إ|آ)لم(ين)?'"
// This sql statement will return all rows that has in the title column any varations of the word "العالمين"
```