<?php
/**
 * Database configuration - MySQL
 * Override with environment variables: DB_HOST, DB_NAME, DB_USER, DB_PASSWORD, DB_PORT
 */
return [
    'host'     => getenv('DB_HOST') ?: 'localhost',
    'port'     => getenv('DB_PORT') ?: '3306',
    'dbname'   => getenv('DB_NAME') ?: 'expertisehs',
    'user'     => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASSWORD') ?: '',
    'charset'  => getenv('DB_CHARSET') ?: 'utf8mb4',
];
