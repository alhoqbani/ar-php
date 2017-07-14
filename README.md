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
To use the ArDateTime: check the documentation. 


### Original library from http://ar-php.org/

This is the great library of Khaled Al-Shamaa with small bug fixes. 

Install it using composer:

```
composer require "arutil/ar-php:0.0.*"
```
or add it in your `composer.json` file:
```
    "require": {
        "arutil/ar-php": "0.0.*"
    }
```


And use it same as the original library at [ar-php.org](http://www.ar-php.org)

```
<?php 
    
    require_once __DIR__ . '/../vendor/autoload.php';
    use ArUtil\I18N\Arabic;
    
    $obj = new Arabic('Numbers');
    echo $obj->int2str(1975); 

```

