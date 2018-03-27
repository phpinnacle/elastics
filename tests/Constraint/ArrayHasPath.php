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

namespace PHPinnacle\Elastics\Tests\Constraint;

use PHPUnit\Framework\Constraint\Constraint;

class ArrayHasPath extends Constraint
{
    /**
     * @var int|string
     */
    protected $path;

    /**
     * @param int|string $path
     */
    public function __construct($path)
    {
        parent::__construct();

        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    protected function matches($other)
    {
        if (\is_string($this->path)) {
            $keys = \explode('.', $this->path);
        } else {
            $keys = [$this->path];
        }

        $check = $other;

        foreach ($keys as $key) {
            if (!\is_array($check) && !$check instanceof \ArrayAccess) {
                return false;
            }

            if (\is_array($check) && !\array_key_exists($key, $check)) {
                return false;
            }

            if ($check instanceof \ArrayAccess && !$check->offsetExists($key)) {
                return false;
            }

            $check = $check[$key];
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        return 'has the path ' . $this->exporter->export($this->path);
    }

    /**
     * {@inheritdoc}
     */
    protected function failureDescription($other)
    {
        return 'an array ' . $this->toString();
    }
}
