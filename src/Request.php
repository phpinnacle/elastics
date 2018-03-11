<?php
/*
 * This file is part of PHPinnacle/Elastics.
 *
 * (c) PHPinnacle Team <dev@phpinnacle.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace PHPinnacle\Elastics;

class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $headers;

    /**
     * @param string $method
     * @param string $body
     * @param array  $headers
     */
    public function __construct(string $method, string $body, array $headers = [])
    {
        $this->method  = \strtoupper($method);
        $this->body    = $body;
        $this->headers = $headers;
    }

    /**
     * @param Search $search
     *
     * @return self
     */
    public static function search(Search $search): self
    {
        return new self(\ELASTICS_METHOD_GET, (string) $search, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function body(): string
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function headers(): array
    {
        return $this->headers;
    }
}
