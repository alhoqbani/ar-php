<?php

require_once __DIR__ . '/../vendor/autoload.php';

$Arabic = new I18N_Arabic('Transliteration');


echo $text = $Arabic->enNum('323423' . ' Text in between ' . '٥٥٥٥' . 'ورقم ٢٣٤,٣٤ مع نص عربي');
dump($text);

echo $text = $Arabic->arNum(345 . ' Text in between ' . 34543 . 'مع نص١٢٣٢١ عربي');
dump($text);
