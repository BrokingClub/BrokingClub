<?php
$factory('Purchase', [
    'stock_id' => Stock::orderBy(DB::raw('RAND()'))->first()->id,
    'player_id' => Player::orderBy(DB::raw('RAND()'))->first()->id,
    'value' => false,
    'fee' => false,
    'amount' => rand(1,100),
    'leverage' => array_rand([100 => 1, 350 => 1, 500 => 1]),
    'mode' => array_rand(['falling' => 1, 'rising' => 1])

]);