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
    <title>Arabic Text Compressor</title>
</head>
<body>
<div class="Paragraph">
    <h1>CompressStr</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">Example Output:</h2>
    
    <?php
    /**
     * Example of Arabic Text Compressor
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
    
    /** @var \ArUtil\I18N\CompressStr $Arabic */
    $Arabic = new Arabic('CompressStr');
    
    $Arabic->setInputCharset('windows-1256');
    
    $file = __DIR__ . '/data/CompressStr_ar_example.txt';
    $fh = fopen($file, 'r');
    $str = fread($fh, filesize($file));
    fclose($fh);
    
    $zip = $Arabic->compress($str);
    
    $before = strlen($str);
    $after = strlen($zip);
    $rate = round($after * 100 / $before);
    
    echo "String size before was: $before Byte<br>";
    echo "Compressed string size after is: $after Byte<br>";
    echo "Rate $rate %<hr>";
    
    $Arabic->setInputCharset('utf-8');
    $Arabic->setOutputCharset('utf-8');
    
    $str = $Arabic->decompress($zip);
    
    $word = 'الدول';
    
    if ($Arabic->search($zip, $word)) {
        echo "Search for $word in zipped string and find it<hr>";
    } else {
        echo "Search for $word in zipped string and do not find it<hr>";
    }
    
    $len = $Arabic->length($zip);
    echo "Original length of zipped string is $len Byte<hr>";
    
    echo '<div dir="rtl" align="justify">' . nl2br($str) . '</div>';
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2>Example Code:</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('CompressStr');

    \$Arabic->setInputCharset('windows-1256');

    \$file = 'Compress/CompressStr_ar_example.txt';
    \$fh = fopen(\$file, 'r');
    \$str = fread(\$fh, filesize(\$file));
    fclose(\$fh);

    \$zip = \$Arabic->compress(\$str);

    \$before = strlen(\$str);
    \$after = strlen(\$zip);
    \$rate = round(\$after * 100 / \$before);

    echo "String size before was: \$before Byte<br>";
    echo "Compressed string size after is: \$after Byte<br>";
    echo "Rate \$rate %<hr>";

    \$Arabic->setInputCharset('utf-8');
    \$Arabic->setOutputCharset('utf-8');

    \$str = \$Arabic->decompress(\$zip);

    \$word = 'الدول';
    if (\$Arabic->search(\$zip, \$word)) {
        echo "Search for \$word in zipped string and find it<hr>";
    } else {
        echo "Search for \$word in zipped string and do not find it<hr>";
    }

    \$len = CompressStr::length(\$zip);
    echo "Original length of zipped string is \$len Byte<hr>";

    echo '<div dir="rtl" align="justify">'.nl2br(\$str).'</div>';
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
    <a href="../Docs/I18N_Arabic/_Arabic---CompressStr.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
