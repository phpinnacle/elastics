<?php

use PHPinnacle\Elastics\Client;
use PHPinnacle\Elastics\Search;
use PHPinnacle\Elastics\Query;

require __DIR__ . '/../vendor/autoload.php';

$query = new Query\Boolean();
$query
    ->must(new Query\Match('name', 'Alex'))
    ->mustNot(
        new Query\Term('gender', 'male'),
        new Query\Terms('eye_color', ['blue', 'green'])
    )
    ->filter(new Query\Range('age', 21))
;

$search = Search::match($query);
$search
    ->order('_id', \ELASTICS_SORT_DESC)
    ->limit(50)
;

$client = Client::curl('http://127.0.0.1:9200');
$result = $client->search('users', $search);

echo \sprintf('Found %d documents.' . \PHP_EOL, $result->total());
