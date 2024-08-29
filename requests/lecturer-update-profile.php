<?php

use Models\Lecturer;
use SannyTech\Exceptions\DatabaseException;

require_once("../config/_init_.php");
global $db, $help, $cookie, $session; $message = '';

if(!$help::isPost()) {
    $session->message('Bad Request');
    $help::redirect(base_url() . "login.php");
} else {
    if($help::post('lecturer_update') && $help::post('email')) {
        $_id = $session->user() ?: $cookie->user();

        try {
            $lecturer = Lecturer::findOnId($_id);
            if($lecturer->email != $help::post('email')) {
                if($lecturer->exists($help::post('email'))){
                    $message = 'Email Already Exists';
                    $session->message($message);
                    $help::redirect(base_url() . 'dashboard/lecturers/profile-management.php');
                };
            }

            $lecturer->name = $help::secure($help::post('name'));
            $lecturer->email = $help::secure($help::post('email'));
            $lecturer->gender = $help::secure($help::post('gender'));
            $lecturer->address = $help::secure($help::post('address'));
            $lecturer->bio = $help::secure($help::post('bio'));
            $lecturer->modified();

            $lecturer->save();
            $session->message('Profile Updated Successfully');
            $help::redirect(base_url() . 'dashboard/lecturers/profile-management.php');

        } catch (DatabaseException $e) {
            $help::productionErrorLog($e, '../logs/error.log', 3, 'Lecturer Dashboard');
            $session->signOut(); $cookie->signOut(); $session->message('Error Occurred From Our End, Please Try Again Later');
            $help::redirect(base_url() . 'login.php');
        }
    } else {
        $session->message('Invalid Request');
        $help::redirect(base_url() . 'dashboard/lecturers/profile-management.php');
    }
}

