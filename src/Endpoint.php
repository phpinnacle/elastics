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

class Endpoint
{
    const
        SEARCH = '_search'
    ;

    /**
     * @var string
     */
    private $path;

    /**
     * @param string $path
     */
    private function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param string $index
     *
     * @return self
     */
    public static function search(string $index): self
    {
        return new self(\sprintf('%s/_search', $index, self::SEARCH));
    }

    /**
     * @param string $dsn
     *
     * @return string
     */
    public function url(string $dsn): string
    {
        return \sprintf('%s/%s', $dsn, $this->path);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->path;
    }
}
