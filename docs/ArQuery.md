# ArQuery
 Expanding Arabic word queries in MySQL by using REGEXP function.

 This library willl transform each Arabic word to to A Regex pattern that include all variations of the word.

## Install
```
composer require arutil/ar-php
```

## Basic Usage

### Create SQL statement:
```php
require_once __DIR__ . '/vendor/autoload.php';

use ArUtil\ArUtil;

$arD =  ArUtil::query()->select(['id', 'title', 'body'])->from('posts')->whereReg('title', 'العالمين');

echo $arD->toFullSql();

// "SELECT `id`, `title`, `body` FROM `posts` WHERE `title` REGEXP '((ا|أ|إ|آ)ل)?ع(ا|أ|إ|آ)لم(ين)?'"
// This sql statement will return all rows that has in the title column any varations of the word "العالمين"
```
** NOTE: ** This statment is no probably escaped. You should implemnt some mechanism to escpae usurs' input to avoid any sql injenctions.


### Create The REGEXP pattern only:
You can get the regex patterns for the search terms and construct the sql statement by yourself.
```
$arQ = ArUtil::query();
$patterns = $arQ->regexpy('أبل للحاسبات');

var_dump($patterns);

// array (size=2)
//  0 => string '(ا|أ|إ|آ)بل' (length=17)
//  1 => string 'للح(ا|أ|إ|آ)سب(ة|(ا|أ|إ|آ)ت)?' (length=44)
//
```

The method `regexpy` will retrun an array contains a regex pattern for each word provided to the methd.

## Laravel Example:
 This repo has a laravel app example using this class.
 https://github.com/alhoqbani/laravel-ar-query

similar to the example above here is the relevant code using `regexpy` method:
```php
        $query = App\Post::query();
        $q = request('q');
        $regexPs = ArUtil::query()->regexpy($q);
        foreach ((array)$regexPs as $regex) {
            $query->where('title', 'regexp', $regex);
        }
        $posts = $query->get(['id', 'title']);
```