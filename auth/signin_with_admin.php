
<?php ob_start(); session_start();

require_once('../connect.php');
global $conn;

if($_SERVER['REQUEST_METHOD'] === "POST") {
    // Lecturer login
    if(isset($_POST['lecturer_signin']) && isset($_POST['email'])) {
        $lecturer_id = trim($_POST['email']);
        $password = trim($_POST['password']);

        $sql = "SELECT password FROM users WHERE user_id = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $lecturer_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result && $result->password && password_verify($password, $result->password)) {
            $_SESSION['user'] = $result;
            header('Location: ../dashboard/lecturers-dashboard/lecturers-dashboard.php');
        } else {
            $_SESSION['message'] = "Invalid Lecturer ID or password";
            header('Location: ../sign-in.php');
        }
    } 
    // Student login
    else if(isset($_POST['student_signin']) && isset($_POST['email'])) {
        $student_id = trim($_POST['email']);
        $password = trim($_POST['password']);

        $sql = "SELECT password FROM users WHERE user_id = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $student_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result && $result->password && password_verify($password, $result->password)) {
            $_SESSION['user'] = $result;
            header('Location: ../dashboard/students-dashboard/students-dashboard.php');
        } else {
            $_SESSION['message'] = "Invalid Student ID or password";
            header('Location: ../sign-in.php');
        }
    }
    // Admin login
    else if(isset($_POST['admin_signin']) && isset($_POST['email'])) {
        $admin_id = trim($_POST['email']);
        $password = trim($_POST['password']);

        $sql = "SELECT password FROM users WHERE user_id = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $admin_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result && $result->password && password_verify($password, $result->password)) {
            $_SESSION['user'] = $result;
            header('Location: ../dashboard/admin-dashboard/admin-dashboard.php');
        } else {
            $_SESSION['message'] = "Invalid Admin ID or password";
            header('Location: ../sign-in.php');
        }
    }
}
echo 'nothing here';
}
