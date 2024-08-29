<?php
   /*Object Instantiation*/
   use SannyTech\Session;
   use SannyTech\Cookie;
   use SannyTech\Database;
   use SannyTech\Helper;

   ob_start();

    try {
        $db = new Database(
            Helper::env('DB_HOST'),
            Helper::env('DB_NAME'),
            Helper::env('DB_USER'),
            Helper::env('DB_PASS'),
            Helper::env('DB_PORT'),
            Helper::env('DB_CHARSET')
        );
    } catch(\Throwable $e) {
        die('Database: ' . $e->getMessage());
    }

    $session = new Session();
    $message = $session->message();

    $cookie = new Cookie();

    $help = new Helper();

    $help::setTimezone($help::env("APP_TIMEZONE"));