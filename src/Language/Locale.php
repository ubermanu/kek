<?php

namespace Kek\Language;

class Locale
{
    /**
     * @var string
     */
    protected string $code;

    /**
     * @var string[]
     */
    protected array $translations = [];

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string[] $translations
     * @return $this
     */
    public function addTranslations(array $translations): self
    {
        $this->translations = array_merge($this->translations, $translations);
        return $this;
    }

    /**
     * @param string $key
     * @return string
     */
    public function translate(string $key): string
    {
        return $this->translations[$key] ?? $key;
    }
}
