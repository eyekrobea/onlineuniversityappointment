<?php
// Start the session (if needed for login functionality)
session_start();

// Add any PHP logic for handling form submissions here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['admin_signin'])) {
        // Handle admin login
        $admin_id = $_POST['admin_id'];
        $admin_password = $_POST['admin_password'];
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
    <title>ProBookSys - Admin Sign In</title>

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
            --primary-color: #1c62c4;
            --secondary-color: #1c62c4;
            --accent-color: #00acc1;
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
    </style>
</head>

<body>

    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="row signin-content">
                    <div class="col-md-6 signin-image">
                        <figure><img src="assets/images/" alt="admin sign in image"></figure>
                    </div>

                    <div class="col-md-6 signin-form">
                        <h2 class="form-title">Admin Sign in</h2>

                        <div class="text-danger pb-2 text-center">
                            <?php
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            }
                            ?>
                        </div>

                        <!-- Admin Sign In Form -->
                        <form method="POST" class="register-form" id="admin-login-form" action="requests/auth/admin-signin.php">
                            <div class="form-group">
                                <i class="fas fa-user-shield"></i>
                                <input type="text" name="admin_id" id="admin_id" placeholder="Admin ID"
                                    class="form-control" required />
                            </div>
                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="admin_password" id="admin_password" placeholder="Password"
                                    class="form-control" required />
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" name="remember-admin" id="remember-admin"
                                    class="form-check-input" />
                                <label for="remember-admin" class="form-check-label">Remember me</label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="admin_signin" id="admin_signin" class="form-submit"
                                    value="Log in" />
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="signin.php" class="text-primary">Back to User Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>