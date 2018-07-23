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
    <title>Arabic Stemmer</title>
</head>
<body>
<div class="Paragraph" dir="rtl">
    <h1 dir="ltr">Stemmer</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">Example Output:</h2>
    <?php
    /**
     * Example of Arabic Stemmer
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

    /** @var \ArUtil\I18N\Stemmer $Arabic */
    $Arabic = new Arabic('Stemmer');
    
    $examples = [];
    $examples[] = 'سيعرفونها من خلال العمل بالحاسوبين المستعملين لديهما';
    $examples[] = 'الخيليات البرية المهددة بالإنقراض';
    $examples[] = 'تزايدت الحواسيب الشخصية بمساعدة التطبيقات الرئيسية';
    $examples[] = 'سيتعذر هذا على عمليات نشر المساعدات للجائعين بالطريقة الجديدة';
    $examples[] = 'ليس هذا بالحل المثالي انظر  كتبي وكتابك';
    foreach ($examples as $str) {
        echo $str . ' <br />(';
        
        $words = preg_split('/\s+/', $str);
        $stems = [];
        
        foreach ($words as $word) {
            $stem = $Arabic->stem($word);
            if ($stem) {
                $stems[] = $stem;
            }
        }
        
        echo implode('، ', $stems) . ')<br /><br />';
    }
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2>Example Code:</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('Stemmer');
    
    \$examples = array();
    \$examples[] = 'سيعرفونها من خلال العمل بالحاسوبين المستعملين لديهما';
    \$examples[] = 'الخيليات البرية المهددة بالإنقراض';
    \$examples[] = 'تزايدت الحواسيب الشخصية بمساعدة التطبيقات الرئيسية';
    \$examples[] = 'سيتعذر هذا على عمليات نشر المساعدات للجائعين بالطريقة الجديدة';
    \$examples[] = 'ليس هذا بالحل المثالي انظر  كتبي وكتابك';
    foreach (\$examples as \$str) {
        echo \$str . ' <br />(';
        
        \$words = split(' ', \$str);
        \$stems = array();
        
        foreach (\$words as \$word) {
            \$stem = \$Arabic->stem(\$word);
            if (\$stem) {
                \$stems[] = \$stem; 
            }
        }
        
        echo implode('، ', \$stems) . ')<br /><br />';
    }
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
    <a href="../Docs/I18N_Arabic/_Arabic---Stemmer.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
