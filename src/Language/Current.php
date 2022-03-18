<?php

namespace Kek\Language;

use Kek\Exception;
use Kek\Traits\Singleton;

final class Current
{
    use Singleton;

    /**
     * @var string The current language
     */
    protected static string $code;

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
        $this->add(new Locale($lang));
        $this->use($lang);
    }

    /**
     * @param Locale $locale
     * @return $this
     */
    public function add(Locale $locale): self
    {
        self::$locales[$locale->getCode()] = $locale;
        return $this;
    }

    /**
     * @param string|null $lang
     * @return Locale|null
     */
    protected function get(?string $lang = null): ?Locale
    {
        return self::$locales[$lang ?? self::$code] ?? null;
    }

    /**
     * @param string $lang
     * @return $this
     * @throws Exception
     */
    public function use(string $lang): self
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
        return $this->get()->translate($key);
    }
}
