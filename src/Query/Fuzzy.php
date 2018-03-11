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

class Fuzzy implements Query
{
    use Traits\Fuzzy;

    /**
     * @var string
     */
    private $field;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $field
     * @param string $value
     * @param string $fuzziness
     */
    public function __construct(string $field, string $value, string $fuzziness = null)
    {
        $this->field = $field;
        $this->value = $value;

        if ($fuzziness !== null) {
            $this->fuzziness($fuzziness);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'fuzzy';
    }

    /**
     * {@inheritdoc}
     */
    public function compile(): array
    {
        $options = [];

        if ($this->boost !== null) {
            $options['boost'] = $this->boost;
        }

        if ($this->prefixLength !== null) {
            $options['prefix_length'] = $this->prefixLength;
        }

        if ($this->maxExpansions !== null) {
            $options['max_expansions'] = $this->maxExpansions;
        }

        if ($this->fuzziness !== null) {
            $options['fuzziness'] = $this->fuzziness;
        }

        if ($this->transpositions !== null) {
            $options['transpositions'] = $this->transpositions;
        }

        return $options ? [
            $this->field => $options + [
                'value' => $this->value,
            ],
        ] : [
            $this->field => $this->value,
        ];
    }
}
