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

class IndexNotFound extends InternalException
{
    /**
     * @param string $index
     */
    public function __construct(string $index)
    {
        parent::__construct(\sprintf('No such index "%s"!', $index));
    }
}
