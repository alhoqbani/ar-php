<?php

require_once __DIR__ . '/../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Arabic Countries Information</title>
</head>
<body>
<div class="Paragraph" dir="rtl">
    <h1 dir="ltr">Date</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">SimpleXML Example Output:</h2>
    <?php
    /**
     * Example of Arabic Countries Information
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
    
    // set name of XML file
    $file = __DIR__ . '/data/arab_countries.xml';
    
    // load XML file
    $xml = simplexml_load_file($file) or die ('Unable to load XML file!');
    $lang = isset($_GET['lang']) ? ($_GET['lang']) : 'english';
    if ($lang == 'arabic') {
        $dir = 'rtl';
        echo '<a href="Info.php?lang=english">English</a>';
    } else {
        $dir = 'ltr';
        echo '<a href="Info.php?lang=arabic">Arabic</a>';
    }
    
    echo '<table width="98%" cellpadding="5" cellspacing="2" dir="' . $dir . '">';
    
    echo '<tr>';
    echo '<td><b><u>Country</u></b></td>';
    echo '<td><b><u>Capital</u></b></td>';
    echo '<td><b><u>Time Zone</u></b></td>';
    echo '<td><b><u>Time</u></b></td>';
    echo '<td><b><u>Currency</u></b></td>';
    echo '<td><b><u>Local Domain</u></b></td>';
    echo '<td><b><u>Dial Codes</u></b></td>';
    echo '</tr>';
    
    // iterate over <country> element collection
    foreach ($xml as $i => $country) {
        echo ($i++ % 2) ? '<tr bgcolor="#F5F5F5">' : '<tr bgcolor="#E5E5E5">';
        
        echo ' (' . $country->longname->$lang . ')</td>';
        
        $lat = substr($country->capital->latitude, 0, -3);
        if (substr($country->capital->latitude, -1) == 'S') {
            $lat = -1 * $lat;
        }
        
        $lon = substr($country->capital->longitude, 0, -3);
        if (substr($country->capital->latitude, -1) == 'W') {
            $lon = -1 * $lon;
        }
        
        echo '<td><a href="http://maps.google.com/maps?ll=' . $lat . ',' . $lon . '&t=h&z=10" target="_blank">' . $country->capital->$lang . '</a></td>';
        
        $timezone = $country->timezone;
        if ($country->summertime['used'] == 'true') {
            $start = strtotime($country->summertime->start);
            $end = strtotime($country->summertime->end);
            if (time() > $start && time() < $end) {
                $timezone = $timezone + 1;
                $timezone = '+' . $timezone;
            }
        }
        
        // convert current time to GMT based on time zone offset
        $gmtime = time() - (int)substr(date('O'), 0, 3) * 60 * 60;
        
        echo '<td>' . $timezone . ' GMT</td>';
        echo '<td>' . date('G:i', $gmtime + $timezone * 3600) . '</td>';
        echo '<td><a href="http://www.xe.com/ucc/convert.cgi?Amount=1&From=USD&To=' . $country->currency->iso . '" target="_blank">' . $country->currency->$lang . '</a></td>';
        echo '<td><a href="http://www.101domain.com/whois-' . strtolower($country->iso3166->a2) . '.php" target="_blank">http://www.example.com.' . strtolower($country->iso3166->a2) . '</a></td>';
        echo '<td>+' . $country->dialcode . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
    $xml = null;
    ?>
</div>
<br/>

<div class="Paragraph">
    <h2>SimpleXML Example Code:</h2>
    <?php
    $code = <<< END
<?php
    // set name of XML file
    \$file = '../data/arab_countries.xml';
    
    // load XML file
    \$xml = simplexml_load_file(\$file) or die ('Unable to load XML file!');

    if (\$_GET['lang'] == 'arabic') {
        \$lang = 'arabic';
        \$dir  = 'rtl';
        echo '<a href="Info.php?lang=english">English</a>';
    } else {
        \$lang = 'english';
        \$dir  = 'ltr';
        echo '<a href="Info.php?lang=arabic">Arabic</a>';
    }
    
    echo '<table width="98%" cellpadding="5" cellspacing="2" dir="'.\$dir.'">';

    echo '<tr>';
    echo '<td><b><u>Country</u></b></td>';
    echo '<td><b><u>Capital</u></b></td>';
    echo '<td><b><u>Time Zone</u></b></td>';
    echo '<td><b><u>Time</u></b></td>';
    echo '<td><b><u>Currency</u></b></td>';
    echo '<td><b><u>Local Domain</u></b></td>';
    echo '<td><b><u>Dial Codes</u></b></td>';
    echo '</tr>';
    
    // iterate over <country> element collection
    foreach (\$xml as \$country) {
        echo (\$i++ % 2)? '<tr bgcolor="#F5F5F5">' : '<tr bgcolor="#E5E5E5">';
        
        echo '<td><a href="../images/flags/'.\$country->name->english.'.svg" target="_blank">'.\$country->name->\$lang.'</a>';
        echo ' ('.\$country->longname->\$lang.')</td>';

        \$lat = substr(\$country->capital->latitude, 0, -3);
        if(substr(\$country->capital->latitude, -1) == 'S') \$lat = -1 * \$lat;
        
        \$lon = substr(\$country->capital->longitude, 0, -3);
        if(substr(\$country->capital->latitude, -1) == 'W') \$lon = -1 * \$lon;

        echo '<td><a href="http://maps.google.com/maps?ll='.\$lat.','.\$lon.'&t=h&z=10" target="_blank">'.\$country->capital->\$lang.'</a></td>';

        \$timezone = \$country->timezone;
        if (\$country->summertime['used'] == 'true') {
            \$start = strtotime(\$country->summertime->start);
            \$end   = strtotime(\$country->summertime->end);
            if (time() > \$start && time() < \$end) {
                \$timezone = \$timezone + 1;
                \$timezone = '+' . \$timezone;
            }
        }
        
        // convert current time to GMT based on time zone offset
        \$gmtime = time() - (int)substr(date('O'),0,3)*60*60; 

        echo '<td>'.\$timezone.' GMT</td>';
        echo '<td>'.date('G:i', \$gmtime+\$timezone*3600).'</td>';
        echo '<td><a href="http://www.xe.com/ucc/convert.cgi?Amount=1&From=USD&To='.\$country->currency->iso.'" target="_blank">'
                  .\$country->currency->\$lang.'</a></td>';
        echo '<td><a href="http://www.101domain.com/whois-'.strtolower(\$country->iso3166->a2).'.php" target="_blank">
                  http://www.example.com.'.strtolower(\$country->iso3166->a2).'</a></td>';
        echo '<td>+'.\$country->dialcode.'</td>';
        echo '</tr>';
    }

    echo '</table>';
    \$xml = null;
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
</div>

</body>
</html>
