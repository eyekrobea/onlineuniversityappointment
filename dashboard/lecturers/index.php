<?php require_once('../../config/_init_.php') ?>
<?php

use Models\Lecturer;
use SannyTech\Exceptions\DatabaseException;
global $help, $db, $session, $cookie;

    #if($help::get('key') !== 'codester') {
    if(!$cookie->isSignedIn() && !$session->isSignedIn()) {
        $session->message('Please Login to access this page');
        $help::redirect(base_url() . 'login.php');
    }
    #}

    try {
        # Grab User login in Info
        if($cookie->isSignedIn()){
            $lecturer = Lecturer::findById($cookie->user());
        } else {
            $lecturer = Lecturer::findById($session->user());
        }
        if(!$lecturer || $lecturer->role != 'lecturer'){
            $session->signOut(); $cookie->signOut();
            $session->message('Invalid User, Please Login Again');
            $help::redirect(base_url() . 'login.php');
        }

    } catch (DatabaseException|\Throwable $e) {
        $help::productionErrorLog($e, '../../logs/error.log', 3, 'Lecturer Dashboard');
        $session->signOut(); $cookie->signOut(); $session->message('Error Occurred From Our End, Please Try Again Later');
        $help::redirect(base_url() . 'login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once("partials/_head.php"); ?>
<body>
    <?php include_once("partials/_sidebar.php"); ?>

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
                            <a class="nav-link" href="#"><i class="fas fa-user"></i> <?= $lecturer?->name ?></a>
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

    <?php include_once("partials/_scripts.php"); ?>
</body>
</html>