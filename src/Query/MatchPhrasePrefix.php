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

class MatchPhrasePrefix extends MatchPhrase
{
    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'match_phrase_prefix';
    }
}
