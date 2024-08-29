<?php ob_start(); session_start();

require_once('../connect.php');
global $conn;

if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_POST['lecturer_signin']) && isset($_POST['email'])) {
        $lecturer_id = trim($_POST['email']);
        $password = trim($_POST['password']);
        //$hashed_password = hash('2y$', $password); // TODO: check how to implement hash9


        $sql = "SELECT password FROM users WHERE user_id = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $lecturer_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result->password && password_verify($password, $result->password)) {
            $sql = "SELECT * FROM users WHERE user_id = :email AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $lecturer_id);
            $stmt->bindParam(':password', $result->password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['user'] = $result;
            header('Location: ../dashboard/lecturers-dashboard/lecturers-dashboard.php');
        } else {
            $result = "Invalid Lecturer ID or password";
            $_SESSION['message'] = $result;
            header('Location: ../sign-in.php');
        }

    } 
    else if(isset($_POST['student_signin']) && isset($_POST['email'])) {
        $student_id = trim($_POST['student_email']);
        $password = trim($_POST['student_password']);
        //$hashed_password = hash('2y$', $password); // TODO: check how to implement hash9


        $sql = "SELECT password FROM users WHERE user_id = :student_email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':student_email', $student_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result->password && password_verify($password, $result->password)) {
            $sql = "SELECT * FROM users WHERE user_id = :student_email AND password = :student_password";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':student_email', $student_id);
            $stmt->bindParam(':student_password', $result->password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['user'] = $result;
            header('Location: ../dashboard/student-dashboard/student-dashboard.php');
        } else {
            $result = "Invalid Student ID or password";
            $_SESSION['message'] = $result;
            header('Location: ../sign-in.php');
        }

    }
} else {
    echo 'nothing here';
}