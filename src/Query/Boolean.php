<?php
/*
 * This file is part of PhpStorm.
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

class Boolean implements Query
{
    use Traits\Boost;

    /**
     * @var array
     */
    private $must = [];

    /**
     * @var array
     */
    private $mustNot = [];

    /**
     * @var array
     */
    private $should = [];

    /**
     * @var array
     */
    private $filter = [];

    /**
     * {@inheritdoc}
     */
    public function must(Query ...$queries): self
    {
        $this->must = \array_merge($this->must, $queries);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function mustNot(Query ...$queries): self
    {
        $this->mustNot = \array_merge($this->mustNot, $queries);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function should(Query ...$queries): self
    {
        $this->should = \array_merge($this->should, $queries);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(Query ...$queries): self
    {
        $this->filter = \array_merge($this->filter, $queries);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'bool';
    }

    /**
     * @return array
     */
    public function compile(): array
    {
        return \array_filter([
            'must'     => \elastics_compile(...$this->must),
            'must_not' => \elastics_compile(...$this->mustNot),
            'should'   => \elastics_compile(...$this->should),
            'filter'   => \elastics_compile(...$this->filter),
        ]);
    }
}
