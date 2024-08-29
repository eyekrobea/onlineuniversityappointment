<?php

use Models\Lecturer;
use SannyTech\Exceptions\DatabaseException;

require_once("../../config/_init_.php");
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    global $db, $help, $cookie, $session; $message = '';

    if(!$help::isPost()) {
        $help::redirect(base_url() . "login.php");
    } else {
        if(empty($help::post('username')) || empty($help::post('password'))) {
            echo json_encode([
                'status' => false,
                'message' => 'Please enter your lecturer ID or password'
            ]);
        } else {
            try {
                $lecturer_id = $help::secure($help::post('username'));
                $password = $help::secure($help::post('password'));
                $lecturer = (new Lecturer)->authenticate($lecturer_id, $password);

                if(!$lecturer) {
                    echo json_encode([
                        'status' => false,
                        'message' => "Invalid Lecturer ID or password"
                    ]);
                } else {
                    if($help::post('remember') === 'on') {
                        $cookie->setCookie($lecturer);
                        $cookie->signIn($lecturer);
                    }
                    $session->signIn($lecturer);
                    echo json_encode([
                        'status' => true,
                        'message' => "Login successful",
                        'redirect' => base_url() . 'dashboard/lecturers/index.php'
                    ]);
                }


            } catch (DatabaseException $e) {
                echo json_encode([
                   'status' => false,
                   'message' => 'Something went wrong, please try again'
                ]);
            }
        }
    }