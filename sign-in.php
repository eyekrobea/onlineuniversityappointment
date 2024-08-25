<?php
// Start the session (if needed for login functionality)
session_start();

// Add any PHP logic for handling form submissions here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['student_signin'])) {
        // Handle student login
        $student_id = $_POST['student_name'];
        $student_password = $_POST['student_pass'];
        // Add your authentication logic here
    } elseif (isset($_POST['lecturer_signin'])) {
        // Handle lecturer login
        $lecturer_id = $_POST['lecturer_name'];
        $lecturer_password = $_POST['lecturer_pass'];
        // Add your authentication logic here
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProBookSys - Sign In</title>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <style>
        /* Your CSS styles here (unchanged) */
        :root {
            --primary-color: #1c62c4; /* Muted dark color */
            --secondary-color: #1c62c4; /* Muted grey-blue color */
            --accent-color: #00acc1; /* Subtle accent */
            --text-color: #212121;
            --light-bg: #eceff1;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--light-bg);
            background-image: url('./assets/images/hero-bg.jpeg');
            background-size: cover;
            background-position: center;
            color: var(--text-color);
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            backdrop-filter: blur(5px);
        }

        .signin-content {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 1.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .signin-image {
            background-color: var(--primary-color);
            padding: 5rem;
            text-align: center;
            color: white;
        }

        .signin-image img {
            max-width: 100%;
            border-radius: 50%;
            animation: zoomIn 1s ease-in-out;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .signin-form {
            padding: 2rem;
        }

        .form-title {
            color: var(--primary-color);
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }

        .form-group input {
            padding-left: 35px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-submit {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .form-submit:hover {
            background-color: var(--primary-color);
        }

        .social-login {
            text-align: center;
            margin-top: 2rem;
        }

        .socials {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .socials li {
            margin: 0 10px;
        }

        .socials a {
            color: var(--secondary-color);
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .socials a:hover {
            color: var(--accent-color);
        }

        .signin-separator {
            text-align: center;
            margin: 2rem 0;
            color: var(--primary-color);
        }

        .signin-separator:before,
        .signin-separator:after {
            content: "";
            display: inline-block;
            width: 25%;
            height: 1px;
            background-color: var(--primary-color);
            vertical-align: middle;
            margin: 0 10px;
        }

        .tab-content {
            display: none;
            animation: fadeIn 1s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        .tab-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .tab-buttons button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .tab-buttons button:hover,
        .tab-buttons button.active {
            background-color: var(--primary-color);
        }
    </style>
</head>

<body>

    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="row signin-content">
                    <div class="col-md-6 signin-image">
                        <figure><img src="assets/images/signin-image.jpg" alt="sign in image"></figure>
                    </div>

                    <div class="col-md-6 signin-form">
                        <h2 class="form-title">Sign in</h2>

                        <!-- Tab Buttons -->
                        <div class="tab-buttons">
                            <button id="student-tab" class="active">Student Sign-In</button>
                            <button id="lecturer-tab">Lecturer Sign-In</button>
                        </div>
                        <div class="text-danger pb-2 text-center">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>

                        <!-- Student Sign In Form -->
                        <div id="student-content" class="tab-content active">
                            <form method="POST" class="register-form" id="student-login-form">
                                <div class="form-group">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="student_name" id="student_name" placeholder="Student ID"
                                        class="form-control" />
                                </div>
                                <div class="form-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="student_pass" id="student_pass" placeholder="Password"
                                        class="form-control" />
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="remember-student" id="remember-student"
                                        class="form-check-input" />
                                    <label for="remember-student" class="form-check-label">Remember me</label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="student_signin" id="student_signin" class="form-submit"
                                        value="Log in" />
                                </div>
                            </form>
                        </div>

                        <!-- Lecturer Sign In Form -->
                        <div id="lecturer-content" class="tab-content">
                            <form method="POST" class="register-form" id="lecturer-login-form" action="./auth/signin.php">
                                <div class="form-group">
                                    <i class="fas fa-user"></i>
                                    <input type="text" name="email" id="lecturer_name"
                                        placeholder="Lecturer ID" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" name="password" id="lecturer_pass" placeholder="Password"
                                        class="form-control" />
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" name="remember" id="remember-lecturer"
                                        class="form-check-input" />
                                    <label for="remember-lecturer" class="form-check-label">Remember me</label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="lecturer_signin" id="lecturer_signin" class="form-submit"
                                        value="Log in" />
                                </div>
                            </form>
                        </div>

                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Your JavaScript code here (unchanged)
        const studentTab = document.getElementById('student-tab');
        const lecturerTab = document.getElementById('lecturer-tab');
        const studentContent = document.getElementById('student-content');
        const lecturerContent = document.getElementById('lecturer-content');

        studentTab.addEventListener('click', function () {
            studentTab.classList.add('active');
            lecturerTab.classList.remove('active');
            studentContent.classList.add('active');
            lecturerContent.classList.remove('active');
        });

        lecturerTab.addEventListener('click', function () {
            lecturerTab.classList.add('active');
            studentTab.classList.remove('active');
            lecturerContent.classList.add('active');
            studentContent.classList.remove('active');
        });

    </script>
</body>

</html>