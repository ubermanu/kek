<?php

namespace Kek\Tests\Unit\Language;

class LocaleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @return void
     */
    public function testTranslate(): void
    {
        $locale = new \Kek\Language\Locale('fr');
        $locale->addTranslations(['Hello' => 'Bonjour']);

        $this->assertEquals('Bonjour', $locale->translate('Hello'));
    }

    /**
     * @covers
     * @return void
     */
    public function testMissingTranslation(): void
    {
        $locale = new \Kek\Language\Locale('fr');
        $locale->addTranslations(['Hello' => 'Bonjour']);

        $this->assertEquals('Evening', $locale->translate('Evening'));
    }

    /**
     * @covers
     * @param string $lang
     * @param string $file
     * @param string $expected
     * @return void
     * @dataProvider loadDataProvider
     */
    public function testLoad(string $lang, string $file, string $expected): void
    {
        $locale = new \Kek\Language\Locale($lang);
        $locale->load($file);

        $this->assertEquals($expected, $locale->translate('Hello'));
    }

    /**
     * @return string[][]
     */
    protected function loadDataProvider(): array
    {
        return [
            [
                'lang' => 'fr',
                'filename' => dirname(__FILE__) . '/_files/fr.php',
                'expected' => 'Bonjour'
            ],
            [
                'lang' => 'es',
                'filename' => dirname(__FILE__) . '/_files/es.php',
                'expected' => 'Hola'
            ],
            [
                'lang' => 'en',
                'filename' => dirname(__FILE__) . '/_files/en.php',
                'expected' => 'Hello'
            ],
        ];
    }
}
