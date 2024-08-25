<?php 
ob_start();
// Start the session (if needed for login functionality)
session_start();

// Add any PHP logic for authentication or data retrieval here
// For example:
if (!isset($_SESSION['user']) && $_SESSION['user']->role !== 'lecturer') {
    header('Location: ./../../sign-in.php');
    exit();
}

$lecturer = $_SESSION['user'];
// Fetch appointments, student data, etc. from the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProBookSys - Lecturer Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Your CSS styles here (unchanged) */
        :root {
            --primary-color: #1a237e;
            --secondary-color: #3f51b5;
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
            --primary-color: #3f51b5;
            --secondary-color: #1a237e;
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

        .dropdown-menu {
            background-color: var(--primary-color);
        }

        .dropdown-item {
            color: white;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div class="p-3">
            <h3>ProBookSys</h3>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="lecturers-dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a href="view-appointments.php" class="nav-link"><i class="fas fa-calendar-alt"></i> View Appointments</a></li>
                <li class="nav-item"><a href="accept-decline-appointments.php" class="nav-link"><i class="fas fa-check"></i> Accept/Decline Appointments</a></li>
                <li class="nav-item"><a href="reschedule-appointments.php" class="nav-link"><i class="fas fa-calendar"></i> Reschedule Appointments</a></li>
                <li class="nav-item"><a href="cancel-appointments.php" class="nav-link"><i class="fas fa-times"></i> Cancel Appointments</a></li>
                <li class="nav-item"><a href="student-feedback.php" class="nav-link"><i class="fas fa-comment-dots"></i> Feedback from Students</a></li>
                <li class="nav-item"><a href="profile-management.php" class="nav-link"><i class="fas fa-user-cog"></i> Profile Management</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid">
                <span id="sidebar-toggle" class="me-3"><i class="fas fa-bars"></i></span>
                <a class="navbar-brand" href="#">Lecturer Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo isset($lecturer->name) ? htmlspecialchars($lecturer->name) : 'Lecturer Name'; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="theme-toggle"><i class="fas fa-moon"></i></a>
                        </li>
                        <!-- logout -->
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Rest of your HTML content here (unchanged) -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Upcoming Appointments</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pending Requests</h5>
                        <p class="card-text">5</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <p class="card-text">150</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Feedback Rating</h5>
                        <p class="card-text">4.8/5</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Appointments Over Time</h5>
                        <div class="chart-container">
                            <canvas id="appointmentsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Student Distribution</h5>
                        <div class="chart-container">
                            <canvas id="studentDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Appointments</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Michael Brown</td>
                                    <td>2024-08-22</td>
                                    <td>Pending</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Doe</td>
                                    <td>2024-08-20</td>
                                    <td>Confirmed</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>John Smith</td>
                                    <td>2024-08-18</td>
                                    <td>Cancelled</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        // Your JavaScript code here (unchanged)
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
        });

        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });

        const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
        const appointmentsChart = new Chart(appointmentsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                datasets: [{
                    label: 'Appointments',
                    data: [5, 10, 15, 20, 25, 30, 35, 40],
                    backgroundColor: 'rgba(63, 81, 181, 0.5)',
                    borderColor: 'rgba(63, 81, 181, 1)',
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

        const studentDistributionCtx = document.getElementById('studentDistributionChart').getContext('2d');
        const studentDistributionChart = new Chart(studentDistributionCtx, {
            type: 'pie',
            data: {
                labels: ['Freshmen', 'Sophomores', 'Juniors', 'Seniors'],
                datasets: [{
                    label: 'Student Distribution',
                    data: [25, 25, 25, 25],
                    backgroundColor: ['#3f51b5', '#ff9800', '#4caf50', '#f44336']
                }]
            }
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>