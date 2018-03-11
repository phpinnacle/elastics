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

namespace PHPinnacle\Elastics\Exception;

class InvalidMatchType extends ElasticsException
{
    /**
     * @param string $type
     */
    public function __construct(string $type)
    {
        $expected = \implode(', ', [
            \ELASTICS_TYPE_BEST_FIELDS,
            \ELASTICS_TYPE_MOST_FIELDS,
            \ELASTICS_TYPE_CROSS_FIELDS,
            \ELASTICS_TYPE_PHRASE,
            \ELASTICS_TYPE_PHRASE_PREFIX,
        ]);

        parent::__construct(\sprintf('Invalid match type! Expected: %s. Got: "%s".', $expected, $type));
    }
}
