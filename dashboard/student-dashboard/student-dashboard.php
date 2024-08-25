<?php
// Static data to simulate dynamic content
$student_name = "John Doe";
$upcoming_appointments = 3;
$pending_feedbacks = 2;
$new_notifications = 5;

// Static data for recent appointments
$recent_appointments = [
    ["date" => "2024-08-15", "lecturer" => "Dr. Smith", "status" => "Completed"],
    ["date" => "2024-08-10", "lecturer" => "Prof. Johnson", "status" => "Canceled"],
    ["date" => "2024-08-05", "lecturer" => "Dr. Williams", "status" => "Scheduled"],
    ["date" => "2024-08-01", "lecturer" => "Dr. Brown", "status" => "Completed"],
    ["date" => "2024-07-28", "lecturer" => "Prof. Davis", "status" => "Completed"]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProBookSys - Student Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* The existing CSS styles remain the same */
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
        /* Add your existing CSS code here */
    </style>
</head>
<body>
    <div id="sidebar">
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
            <div class="container-fluid">
                <span id="sidebar-toggle" class="me-3"><i class="fas fa-bars"></i></span>
                <a class="navbar-brand" href="#">Student Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="notifications.php"><i class="fas fa-bell"></i> Notifications (<?php echo $new_notifications; ?>)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile_management.php"><i class="fas fa-user"></i> <?php echo htmlspecialchars($student_name); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="theme-toggle"><i class="fas fa-moon"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Appointments</h5>
                        <p class="card-text"><?php echo $upcoming_appointments; ?></p>
                        <a href="view_appointments.php" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Feedbacks</h5>
                        <p class="card-text"><?php echo $pending_feedbacks; ?></p>
                        <a href="provide_feedback.php" class="btn btn-primary">Provide Feedback</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Notifications</h5>
                        <p class="card-text"><?php echo $new_notifications; ?></p>
                        <a href="notifications.php" class="btn btn-primary">View Notifications</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointment History</h5>
                        <div class="chart-container">
                            <canvas id="appointmentHistoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Appointments</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Lecturer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                                        <td><?php echo htmlspecialchars($appointment['lecturer']); ?></td>
                                        <td><?php echo htmlspecialchars($appointment['status']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // The existing JavaScript code remains the same
        // Toggle sidebar
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });

        // Toggle dark theme
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
        });

        // Chart.js example - Appointment History
        var ctx = document.getElementById('appointmentHistoryChart').getContext('2d');
        var appointmentHistoryChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Appointments',
                    data: [3, 5, 2, 4, 6, 8],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
