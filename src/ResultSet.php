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

class ResultSet implements \IteratorAggregate, \Countable
{
    /**
     * @var int
     */
    private $total;

    /**
     * @var array
     */
    private $documents = [];

    /**
     * @var array
     */
    private $sorts = [];

    /**
     * @param int   $total
     */
    private function __construct(int $total)
    {
        $this->total = $total;
    }

    /**
     * @param array $payload
     *
     * @return ResultSet
     */
    public static function fromArray(array $payload): self
    {
        $hits = $payload['hits'] ?? [
            'hits'  => [],
            'total' => 0,
        ];

        $self = new self((int) $hits['total']);

        foreach ($hits['hits'] as $hit) {
            $document = Document::forHit($hit);

            $self->documents[$document->id()] = $document;

            if (isset($hit['sort'])) {
                $self->sorts[$document->id()] = $hit['sort'];
            }
        }

        return $self;
    }

    /**
     * @param Response $response
     *
     * @return ResultSet
     */
    public static function fromResponse(Response $response): self
    {
        return self::fromArray(\elastics_decode($response->body()));
    }

    /**
     * @param string|null $id
     *
     * @return array
     */
    public function sort(string $id = null): array
    {
        if ($id === null) {
            return \end($this->sorts) ?: [];
        }

        return $this->sorts[$id] ?? [];
    }

    /**
     * @return int
     */
    public function total(): int
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        yield from $this->documents;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \count($this->documents);
    }
}
