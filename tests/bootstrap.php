<?php
/*
 |--------------------------------------------------------------------
 | phpunit bootstrap
 |--------------------------------------------------------------------
 */
require_once __DIR__ . '/TestCaseBase.php';
require_once realpath(__DIR__ . '/../vendor').'/autoload.php';

if (!defined('FIXTURE_FILE_PATH')) {
    define('FIXTURE_FILE_PATH', __DIR__ . '/_files');
}