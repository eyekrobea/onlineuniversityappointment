<?php
// Start the session (if needed for user authentication)
session_start();

// You might want to include any necessary PHP files here
// include 'config.php';
// include 'functions.php';

// Check if user is logged in as admin (implement your own logic)
// if (!isAdminLoggedIn()) {
//     header('Location: login.php');
//     exit();
// }

// Handle form submissions and database operations here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle different form submissions based on the action
    // For example:
    // if (isset($_POST['save_general_settings'])) {
    //     saveGeneralSettings($_POST);
    // } elseif (isset($_POST['add_appointment_type'])) {
    //     addAppointmentType($_POST);
    // }
    // ... and so on for other form submissions
}

// Fetch any necessary data from the database
// $generalSettings = fetchGeneralSettings();
// $appointmentTypes = fetchAppointmentTypes();
// $faculties = fetchFaculties();
// $departments = fetchDepartments();
// $notificationSettings = fetchNotificationSettings();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProBookSys - Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* CSS styles remain the same as in the HTML version */
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
    <!-- Sidebar content -->
    <div id="sidebar">
        <div class="p-3">
            <h3>ProBookSys</h3>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="admin-dashboard.php" class="nav-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-users"></i> Manage Users</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add-lecturer.php"><i class="fas fa-user-plus"></i> Add Lecture</a></li>
                        <li><a class="dropdown-item" href="faculty.php"><i class="fas fa-chalkboard-teacher"></i> Faculty</a></li>
                        <li><a class="dropdown-item" href="department.php"><i class="fas fa-building"></i> Department</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="manage-appointments.php" class="nav-link"><i class="fas fa-calendar-alt"></i> Manage Appointments</a></li>
                <li class="nav-item"><a href="system-configuration.php" class="nav-link"><i class="fas fa-cogs"></i> System Configuration</a></li>
                <li class="nav-item"><a href="reports.php" class="nav-link"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li class="nav-item"><a href="notifications.php" class="nav-link"><i class="fas fa-bell"></i> Notifications</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </div>

    <div id="content">
        <!-- Navbar content -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <!-- Navbar content remains the same -->
            <div class="container-fluid">
                <span id="sidebar-toggle" class="me-3"><i class="fas fa-bars"></i></span>
                <a class="navbar-brand" href="#">Admin Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user"></i> Admin User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="theme-toggle"><i class="fas fa-moon"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h2>System Configuration</h2>
            
            <ul class="nav nav-tabs" id="configTabs" role="tablist">
                <!-- Tab navigation remains the same -->
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="appointments-tab" data-bs-toggle="tab" data-bs-target="#appointments" type="button" role="tab" aria-controls="appointments" aria-selected="false">Appointment Types</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="structure-tab" data-bs-toggle="tab" data-bs-target="#structure" type="button" role="tab" aria-controls="structure" aria-selected="false">Faculty & Department Structure</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab" aria-controls="notifications" aria-selected="false">Notifications</button>
                </li>
            </ul>
            
            <div class="tab-content mt-3" id="configTabsContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <form id="generalSettingsForm" method="POST" action="">
                        <!-- Add a hidden input for identifying the form -->
                        <input type="hidden" name="action" value="save_general_settings">
                        <div class="mb-3">
                            <label for="siteName" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="siteName" name="site_name" value="<?php echo htmlspecialchars($generalSettings['site_name'] ?? 'ProBookSys'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="adminEmail" class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="adminEmail" name="admin_email" value="<?php echo htmlspecialchars($generalSettings['admin_email'] ?? 'admin@probooksys.com'); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="timeZone" class="form-label">Default Time Zone</label>
                            <select class="form-select" id="timeZone" name="time_zone">
                                <?php
                                $timeZones = ['UTC', 'America/New_York', 'America/Chicago', 'America/Denver', 'America/Los_Angeles'];
                                foreach ($timeZones as $tz) {
                                    $selected = ($generalSettings['time_zone'] ?? 'UTC') == $tz ? 'selected' : '';
                                    echo "<option value=\"$tz\" $selected>$tz</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="maintenanceMode" name="maintenance_mode" <?php echo ($generalSettings['maintenance_mode'] ?? false) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="maintenanceMode">Maintenance Mode</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Save General Settings</button>
                    </form>
                </div>
                
                <!-- Other tab panes (appointments, structure, notifications) remain largely the same -->
                <div class="tab-pane fade" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
                    <h4>Manage Appointment Types</h4>
                    <form id="appointmentTypeForm" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="appointmentTypeName" placeholder="Appointment Type Name" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="appointmentDuration" placeholder="Duration (minutes)" required>
                            </div>
                            <div class="col-md-3">
                                <input type="color" class="form-control form-control-color" id="appointmentColor" value="#3f51b5" title="Choose appointment color">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Add</button>
                            </div>
                        </div>
                    </form>
                    <table class="table" id="appointmentTypesTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Duration</th>
                                <th>Color</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Appointment types will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
                
                <div class="tab-pane fade" id="structure" role="tabpanel" aria-labelledby="structure-tab">
                    <h4>Faculty & Department Structure</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Faculties</h5>
                            <ul id="facultyList" class="list-group">
                                <!-- Faculties will be dynamically added here -->
                            </ul>
                            <form id="addFacultyForm" class="mt-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="New Faculty Name" required>
                                    <button class="btn btn-primary" type="submit">Add Faculty</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h5>Departments</h5>
                            <ul id="departmentList" class="list-group">
                                <!-- Departments will be dynamically added here -->
                            </ul>
                            <form id="addDepartmentForm" class="mt-3">
                                <div class="input-group">
                                    <select class="form-select" id="facultySelect" required>
                                        <option value="">Select Faculty</option>
                                        <!-- Faculty options will be dynamically added here -->
                                    </select>
                                    <input type="text" class="form-control" placeholder="New Department Name" required>
                                    <button class="btn btn-primary" type="submit">Add Department</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
                    <h4>Notification Settings</h4>
                    <form id="notificationSettingsForm">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="emailNotifications" checked>
                            <label class="form-check-label" for="emailNotifications">Enable Email Notifications</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="smsNotifications">
                            <label class="form-check-label" for="smsNotifications">Enable SMS Notifications</label>
                        </div>
                        <div class="mb-3">
                            <label for="reminderTime" class="form-label">Appointment Reminder Time</label>
                            <select class="form-select" id="reminderTime">
                                <option value="15">15 minutes before</option>
                                <option value="30">30 minutes before</option>
                                <option value="60">1 hour before</option>
                                <option value="1440">1 day before</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="notificationTemplate" class="form-label">Notification Template</label>
                            <textarea class="form-control" id="notificationTemplate" rows="3">Your appointment is scheduled for {DATE} at {TIME}. Please arrive 5 minutes early.</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Notification Settings</button>
                    </form>
                </div>
                <!-- You would replace static content with PHP to populate data from the database -->
                
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript remains largely the same
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
        // General Settings
        document.getElementById('generalSettingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add logic to save general settings
            alert('General settings saved successfully!');
        });

        // Appointment Types
        document.getElementById('appointmentTypeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('appointmentTypeName').value;
            const duration = document.getElementById('appointmentDuration').value;
            const color = document.getElementById('appointmentColor').value;
            addAppointmentType(name, duration, color);
            this.reset();
        });

        function addAppointmentType(name, duration, color) {
            const tableBody = document.querySelector('#appointmentTypesTable tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${name}</td>
                <td>${duration} minutes</td>
                <td><span class="badge" style="background-color: ${color};">${color}</span></td>
                <td>
                    <button class="btn btn-sm btn-primary edit-btn">Edit</button>
                    <button class="btn btn-sm btn-danger delete-btn">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        }

        // Faculty & Department Structure
        document.getElementById('addFacultyForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const facultyName = this.querySelector('input').value;
            addFaculty(facultyName);
            this.reset();
        });

        document.getElementById('addDepartmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const facultyId = document.getElementById('facultySelect').value;
            const departmentName = this.querySelector('input').value;
            addDepartment(facultyId, departmentName);
            this.reset();
        });

        function addFaculty(name) {
            const facultyList = document.getElementById('facultyList');
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                ${name}
                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
            `;
            facultyList.appendChild(li);

            // Also add to faculty select dropdown
            const option = document.createElement('option');
            option.value = name.toLowerCase().replace(/\s+/g, '-');
            option.textContent = name;
            document.getElementById('facultySelect').appendChild(option);
        }

        function addDepartment(facultyId, name) {
            const departmentList = document.getElementById('departmentList');
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                ${name} <span class="badge bg-primary">${facultyId}</span>
                <button class="btn btn-sm btn-danger delete-btn">Delete</button>
            `;
            departmentList.appendChild(li);
        }

        // Notification Settings
        document.getElementById('notificationSettingsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add logic to save notification settings
            alert('Notification settings saved successfully!');
        });

        // Initialize with some sample data
        addAppointmentType('Regular Consultation', 30, '#3f51b5');
        addAppointmentType('Extended Consultation', 60, '#4caf50');
        addFaculty('Science and Engineering');
        addFaculty('Arts and Humanities');
        addDepartment('science-and-engineering', 'Computer Science');
        addDepartment('arts-and-humanities', 'History');
        // You might need to adjust some parts to work with server-side data
    </script>
</body>
</html>