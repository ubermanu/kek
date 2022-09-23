<?php

namespace Kek\Tests\Unit\Language;

class CurrentTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers
     * @return void
     * @throws \Throwable
     */
    public function testCurrentLangTranslation(): void
    {
        $current = \Kek\Language\Current::instance();

        $locale = new \Kek\Language\Locale('fr');
        $locale->addTranslations(['Hello' => 'Bonjour']);
        $current->add($locale);

        $this->assertEquals('Hello', $current->translate('Hello'));

        $current->use('fr');
        $this->assertEquals('Bonjour', $current->translate('Hello'));
    }
}
