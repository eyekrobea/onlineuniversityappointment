<?php

use Models\Student;
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
                'message' => 'Please enter your student ID or password'
            ]);
        } else {
            try {
                $student_id = $help::secure($help::post('username'));
                $password = $help::secure($help::post('password'));
                $student = (new Student)->authenticate($student_id, $password);

                if(!$student) {
                    echo json_encode([
                        'status' => false,
                        'message' => "Invalid Student ID or password"
                    ]);
                } else {
                    if($help::post('remember') === 'on') {
                        $cookie->setCookie($student);
                        $cookie->signIn($student);
                    }
                    $session->signIn($student);
                    echo json_encode([
                        'status' => true,
                        'message' => "Login successful",
                        'redirect' => base_url() . 'dashboard/students/student-dashboard.php'
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