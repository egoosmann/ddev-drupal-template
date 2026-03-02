<?php

use Drupal\Component\Utility\Crypt;

// ### Environment
$settings['environment'] = 'development';

// ### Enabled config overrides
$settings['enabled_config_overrides'] = [
  'smtp',
  'symfony_mailer',
  'raven',
  'redis',
  'seckit',
  'environment_indicator',
];

// ### Domains
$settings['base_domains'] = array_map(function ($url) {
  return trim(str_replace(['http://', 'https://'], '', $url), '/');
}, isset($_ENV['DDEV_HOSTNAME']) ? explode(',', $_ENV['DDEV_HOSTNAME']) : []);

// ### PHP
$settings['show_php_errors'] = TRUE;

// ### Cache
$settings['disable_cache'] = TRUE;

// ### Database
$settings['db_name'] = $_ENV['PGDATABASE'] ?: NULL;
$settings['db_user'] = $_ENV['PGUSER'] ?: NULL;
$settings['db_pass'] = $_ENV['PGPASSWORD'] ?: NULL;
$settings['db_host'] = $_ENV['PGHOST'] ?: NULL;
$settings['db_port'] = 3306;
$settings['db_driver'] = $_ENV['DDEV_DATABASE_FAMILY'] ?: NULL;

// ### Salt
$settings['hash_salt'] = Crypt::hashBase64($settings['db_name'].$settings['db_user'].$settings['db_pass'].$settings['db_host'].$settings['db_port']);

// ### SMTP
$settings['smtp_on'] = TRUE;
$settings['smtp_username'] = '';
$settings['smtp_password'] = '';
$settings['smtp_host'] = 'localhost';
$settings['smtp_port'] = '1025'; // 25, 465, 587, 1025
$settings['smtp_protocol'] = 'standard'; // standard, ssl, tls
$settings['smtp_autotls'] = FALSE;
$settings['smtp_from'] = '';
$settings['smtp_fromname'] = '';
$settings['smtp_allowhtml'] = TRUE;
$settings['smtp_debugging'] = TRUE;

// ### Symfony mailer
$settings['symfony_mailer_status'] = TRUE;
$settings['symfony_mailer_user'] = '';
$settings['symfony_mailer_pass'] = '';
$settings['symfony_mailer_host'] = 'localhost';
$settings['symfony_mailer_port'] = '1025';
$settings['symfony_mailer_verify_peer'] = TRUE;

// ### Sentry
$settings['sentry_client_key'] = NULL; // php logging
$settings['sentry_public_dsn'] = NULL; // javascript logging
$settings['sentry_environment'] = NULL; // environment name
$settings['sentry_release'] = NULL; // release or version

// ### Redis
$settings['redis_interface'] = 'PhpRedis';
$settings['redis_host'] = 'cache';
$settings['redis_compress_length'] = 100;

// ### Seckit
$settings['seckit_csp_enabled'] = TRUE;
$settings['seckit_csp_report_only'] = TRUE;
$settings['seckit_csp_upgrade_requests'] = TRUE;
$settings['seckit_hsts_enabled'] = TRUE;
$settings['seckit_various_disable_autocomplete'] = TRUE;

// ### Include overall settings
if (file_exists($app_root . '/' . $site_path . '/default.settings.local.overall.php')) {
  include $app_root . '/' . $site_path . '/default.settings.local.overall.php';
}
