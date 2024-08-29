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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user"></i> <?= $lecturer->name ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="theme-toggle"><i class="fas fa-moon"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>Profile Management</h2>
            <!-- message box-->
            <?php if($session->message()) : ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <?= $session->message() ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= base_url() ?>requests/lecturer-update-profile.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $lecturer->name ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $lecturer->email ?>">
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" disabled value="<?= $lecturer->department ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?= $lecturer->gender ?>">
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3"><?= $lecturer->bio ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?= $lecturer->address ?>">
                        </div>
                        <input type="submit" name="lecturer_update" class="btn btn-primary" value="Update Profile"/>
                    </form>
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
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>