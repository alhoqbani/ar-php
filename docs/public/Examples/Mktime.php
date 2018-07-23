<?php

use ArUtil\I18N\Arabic;

require_once __DIR__ . '/../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>MakeTime for Arabic/Islamic Higri Calendar</title>
</head>
<body>
<div class="Paragraph">
    <h1 dir="ltr">Mktime</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">Example Output:</h2>
    <?php
    /**
     * Example of MakeTime for Arabic/Islamic Higri Calendar
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
    $time_start = microtime(true);
    
    date_default_timezone_set('UTC');

    /** @var \ArUtil\I18N\Mktime $Arabic */
    $Arabic = new Arabic('Mktime');
    
    $correction = $Arabic->mktimeCorrection(9, 1429);
    $time = $Arabic->mktime(0, 0, 0, 9, 1, 1429, $correction);
    echo "Calculated first day of Ramadan 1429 unix timestamp is: $time<br>";
    
    $Gregorian = date('l F j, Y', $time);
    echo "Which is $Gregorian in Gregorian calendar<br>";
    
    $days = $Arabic->hijriMonthDays(9, 1429);
    echo "That Ramadan has $days days in total";
    
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2>Example Code:</h2>
    <?php
    $code = <<< END
<?php
    date_default_timezone_set('UTC');

    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('Mktime');

    \$correction = \$Arabic->mktimeCorrection(9, 1429);
    \$time = \$Arabic->mktime(0, 0, 0, 9, 1, 1429, \$correction);    
    echo "Calculated first day of Ramadan 1429 unix timestamp is: \$time<br>";
    
    \$Gregorian = date('l F j, Y', \$time);
    echo "Which is \$Gregorian in Gregorian calendar";

    \$days = \$Arabic->hijriMonthDays(9, 1429);
    echo "That Ramadan has \$days days in total";
END;
    
    highlight_string($code);
    
    $time_end = microtime(true);
    $time = $time_end - $time_start;
    
    echo "<hr />Total execution time is $time seconds<br />\n";
    echo 'Amount of memory allocated to this script is ' . memory_get_usage() . ' bytes';
    
    $included_files = get_included_files();
    echo '<h4>Names of included or required files:</h4><ul>';
    
    foreach ($included_files as $filename) {
        echo "<li>$filename</li>";
    }
    
    echo '</ul>';
    ?>
    <a href="../Docs/I18N_Arabic/_Arabic---Mktime.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
