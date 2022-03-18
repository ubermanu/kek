<?php

namespace Kek;

class Request
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_HEAD = 'HEAD';

    /**
     * @var string[]|null
     */
    protected ?array $headers = null;

    /**
     * @var string[]|null
     */
    protected ?array $formData = null;

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function getParam(string $key, mixed $default = null): mixed
    {
        return match ($this->getServer('REQUEST_METHOD', '')) {
            self::METHOD_POST, self::METHOD_PUT, self::METHOD_PATCH, self::METHOD_DELETE => $this->getFormData($key, $default),
            default => $this->getQuery($key, $default),
        };
    }

    /**
     * @return string
     */
    public function getIP(): string
    {
        $ips = explode(',', $this->getHeader('HTTP_X_FORWARDED_FOR', $this->getServer('REMOTE_ADDR', '0.0.0.0')));
        return trim($ips[0] ?? '');
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return $this->getServer('HTTP_X_FORWARDED_PROTO', $this->getServer('REQUEST_SCHEME', 'https'));
    }

    /**
     * @return bool
     */
    public function isSecure(): bool
    {
        return $this->getProtocol() === 'https';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->getServer('REQUEST_METHOD', 'UNKNOWN');
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->getServer('REQUEST_URI', '');
    }

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    public function getHeader(string $key, string $default = ''): string
    {
        $headers = $this->generateHeaders();
        return (isset($headers[$key])) ? $headers[$key] : $default;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return \mb_strlen(\implode("\n", $this->generateHeaders()), '8bit') + \mb_strlen(\file_get_contents('php://input'), '8bit');
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    protected function getQuery(string $key, mixed $default = null): mixed
    {
        return (isset($_GET[$key])) ? $_GET[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function getFormData(string $key, mixed $default = null): mixed
    {
        $formData = $this->generateFormData();
        return (isset($formData[$key])) ? $formData[$key] : $default;
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function getServer(string $key, mixed $default = null): mixed
    {
        return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
    }

    /**
     * @return array
     */
    protected function generateHeaders(): array
    {
        if ($this->headers === null) {
            $this->headers = array_change_key_case(getallheaders());
        }
        return $this->headers;
    }

    /**
     * @return array
     */
    protected function generateFormData(): array
    {
        if (null === $this->formData) {
            $contentType = $this->getHeader('content-type');

            // Get content-type without the charset
            $length = \strpos($contentType, ';');
            $length = (empty($length)) ? \strlen($contentType) : $length;
            $contentType = \substr($contentType, 0, $length);

            $this->formData = match ($contentType) {
                'application/json' => \json_decode(\file_get_contents('php://input'), true),
                default => $_POST,
            };

            // Make sure we return same data type even if json payload is empty or failed
            if (empty($this->formData)) {
                $this->formData = [];
            }
        }

        return $this->formData;
    }
}
