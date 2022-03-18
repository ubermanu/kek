<?php

final class CurrentTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @return void
     * @throws Throwable
     */
    public function testCurrentLangTranslation()
    {
        $current = \Kek\Language\Current::instance();

        $locale = new \Kek\Language\Locale('fr');
        $locale->addTranslations(['Hello' => 'Bonjour']);
        $current->addLocale($locale);

        $this->assertEquals('Hello', $current->translate('Hello'));

        $current->useLanguage('fr');

        $this->assertEquals('Bonjour', $current->translate('Hello'));
    }
}
