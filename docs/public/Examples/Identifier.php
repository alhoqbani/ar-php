<?php

use ArUtil\I18N\Arabic;
use ArUtil\I18N\Identifier;

require_once __DIR__ . '/../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>ArIdentifier: Identify Arabic Text Segments</title>
    <style>
        b {
            font-size: 1.1em;
        }
    </style>
</head>
<body>
<div class="Paragraph" dir="rtl">
    <h1 dir="ltr">Identifier</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">Example Output:</h2>
    <?php
    /**
     * Example of Identify Arabic Text Segments
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
    
    $text = <<< END
<p> <b><b><b> Peace &nbsp; <b>سلام</b> &nbsp; שלום &nbsp; Hasîtî &nbsp;
शान्ति&nbsp; Barış &nbsp; 和平&nbsp; Мир </b></b></b> </p><dl>
<dt><b>English:</b>

</dt><dd><b><i>Say <i>Peace</i> in all languages!</i></b>

The people of the world prefer peace to war and they deserve to have it.
Bombs are not needed to solve international problems when they can be solved
just as well with respect and communication.  The Internet Internationalization
(I18N) community, which values diversity and human life everywhere, offers
"Peace" in many languages as a small step in this direction.

<p>

</p></dd><dt><b>Arabic: نص عربي</b>

</dt><dd dir="rtl" align="right" lang="ar"><b>أنطقوا سلام بكل
اللغات!</b>
كل شعوب العالم تفضل السلام علي الحرب وكلها تستحق أن تنعم به.
إن القنابل لا تحل مشاكل العالم ويتم تحقيق ذلك فقط بالاحترام
والتواصل.
مجموعة تدويل الإنترنت <span dir="ltr">(I18N)</span> ، والتي تأخذ بعين
التقدير الاختلافات الثقافية والعادات الحياتية
بين الشعوب، فإنها تقدم "السلام" بلغات كثيرة، كخطوة متواضعة في هذا
الاتجاه.</dd>

<p>

</p><dt><b>Hebrew:</b>

</dt><dd dir="rtl" align="right" lang="he"><b>אמרו "שלום" בכל השפות!</b> אנשי העולם מעדיפים את השלום על-פני המלחמה והם
ראויים לו. אין צורך בפצצות כדי לפתור בעיות בין-לאומיות, רק בכבוד
ובהידברות. קהילת בינאום האינטרנט <span dir="ltr">(I18N)</span>, אשר מוקירה רב-גוניות וחיי אדם
בכל מקום, מושיטה יד ל"שלום" בשפות רבות כצעד קטן בכיוון זה.</dd>
</dl>

<hr>
<p> <b>Some Authors</b><b>:</b> </p>
<dl>
  <ul>
    <li>Frank da&nbsp;Cruz, New York City (USA) </li>
    <li>Marco Cimarosti, Milano (Italy) </li>
    <li>Michael Everson, Dublin (Ireland) </li>
    <li><span dir="rtl">فريد عدلي</span> / Farid Adly,<br>
      Editor in Chief, Italian-Arab News Agency ANBAMED<br>
      (Notizie dal Mediterraneo - <span dir="rtl">أنباء البحر المتوسط</span>), 
      Acquedolci (Italy) </li>
  </ul>
  <p></p>
</dl>
END;
    
    /** @var \ArUtil\I18N\Identifier $Arabic */
    $Arabic = new Arabic('Identifier');
    
    $pos = Identifier::identify($text);
    
    $total = count($pos);
    
    echo substr($text, 0, $pos[0]);
    
    for ($i = 0; $i < $total; $i += 2) {
        echo '<span style="BACKGROUND-COLOR: #EEEE80">';
        echo substr($text, $pos[$i], $pos[$i + 1] - $pos[$i]);
        echo '</span>';
        $length = isset($pos[$i + 2]) ? $pos[$i + 2] : 0;
        $length = $length - $pos[$i + 1];
        echo substr($text, $pos[$i + 1], $length);
    }
    
    ?>
</div>
<br/>
<div class="Paragraph" dir="ltr">
    <h2>Example Code:</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('Identifier');

    \$pos = Identifier::identify(\$text);

    \$total = count(\$pos);

    echo substr(\$text, 0, \$pos[0]);

    for (\$i=0; \$i<\$total; \$i+=2) {
        echo '<span style="BACKGROUND-COLOR: #EEEE80">';
        echo substr(\$text, \$pos[\$i], \$pos[\$i+1]-\$pos[\$i]);
        echo '</span>';
        echo substr(\$text, \$pos[\$i+1], \$pos[\$i+2]-\$pos[\$i+1]);
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
    <a href="../Docs/I18N_Arabic/_Arabic---Identifier.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
