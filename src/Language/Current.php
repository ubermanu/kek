<?php

namespace Kek\Language;

use Kek\Exception;
use Kek\Traits\Singleton;

class Current
{
    use Singleton;

    /**
     * @var string The current language
     */
    public static string $code;

    /**
     * @var Locale[]
     */
    protected static array $locales = [];

    /**
     * @param string $lang
     * @throws Exception
     */
    public function __construct(string $lang = 'en_US')
    {
        $this->addLocale(new Locale($lang));
        $this->useLanguage($lang);
    }

    /**
     * @return Locale|null
     */
    protected function getLocale(): ?Locale
    {
        return self::$locales[self::$code] ?? null;
    }

    /**
     * @param Locale $locale
     * @return $this
     */
    public function addLocale(Locale $locale): self
    {
        self::$locales[$locale->getCode()] = $locale;
        return $this;
    }

    /**
     * @param string $lang
     * @return $this
     * @throws Exception
     */
    public function useLanguage(string $lang): self
    {
        if (!isset(self::$locales[$lang])) {
            throw new Exception("Language '$lang' is not supported");
        }

        self::$code = $lang;
        return $this;
    }

    /**
     * @param string $key
     * @return string
     */
    public function translate(string $key): string
    {
        return $this->getLocale()->translate($key);
    }
}
