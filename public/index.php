<?php

require_once __DIR__ . '/../vendor/autoload.php';

$Arabic = new I18N_Arabic('Normalise');


dd(mb_list_encodings());
dd($Arabic->stripTashkeel('حمود بن فًهد الحقباني'));