<?php

return array(
    'routing' => [
        'value' => [
            'config' => ['web.php', 'api.php']
        ]
    ],
    'cache_flags' =>
        array(
            'value' =>
                array(
                    'config_options' => 0.0,
                ),
            'readonly' => false,
        ),
    'cookies' =>
        array(
            'value' =>
                array(
                    'secure' => false,
                    'http_only' => true,
                ),
            'readonly' => false,
        ),
    'exception_handling' =>
        array(
            'value' =>
                array(
                    'debug' => true,
                    'handled_errors_types' => 4437,
                    'exception_errors_types' => 4437,
                    'ignore_silence' => false,
                    'assertion_throws_exception' => true,
                    'assertion_error_type' => 256,
                    'log' => null,
                ),
            'readonly' => false,
        ),
    'connections' =>
        array(
            'value' =>
                array(
                    'default' =>
                        array(
                            'host' => 'mysql',
                            'database' => 'bitrix',
                            'login' => 'root',
                            'password' => 'gcOSyD4kBjxalPf4',
                            'options' => 2.0,
                            'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
                        ),
                ),
            'readonly' => true,
        ),
    'crypto' =>
        array(
            'value' =>
                array(
                    'crypto_key' => 'd09de8b3abb9f303640306436f9cb9e1',
                ),
            'readonly' => true,
        ),
    'messenger' =>
        array(
            'value' =>
                array(
                    'run_mode' => null,
                    'shuffle' => true,
                    'brokers' =>
                        array(
                            'default' =>
                                array(
                                    'type' => 'db',
                                    'params' =>
                                        array(
                                            'table' => 'Bitrix\\Main\\Messenger\\Internals\\Storage\\Db\\Model\\MessengerMessageTable',
                                        ),
                                ),
                        ),
                    'queues' =>
                        array(),
                ),
            'readonly' => true,
        ),
);
