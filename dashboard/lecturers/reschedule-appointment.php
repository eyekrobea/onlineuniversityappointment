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

$appointments = [
    ['id' => 1, 'student' => 'Michael Brown', 'date' => '2024-08-22', 'time' => '10:00 AM']
    // Add more appointments as needed
];
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
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>Reschedule Appointments</h2>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Current Date</th>
                                <th>Current Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($appointment['id']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['student']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['date']); ?></td>
                                <td><?php echo htmlspecialchars($appointment['time']); ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#rescheduleModal" data-appointment-id="<?php echo $appointment['id']; ?>">Reschedule</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
        <!-- Reschedule Modal -->
        <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rescheduleModalLabel">Reschedule Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="rescheduleForm" method="post">
                            <input type="hidden" id="appointmentId" name="appointmentId">
                            <div class="mb-3">
                                <label for="newDate" class="form-label">New Date</label>
                                <input type="date" class="form-control" id="newDate" name="newDate" required>
                            </div>
                            <div class="mb-3">
                                <label for="newTime" class="form-label">New Time</label>
                                <input type="time" class="form-control" id="newTime" name="newTime" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
        });

        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });

        // Set appointment ID when opening the modal
        var rescheduleModal = document.getElementById('rescheduleModal')
        rescheduleModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var appointmentId = button.getAttribute('data-appointment-id')
            var modalInput = rescheduleModal.querySelector('#appointmentId')
            modalInput.value = appointmentId
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>