<?php

use ArUtil\I18N\Arabic;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * Example of render Hiero language transliteration
 *
 * @category  I18N
 * @package   I18N_Arabic
 * @author    Khaled Al-Sham'aa <khaled@ar-php.org>
 * @copyright 2006-2016 Khaled Al-Sham'aa
 *
 * @license   LGPL <http://www.gnu.org/licenses/lgpl.txt>
 * @link      http://www.ar-php.org
 */

error_reporting(E_ALL);

$word = isset($_GET['w']) ? $_GET['w'] : 'Khaled Shamaa';

/** @var \ArUtil\I18N\Hiero $x */
$x = new Arabic('Hiero');

$im = $x->str2graph($word);

// Set the content-type
header("Content-type: image/png");

imagepng($im);
imagedestroy($im);
