<?php
use ArUtil\I18N\Arabic;
use ArUtil\I18N\CharsetD;

require_once __DIR__ . '/../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Detect Arabic String Character Set</title>
</head>
<body>
<div class="Paragraph">
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h1>CharsetD</h1>
    <h2>Example Output:</h2>
    <?php
    /**
     * Example of Detect Arabic String Character Set
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
    
    $text = '��� ���� ������ ������';
    /** @var \ArUtil\I18N\CharsetD $Arabic */
    $Arabic = new Arabic('CharsetD');
    
    $charset = $Arabic->getCharset($text);
    
    echo "$text ($charset) <br/>";
    
    print_r($Arabic->guess($text));
    ?>

</div>
<br/>
<div class="Paragraph">
    <h2>Example Code:</h2>
    <?php
    $code = <<< END
<?php
    \$text = '��� ���� ������ ������';

    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('CharsetD');
    
    \$charset = \$Arabic->getCharset(\$text);
    
    echo "\$text (\$charset) <br/>";
    
    print_r(\$Arabic->guess(\$text));
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
    <a href="../Docs/I18N_Arabic/_Arabic---CharsetD.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
