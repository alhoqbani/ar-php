<?php

namespace Tests\Arabic;

use ArUtil\Arabic;
use Glyphs;
use Tests\AbstractTestCase;

class GlyphsTest extends AbstractTestCase
{
    
    
    /**
     * @var I18N_Arabic_Glyphs
     */
    protected $glyphs;
    
    protected function setUp()
    {
        parent::setUp();
        $this->glyphs = new Arabic('Glyphs');
    }
    
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    
    /** @test */
    public function it_loads_glyphs_class()
    {
        $this->assertInstanceOf(Glyphs::class, $this->glyphs->myObject);
    }
    
    /** @test */
    public function it_calculate_the_max_number_of_character_fit_in_one_A4_page()
    {
        $this->assertEquals(101, $this->glyphs->a4MaxChars(16));
    }

    /** @test */
    public function calculate_the_lines_number_of_given_Arabic_text_and_font_size_that_will_fit_in_A4_page_size()
    {
        $text = <<<END
معظمنا سمع عن جهود الأمم المتحدة في مجال حفظ السلام والمساعدة الإنسانية. ولكن الطرق العديدة الأخرى التي تؤثر بها الأمم المتحدة في حياتنا جميعاً ليست معروفة دائماً حق المعرفة. ويُلقي هذا الكتيب نظرة على الأمم المتحدة - على كيفية تكوينها وعلى ما تقوم به - لتوضيح الطريقة التي تعمل بها بغية جعل عالمنا هذا مكاناً أفضل للجميع.
إن الأمم المتحدة مركز لحل المشاكل التي تواجه البشرية جمعاء. ويتعاون في هذا الجهد ما يزيد على 30 منظمة منتسبة تعرف مجتمعة باسم منظومة الأمم المتحدة. وتعمل الأمم المتحدة وأسرتها من المنظمات يوماً تلو الآخر على تعزيز احترام حقوق الإنسان وحماية البيئة ومكافحة الأمراض والحد من الفقر. وتقوم وكالات الأمم المتحدة فضلاً عن ذلك بتحديد معايير السلامة والكفاءة في النقل الجوي وتساعد على تحسين الاتصالات السلكية واللاسلكية وتعزيز حماية المستهلك. وتتولى الأمم المتحدة أيضاً قيادة الحملات الدولية لمكافحة الاتجار غير المشروع بالمخدرات والإرهاب. وتقوم الأمم المتحدة ووكالاتها في جميع أنحاء العالم بمساعدة اللاجئين ووضع البرامج لإزالة الألغام الأرضية، وتساعد على التوسع في إنتاج الأغذية وتقود عملية مكافحة فيروس نقص المناعة المكتسب/الإيدز
END;
        $this->assertEquals(9, $this->glyphs->a4Lines($text, 14));
    }
    
    /**
     * Need more work to test quality
     * @test
     */
    public function it_Convert_Arabic_Windows_1256_charset_string_into_glyph_joining_in_UTF8_hexadecimals_stream()
    {
        $text = 'بسم الله الرحمن الرحيم';
        $expectedText = 'ﻢﻴﺣﺮﻟﺍ ﻦﻤﺣﺮﻟﺍ ﻪﻠﻟﺍ ﻢﺴﺑ';
        $this->assertEquals($expectedText, $this->glyphs->utf8Glyphs($text));
        
        $text = 'A text mixed مع حروف عربية وانجليزية ١٤٢٨ And number 1234';
        $expectedText = '1234 ًًًً ﺔﻳﺰﻴﻠﺠﻧﺍﻭ ﺔﻴﺑﺮﻋ ﻑﻭﺮﺣ ﻊﻣ A text mixed
And number';
        $this->assertEquals($expectedText, $this->glyphs->utf8Glyphs($text));
    }
    
    
}
