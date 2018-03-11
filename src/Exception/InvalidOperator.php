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

class InvalidOperator extends ElasticsException
{
    /**
     * @param string $type
     */
    public function __construct(string $type)
    {
        parent::__construct(\sprintf('Invalid match operator! Expected: "or", "and". Got: "%s".', $type));
    }
}
