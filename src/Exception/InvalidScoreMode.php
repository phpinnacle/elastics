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

class InvalidScoreMode extends ElasticsException
{
    /**
     * @param string $mode
     */
    public function __construct(string $mode)
    {
        $expected = \implode(', ', [
            \ELASTICS_SCORE_MODE_AVG,
            \ELASTICS_SCORE_MODE_SUM,
            \ELASTICS_SCORE_MODE_MIN,
            \ELASTICS_SCORE_MODE_MAX,
            \ELASTICS_SCORE_MODE_NONE,
        ]);

        parent::__construct(\sprintf('Invalid score mode! Expected: %s. Got: "%s".', $expected, $mode));
    }
}
