<p align="center">
<a href="https://travis-ci.org/alhoqbani/ar-php"><img src="https://travis-ci.org/alhoqbani/ar-php.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/arutil/ar-php"><img src="https://poser.pugx.org/arutil/ar-php/downloads" alt="Total Downloads"></a>
</p>

## ArUtil
### Arabic PHP Utilities

Installation:
```
composer require arutil/ar-php
```

### ArDateTime
A wrapper to the hijri methods in ar-php library. 

To use the ArDateTime: [check the documentation](https://github.com/alhoqbani/ar-php/blob/master/docs/ArDateTime.md). 

### ArQuery
A query builder to search Arabic words by its variations. 

To use the ArQuery: [check the documentation](https://github.com/alhoqbani/ar-php/blob/master/docs/ArQuery.md). 




## Ar-php

The Original library from http://ar-php.org/

This is the great library of Khaled Al-Shamaa with small bug fixes. 

You can use the original ar-php same as the docs at [ar-php.org](http://www.ar-php.org)

The only diffirence is the the main class `I18N_Arabic` is renamed and namedspaced under `ArUtil\I18N\Arabic`
```
<?php 
    
    require_once __DIR__ . '/../vendor/autoload.php';
    use ArUtil\I18N\Arabic;
    
    $obj = new Arabic('Numbers');
    echo $obj->int2str(1975); 

```

