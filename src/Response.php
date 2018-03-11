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

class Response
{
    /**
     * @var int
     */
    private $status;

    /**
     * @var string
     */
    private $body;

    /**
     * @var array
     */
    private $headers;

    /**
     * @param int    $status
     * @param string $body
     * @param array  $headers
     */
    public function __construct(int $status, string $body, array $headers = [])
    {
        $this->status  = $status;
        $this->body    = $body;
        $this->headers = $headers;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->status >= 400;
    }

    /**
     * @return int
     */
    public function status(): int
    {
        return $this->status;
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
