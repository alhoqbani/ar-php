<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use ArUtil\I18N\Arabic;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>English-Arabic Transliteration</title>
</head>
<body>
<div class="Paragraph">
    <h1>English-Arabic Transliteration</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2>Example Output:</h2>
    <?php
    /**
     * Example of English-Arabic Transliteration
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
    
    /** @var \ArUtil\I18N\Transliteration $Arabic */
    $Arabic = new Arabic('Transliteration');
    
    $en_terms = [
        'George Bush, Paul Wolfowitz',
        'Silvio Berlusconi?',
        'Guantanamo',
        'Arizona',
        'Maryland',
        'Oracle',
        'Yahoo',
        'Google',
        'Formula1',
        'Boeing',
        'Caviar',
        'Telephone',
        'Internet',
        "Côte d'Ivoire",
    ];
    
    echo <<< END
  <table border="0" cellspacing="2" cellpadding="5" width="500">
    <tr>
      <th width="150">
            English<br />(sample input)
      </th>
      <th bgcolor="#27509D" align="center" width="150">
        <b>
            Arabic<br />(auto generated)
        </b>
      </th>
    </tr>
END;
    
    foreach ($en_terms as $term) {
        echo '<tr><td bgcolor="#f5f5f5" align="left">' . $term . '</td>';
        echo '<td bgcolor="#f5f5f5" align="right">';
        echo $Arabic->en2ar($term);
        echo '</td></tr>';
    }
    
    echo '<tr><td bgcolor="#d0d0f5" align="left">0123,456.789</td>';
    echo '<td bgcolor="#d0d0f5" align="right">';
    echo $Arabic->arNum('0123,456.789');
    echo '</td></tr>';
    
    echo '</table>';
    ?>
</div>
<br/>
<div class="Paragraph">
    <h2>Example Code:</h2>
    <?php
    $code = <<< ENDALL
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('Transliteration');

    \$en_terms = array('George Bush, Paul Wolfowitz', 'Silvio Berlusconi?',
        'Guantanamo', 'Arizona', 'Maryland', 'Oracle', 'Yahoo', 'Google',
        'Formula1', 'Boeing', 'Caviar', 'Telephone', 'Internet', "Côte d'Ivoire");

    echo <<< END
<center>
  <table border="0" cellspacing="2" cellpadding="5" width="500">
    <tr>
      <td bgcolor="#27509D" align="center" width="150">
        <b>
          <font color="#ffffff">
            English<br />(sample input)
          </font>
        </b>
      </td>
      <td bgcolor="#27509D" align="center" width="150">
        <b>
          <font color="#ffffff" face="Tahoma">
            Arabic<br />(auto generated)
          </font>
        </b>
      </td>
    </tr>
END;

    foreach (\$en_terms as \$term) {
        echo '<tr><td bgcolor="#f5f5f5" align="left">'.\$term.'</td>';
        echo '<td bgcolor="#f5f5f5" align="right"><font face="Tahoma">';
        echo \$Arabic->en2ar(\$term);
        echo '</font></td></tr>';
    }

    echo '<tr><td bgcolor="#d0d0f5" align="left">0123,456.789</td>';
    echo '<td bgcolor="#d0d0f5" align="right"><font face="Tahoma">';
    echo \$Arabic->arNum('0123,456.789');
    echo '</font></td></tr>';

    echo '</table></center>';

ENDALL;
    
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
    <a href="../Docs/I18N_Arabic/_Arabic---Transliteration.php.html" target="_blank">Related Class Documentation</a>
</div>
</body>
</html>
