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

namespace PHPinnacle\Elastics\Query;

use PHPinnacle\Elastics\Query;
use PHPinnacle\Elastics\Traits;

class MatchPhrase implements Query
{
    use Traits\Analyzer;

    /**
     * @var string
     */
    private $field;

    /**
     * @var mixed
     */
    private $query;

    /**
     * @var int
     */
    private $slop;

    /**
     * @param string $field
     * @param mixed  $query
     * @param int    $slop
     */
    public function __construct(string $field, $query, int $slop = null)
    {
        $this->field = $field;
        $this->query = $query;
        $this->slop  = $slop;
    }

    /**
     * @param int $slop
     *
     * @return self
     */
    public function slop(int $slop): self
    {
        $this->slop = $slop;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'match_phrase';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $query = [
            'query' => $this->query,
        ];

        if ($this->analyzer !== null) {
            $query['analyzer'] = $this->analyzer;
        }

        if ($this->slop !== null) {
            $query['slop'] = $this->slop;
        }

        return [
            $this->field => $query,
        ];
    }
}
