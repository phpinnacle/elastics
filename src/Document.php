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

class Document implements \IteratorAggregate, \JsonSerializable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $payload;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @param string $id
     * @param array  $payload
     */
    public function __construct(string $type, string $id, array $payload = [])
    {
        $this->type    = $type;
        $this->id      = $id;
        $this->payload = $payload;
    }

    /**
     * @param array $hit
     *
     * @return self
     */
    public static function forHit(array $hit): self
    {
        return new self($hit['_type'], $hit['_id'], $hit['_source']);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function payload(): array
    {
        return $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        yield from $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->payload + [
            '_id' => $this->id,
        ];
    }
}
