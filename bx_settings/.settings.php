<?php

return array (
  'utf_mode' => 
  array (
    'value' => true,
    'readonly' => true,
  ),
  'cache_flags' => 
  array (
    'value' => 
    array (
      'config_options' => 3600.0,
      'site_domain' => 3600.0,
    ),
    'readonly' => false,
  ),
    'cache' => array(
        'value' => array(
            'type' => array(
                'class_name' => '\Bitrix\Main\Data\CacheEngineRedis',
                'extension' => 'redis'
            ),
            'redis' => array(
                'host' => 'redis',
                'port' => '6379',
            ),
            'sid' => $_SERVER["DOCUMENT_ROOT"] . "#01"
        ),
    ),
  'cookies' => 
  array (
    'value' => 
    array (
      'secure' => false,
      'http_only' => true,
    ),
    'readonly' => false,
  ),
  'exception_handling' => 
  array (
    'value' => 
    array (
      'debug' => true,
      'handled_errors_types' => 4437,
      'exception_errors_types' => 4437,
      'ignore_silence' => false,
      'assertion_throws_exception' => true,
      'assertion_error_type' => 256,
      'log' => NULL,
    ),
    'readonly' => false,
  ),
  'connections' => 
  array (
    'value' => 
    array (
      'default' => 
      array (
        'className' => '\\Bitrix\\Main\\DB\\MysqliConnection',
        'host' => 'mysql',
        'database' => 'bitrix-test',
        'login' => 'bitrix-test',
        'password' => 'bitrix-test',
        'options' => 2.0,
      ),
    ),
    'readonly' => true,
  ),
  'crypto' => 
  array (
    'value' => 
    array (
      'crypto_key' => 'd19e55cbfd3fe01914c8d5fc9c56bacf',
    ),
    'readonly' => true,
  ),
);
