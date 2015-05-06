<?php

$databaseConfig = new \BrokingClub\Services\DatabaseConfigService();


return array(
    'default' => 'mysql',

    'connections' => array(
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => $databaseConfig->getHost(),
            'database'  => $databaseConfig->getDatabase(),
            'username'  => $databaseConfig->getUsername(),
            'password'  => $databaseConfig->getPassword(),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        )
    )
);
