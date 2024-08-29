<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProBookSys - <?php echo $pageTitle; ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Copy the entire style section from your dashboard.html file */
        :root {
            --primary-color: #4caf50;
            --secondary-color: #45a049;
            --text-color: #212121;
            --bg-color: #f5f5f5;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: background-color 0.3s, color 0.3s;
        }

        .dark-theme {
            --primary-color: #66bb6a;
            --secondary-color: #4caf50;
            --text-color: #f5f5f5;
            --bg-color: #212121;
        }

        .dark-theme .card {
            background-color: #333;
            color: #f5f5f5;
        }

        .dark-theme .navbar {
            background-color: #333 !important;
            color: #f5f5f5;
        }

        .dark-theme .navbar-brand,
        .dark-theme .navbar-nav .nav-link {
            color: #f5f5f5;
        }

        .dark-theme .table {
            color: #f5f5f5;
        }

        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--primary-color);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        #sidebar .nav-link {
            color: white;
            transition: all 0.3s;
        }

        #sidebar .nav-link:hover {
            background-color: var(--secondary-color);
        }

        #content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }

        #content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .card {
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        #theme-toggle, #sidebar-toggle {
            cursor: pointer;
        }

        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <!-- Copy the entire sidebar content from your dashboard.html file -->
        <div class="p-3">
            <h3>ProBookSys</h3>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="book_appointment.php" class="nav-link"><i class="fas fa-calendar-plus"></i> Book an Appointment</a></li>
                <li class="nav-item"><a href="view_appointments.php" class="nav-link"><i class="fas fa-calendar-alt"></i> View Appointments</a></li>
                <li class="nav-item"><a href="provide_feedback.php" class="nav-link"><i class="fas fa-comment"></i> Provide Feedback</a></li>
                <li class="nav-item"><a href="notifications.php" class="nav-link"><i class="fas fa-bell"></i> Notifications</a></li>
                <li class="nav-item"><a href="profile_management.php" class="nav-link"><i class="fas fa-user-cog"></i> Profile Management</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link" id="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <!-- Copy the navbar content from your dashboard.html file -->
            <div class="container-fluid">
                <span id="sidebar-toggle" class="me-3"><i class="fas fa-bars"></i></span>
                <a class="navbar-brand" href="#">Student Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="notifications.php"><i class="fas fa-bell"></i> Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile_management.php"><i class="fas fa-user"></i> <?php echo $studentName; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="theme-toggle"><i class="fas fa-moon"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Add page-specific content here -->
        <h2>Provide Feedback</h2>
        <form method="post" action="submit_feedback.php">
            <div class="mb-3">
                <label for="appointment" class="form-label">Select Appointment</label>
                <select class="form-select" id="appointment" name="appointment" required>
                    <option value="">Select an appointment</option>
                    <option value="1">2023-08-20 - Dr. Smith</option>
                    <option value="2">2023-08-25 - Prof. Johnson</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating</label>
                <select class="form-select" id="rating" name="rating" required>
                    <option value="">Select a rating</option>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Very Poor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="feedback" class="form-label">Feedback</label>
                <textarea class="form-control" id="feedback" name="feedback" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Copy the JavaScript from your dashboard.html file
        // Toggle sidebar
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });

        // Toggle dark theme
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
            this.innerHTML = document.body.classList.contains('dark-theme') ? 
                '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            
            // Update chart colors based on theme
            updateChartColors();
        });

        // Remove or modify chart-related code if not needed on this page
    </script>
</body>
</html>
