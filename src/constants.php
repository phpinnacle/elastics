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

const
    ELASTICS_OPERATOR_OR  = 'or',
    ELASTICS_OPERATOR_AND = 'and'
;

const
    ELASTICS_ZERO_TERMS_ALL  = 'all',
    ELASTICS_ZERO_TERMS_NONE = 'none'
;

const
    ELASTICS_SORT_ASC  = 'asc',
    ELASTICS_SORT_DESC = 'desc'
;

const
    ELASTICS_TYPE_BEST_FIELDS   = 'best_fields',
    ELASTICS_TYPE_MOST_FIELDS   = 'most_fields',
    ELASTICS_TYPE_CROSS_FIELDS  = 'cross_fields',
    ELASTICS_TYPE_PHRASE        = 'phrase',
    ELASTICS_TYPE_PHRASE_PREFIX = 'phrase_prefix'
;

const
    ELASTICS_SCORE_MODE_AVG  = 'avg',
    ELASTICS_SCORE_MODE_SUM  = 'sum',
    ELASTICS_SCORE_MODE_MIN  = 'min',
    ELASTICS_SCORE_MODE_MAX  = 'max',
    ELASTICS_SCORE_MODE_NONE = 'none'
;

const
    ELASTICS_LANG_PAINLESS   = 'painless',
    ELASTICS_LANG_MUSTACHE   = 'mustache',
    ELASTICS_LANG_EXPRESSION = 'expression'
;

const
    ELASTICS_REGEXP_ALL          = 1,
    ELASTICS_REGEXP_ANYSTRING    = 2,
    ELASTICS_REGEXP_COMPLEMENT   = 4,
    ELASTICS_REGEXP_EMPTY        = 8,
    ELASTICS_REGEXP_INTERSECTION = 16,
    ELASTICS_REGEXP_INTERVAL     = 32
;

const
    ELASTICS_FIELD_OPERATOR         = 'operator',
    ELASTICS_FIELD_BOOST            = 'boost',
    ELASTICS_FIELD_CUTOFF_FREQUENCY = 'cutoff_frequency',
    ELASTICS_FIELD_FUZZINESS        = 'fuzziness',
    ELASTICS_FIELD_LENIENT          = 'lenient',
    ELASTICS_FIELD_MAX_EXPANSIONS   = 'max_expansions',
    ELASTICS_FIELD_MINIMUM_MATCH    = 'minimum_should_match',
    ELASTICS_FIELD_PREFIX_LENGTH    = 'prefix_length',
    ELASTICS_FIELD_ZERO_TERMS       = 'zero_terms_query',
    ELASTICS_FIELD_TRANSPOSITIONS   = 'transpositions'
;

const
    ELASTICS_DEFAULT_ANALYZER       = null,
    ELASTICS_DEFAULT_BOOST          = 1.0,
    ELASTICS_DEFAULT_MAX_EXPANSIONS = 50,
    ELASTICS_DEFAULT_OPERATOR       = \ELASTICS_OPERATOR_OR,
    ELASTICS_DEFAULT_PREFIX_LENGTH  = 0,
    ELASTICS_DEFAULT_SLOP           = 0,
    ELASTICS_DEFAULT_TIE_BREAKER    = 0.0,
    ELASTICS_DEFAULT_ZERO_TERMS     = \ELASTICS_ZERO_TERMS_ALL,
    ELASTICS_DEFAULT_LENIENT        = false,
    ELASTICS_DEFAULT_FUZZINESS      = 'AUTO',
    ELASTICS_DEFAULT_TRANSPOSITIONS = false,
    ELASTICS_DEFAULT_MATCH_TYPE     = \ELASTICS_TYPE_BEST_FIELDS
;
