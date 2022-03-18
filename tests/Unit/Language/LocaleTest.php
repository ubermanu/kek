<?php

final class LocaleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @return void
     */
    public function testTranslate()
    {
        $locale = new \Kek\Language\Locale('fr');
        $locale->addTranslations(['Hello' => 'Bonjour']);

        $this->assertEquals('Bonjour', $locale->translate('Hello'));
    }

    /**
     * @covers
     * @return void
     */
    public function testMissingTranslation()
    {
        $locale = new \Kek\Language\Locale('fr');
        $locale->addTranslations(['Hello' => 'Bonjour']);

        $this->assertEquals('Evening', $locale->translate('Evening'));
    }
}
