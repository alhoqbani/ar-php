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
    <title>Convert keyboard language programmatically (English - Arabic)</title>
</head>
<body>
<div class="Paragraph" dir="rtl">
    <h1 dir="ltr">KeySwap</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">Example Output 1 (a):</h2>
    
    <?php
    /**
     * Example of Convert keyboard language programmatically (English - Arabic)
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
    
    /** @var \ArUtil\I18N\KeySwap $Arabic */
    $Arabic = new Arabic('KeySwap');
    
    $str = "Hpf lk hgkhs hglj'vtdkK Hpf hg`dk dldg,k f;gdjil Ygn
,p]hkdm hgHl,v tb drt,k ljv]]dk fdk krdqdk>";
    echo "<u><i>Before - English Keyboard:</i></u><br />$str<br /><br />";
    
    $text = $Arabic->swapEa($str);
    echo "<u><i>After:</i></u><br />$text<br /><br />";
    
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2>Example Code 1 (a):</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('KeySwap');

    \$str = "Hpf lk hgkhs hglj'vtdkK Hpf hg`dk dldg,k f;gdjil Ygn
    ,p]hkdm hgHl,v tb drt,k ljv]]dk fdk krdqdk>";
    echo "<u><i>Before - English Keyboard:</i></u><br />\$str<br /><br />";
    
    \$text = \$Arabic->swapEa(\$str);
    echo "<u><i>After:</i></u><br />\$text<br /><br />";
?>
END;
    
    highlight_string($code);
    
    ?>
</div>
<br/>
<div class="Paragraph" dir="rtl">
    <h2 dir="ltr">Example Output 1 (b):</h2>
    <?php
    $str = 'Hpf lk hgkhs hgljùvtdkK Hpf hg²dk dldg;k fmgdjil Ygn
;p$hkd, hgHl;v tb drt;k ljv$$dk fdk krdadk/';
    echo "<u><i>Before - French Keyboard:</i></u><br />$str<br /><br />";
    
    $text = $Arabic->swapFa($str);
    echo "<u><i>After:</i></u><br />$text<br /><br /><b>جبران خليل جبران</b>";
    
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2>Example Code 1 (b):</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('KeySwap');

    \$str = 'Hpf lk hgkhs hgljùvtdkK Hpf hg²dk dldg;k fmgdjil Ygn 
    ;p\$hkd, hgHl;v tb drt;k ljv\$\$dk fdk krdadk/';
    echo "<u><i>Before - French Keyboard:</i></u><br />\$str<br /><br />";

    \$text = \$Arabic->swapFa(\$str);
    echo "<u><i>After:</i></u><br />\$text<br /><br /><b>جبران خليل جبران</b>";
?>
END;
    
    highlight_string($code);
    
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2 dir="ltr">Example Output 2:</h2>
    <?php
    $str = "ِىغ هىفثممهلثىف بخخم ؤشى ةشنث فاهىلس لاهللثق ةخقث ؤخةحمثء شىي ةخقث رهخمثىفز ÷ف فشنثس ش فخعؤا خب لثىهعس شىي ش مخف خب ؤخعقشلث فخ ةخرث هى فاث خححخسهفث يهقثؤفهخىز";
    echo "<u><i>Before:</i></u><br />$str<br /><br />";
    
    $text = $Arabic->swapAe($str);
    echo "<u><i>After:</i></u><br />$text<br /><br /><b>Albert Einstein</b>";
    ?>

</div>
<br/>
<div class="Paragraph">
    <h2>Example Code 2:</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('KeySwap');
    
    \$str = "ِىغ هىفثممهلثىف بخخم ؤشى ةشنث فاهىلس لاهللثق ةخقث ؤخةحمثء شىي ةخقث رهخمثىفز ÷ف فشنثس ش فخعؤا خب لثىهعس شىي ش مخف خب ؤخعقشلث فخ ةخرث هى فاث خححخسهفث يهقثؤفهخىز";
    
    echo "<u><i>Before:</i></u><br />\$str<br /><br />";
    
    \$text = \$Arabic->swapAe(\$str);
    echo "<u><i>After:</i></u><br />\$text<br /><br /><b>Albert Einstein</b>";
?>
END;
    
    highlight_string($code);
    
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2 dir="ltr">Example Output 3:</h2>
    <?php
    $examples = ["ff'z g;k fefhj", "FF'Z G;K FEFHJ", 'ٍمخصمغ لاعف سعقثمغ', 'sLOWLY BUT SURELY'];
    
    foreach ($examples as $example) {
        $fix = $Arabic->fixKeyboardLang($example);
        
        echo '<span style="color:red">' . $example . '</span> => ';
        echo '<span style="color:blue">' . $fix . '</span><br />';
    }
    ?>

</div>
<br/>
<div class="Paragraph">
    <h2>Example Code 3:</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('KeySwap');
    
    \$examples = array("ff'z g;k fefhj", "FF'Z G;K FEFHJ", 'ٍمخصمغ لاعف سعقثمغ', 'sLOWLY BUT SURELY');

    foreach (\$examples as \$example) {
        \$fix = \$Arabic->fixKeyboardLang(\$example);

        echo '<font color="red">' . \$example . '</font> => ';
        echo '<font color="blue">' . \$fix . '</font><br />';
    }
?>
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
    <a href="../Docs/I18N_Arabic/_Arabic---KeySwap.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
