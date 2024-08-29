<?php require_once('../../config/_init_.php');

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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>Cancel Appointments</h2>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Here you would typically fetch appointments from a database
                            // For demonstration, we'll use a static example
                            $appointments = [
                                ['id' => 1, 'student' => 'Michael Brown', 'date' => '2024-08-22', 'time' => '10:00 AM']
                            ];

                            foreach ($appointments as $appointment) {
                                echo "<tr>
                                    <td>{$appointment['id']}</td>
                                    <td>{$appointment['student']}</td>
                                    <td>{$appointment['date']}</td>
                                    <td>{$appointment['time']}</td>
                                    <td>
                                        <button class='btn btn-sm btn-danger' onclick='confirmCancel({$appointment['id']})'>Cancel</button>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('theme-toggle').addEventListener('click', function () {
            document.body.classList.toggle('dark-theme');
        });

        document.getElementById('sidebar-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });

        function confirmCancel(id) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                // Add cancellation logic here
                alert('Appointment cancelled');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>