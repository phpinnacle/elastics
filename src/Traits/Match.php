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

namespace PHPinnacle\Elastics\Traits;

use PHPinnacle\Elastics\Exception;

trait Match
{
    use
        Fuzzy,
        Analyzer
    ;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var Boolean
     */
	protected $lenient;

    /**
     * @var string
     */
	protected $zeroTermsQuery;

    /**
     * @var float
     */
	protected $cutoffFrequency;

    /**
     * @var string
     */
    protected $minimumShouldMatch;

    /**
     * @param string $operator
     *
     * @return self
     */
    public function operator(string $operator): self
    {
        $this->guardOperator($operator);

        $this->operator = $operator;

        return $this;
    }

    /**
     * @param Boolean $lenient
     *
     * @return self
     */
    public function lenient(bool $lenient): self
    {
        $this->lenient = $lenient;

        return $this;
    }

    /**
     * @param string $zeroTerms
     *
     * @return self
     */
    public function zeroTerms(string $zeroTerms): self
    {
        $this->guardZeroTerms($zeroTerms);

        $this->zeroTermsQuery = $zeroTerms;

        return $this;
    }

    /**
     * @param float $cutoffFrequency
     *
     * @return self
     */
    public function cutoffFrequency(float $cutoffFrequency): self
    {
        $this->cutoffFrequency = $cutoffFrequency;

        return $this;
    }

    /**
     * @param int|string $shouldMatch
     *
     * @return self
     */
    public function shouldMatch($shouldMatch): self
    {
        $this->minimumShouldMatch = $shouldMatch;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return array
     */
    private function options(array $fields = []): array
    {
        $options = [];

        if ($this->boost !== null) {
            $options[\ELASTICS_FIELD_BOOST] = $this->boost;
        }

        if ($this->prefixLength !== null) {
            $options[\ELASTICS_FIELD_PREFIX_LENGTH] = $this->prefixLength;
        }

        if ($this->maxExpansions !== null) {
            $options[\ELASTICS_FIELD_MAX_EXPANSIONS] = $this->maxExpansions;
        }

        if ($this->fuzziness !== null) {
            $options[\ELASTICS_FIELD_FUZZINESS] = $this->fuzziness;
        }

        if ($this->transpositions !== null) {
            $options[\ELASTICS_FIELD_TRANSPOSITIONS] = $this->transpositions;
        }

        if ($this->operator !== null) {
            $options[\ELASTICS_FIELD_OPERATOR] = $this->operator;
        }

        if ($this->lenient !== null) {
            $options[\ELASTICS_FIELD_LENIENT] = $this->lenient;
        }

        if ($this->zeroTermsQuery !== null) {
            $options[\ELASTICS_FIELD_ZERO_TERMS] = $this->zeroTermsQuery;
        }

        if ($this->cutoffFrequency !== null) {
            $options[\ELASTICS_FIELD_CUTOFF_FREQUENCY] = $this->cutoffFrequency;
        }

        if ($this->minimumShouldMatch !== null) {
            $options[\ELASTICS_FIELD_MINIMUM_MATCH] = $this->minimumShouldMatch;
        }

        foreach ($fields as $field => $name) {
            if (!isset($options[$field])) {
                continue;
            }

            $options[$name] = $options[$field];

            unset($options[$field]);
        }

        return $options;
    }

    /**
     * @param string $value
     *
     * @return void
     */
    private function guardOperator(string $value)
    {
        if ($value !== \ELASTICS_OPERATOR_OR && $value !== \ELASTICS_OPERATOR_AND) {
            throw new Exception\InvalidOperator($value);
        }
    }

    /**
     * @param string $value
     *
     * @return void
     */
    private function guardZeroTerms(string $value)
    {
        if ($value !== \ELASTICS_ZERO_TERMS_ALL && $value !== \ELASTICS_ZERO_TERMS_NONE) {
            throw new Exception\InvalidZeroTerms($value);
        }
    }
}
