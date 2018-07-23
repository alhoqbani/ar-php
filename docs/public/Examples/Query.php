<?php

use ArUtil\I18N\Arabic;

require_once __DIR__ . '/../../vendor/autoload.php';

function set_up_database() {
    $dbuser = 'root';
    $dbpwd = '';
    $dbname = 'test';
    $sql = file_get_contents(__DIR__ . '/data/ArQuery.sql');
    
    try {
    $dbh = new PDO('mysql:host=localhost;dbname=' . $dbname, $dbuser, $dbpwd);
    
    // Set the error reporting attribute
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec($sql);
    
    } catch (\PDOException $e) {
        echo '<h3 style="color: red">' . $e->getMessage() . '</h3>';
    }
    
}

// Uncomment to populate database.
//  set_up_database();

/**
 * Example of Arabic Query Class
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Arabic Query Class</title>
</head>
<body>
<div class="Paragraph" dir="rtl">
    <h1 dir="ltr">Query</h1>
    <h3><a style="float: right" href="index.php">Back to Index</a></h3>
    <h2 dir="ltr">Example Output:</h2>

    <table border="0" width="100%" dir="ltr">
        <tr>
            <td align="center">
                Example database table contains 574 headline from
                <a href="http://www.aljazeera.net" target=_blank>Aljazeera.net</a>
                news channel website presented at 2003.</font>
            </td>
        </tr>
    </table>
    <hr/>
    <form action="Query.php" method="GET" name="search">
        إبحث عن (Search for): <label>
            <input type="text" name="keyword"
                   value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
        </label>
        <input type="submit" value="بحث (Go)" name="submit"/>
        (مثال: فلسطينيون)<br/>
        <blockquote>
            <input type="radio" name="mode" value="0" checked/> أي من الكلمات (Any word)
            <input type="radio" name="mode" value="1"/> كل الكلمات (All words)
        </blockquote>
    </form>
    
    <?php if (isset($_GET['submit'])) {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null ?>
        <hr/>
        نتائج البحث عن (Search for) <span style="font-weight: bold;">
            <?php echo $keyword; ?></span>:<br/>
        <table cellpadding="5" cellspacing="2" align="center" width="80%">
            <tr>
                <td bgcolor="#004488" align="center">
                    <b>الخبر كما ورد في موقع الجزيرة<br/>
                        Headline at Aljazeera.net</b>
                </td>
            </tr>
            <?php
            /** @var \ArUtil\I18N\Query $Arabic */
            $Arabic = new Arabic('Query');
            echo $Arabic->allForms('فلسطينيون');
            
            $dbuser = 'root';
            $dbpwd = '';
            $dbname = 'test';
            
            try {
                $dbh = new PDO('mysql:host=localhost;dbname=' . $dbname, $dbuser, $dbpwd);
                
                // Set the error reporting attribute
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $dbh->exec("SET NAMES 'utf8'");
                
                if ($keyword != '') {
                    $keyword = str_replace('\"', '"', $keyword);
                    
                    $Arabic->setStrFields('headline');
                    $Arabic->setMode($_GET['mode']);
    
                    /** @var \Query $Arabic */
                    $strCondition = $Arabic->getWhereCondition($keyword);
                    $strOrderBy = $Arabic->getOrderBy($keyword);
                } else {
                    $strCondition = '1';
                }
                
                $StrSQL = "SELECT `headline` FROM `aljazeera` WHERE $strCondition";
                if (isset($strOrderBy)) {
                    $StrSQL .= "  ORDER BY $strOrderBy";
                }
                $i = 0;
                foreach ($dbh->Query($StrSQL) as $row) {
                    $headline = $row['headline'];
                    $i++;
                    if ($i % 2 == 0) {
                        $bg = "#f0f0f0";
                    } else {
                        $bg = "#ffffff";
                    }
                    echo "<tr bgcolor=\"$bg\"><td>$headline</td></tr>";
                }
                
                // Close the databse connection
                $dbh = null;
                
            } catch (PDOException $e) {
                echo '<h3 style="color: red">' . $e->getMessage() . '</h3>';
            }
            ?>
        </table>
        <?php
    }
    ?>

    <hr/>
    صيغة الإستعلام <span dir="ltr">(SQL Query Statement)</span>
    <br/><label>
        <textarea dir="ltr" cols="80" rows="4"><?php echo isset($StrSQL) ? $StrSQL : ''; ?></textarea>
    </label>

</div>
<br/>
<div class="Paragraph">
    <h2>Example Code:</h2>
    <?php
    $code = <<< END
<?php
    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('Query');
    echo \$Arabic->allForms('فلسطينيون');
        
    \$dbuser = 'root';
    \$dbpwd = '';
    \$dbname = 'test';
    
    try {
        \$dbh = new PDO('mysql:host=localhost;dbname='.\$dbname, \$dbuser, \$dbpwd);

        // Set the error reporting attribute
        \$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        \$dbh->exec("SET NAMES 'utf8'");
    
        if (\$_GET['keyword'] != '') {
            \$keyword = @\$_GET['keyword'];
            \$keyword = str_replace('\"', '"', \$keyword);
    
            \$Arabic->setStrFields('headline');
            \$Arabic->setMode(\$_GET['mode']);
    
            \$strCondition = \$Arabic->getWhereCondition(\$keyword);
            \$strOrderBy = \$Arabic->getOrderBy(\$keyword);
        } else {
            \$strCondition = '1';
        }
    
        \$StrSQL = "SELECT `headline` FROM `aljazeera` WHERE \$strCondition ORDER BY \$strOrderBy";

        \$i = 0;
        foreach (\$dbh->Query(\$StrSQL) as \$row) {
            \$headline = \$row['headline'];
            \$i++;
            if (\$i % 2 == 0) {
                \$bg = "#f0f0f0";
            } else {
                \$bg = "#ffffff";
            }
            echo"<tr bgcolor=\"\$bg\"><td><font size=\"2\">\$headline</font></td></tr>";
        }

        // Close the databse connection
        \$dbh = null;

    } catch (PDOException \$e) {
        echo \$e->getMessage();
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
    <a href="../Docs/I18N_Arabic/_Arabic---Query.php.html" target="_blank">Related Class Documentation</a>

</div>
</body>
</html>
