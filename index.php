<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ProBookSys - Ghana Communication Technology University</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet" />
  <!-- AOS CSS for scroll animations -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <style>
    /* CSS styles */
    :root {
      --primary-color: #1a237e;
      --secondary-color: #3f51b5;
      --accent-color: #00bcd4;
      --text-color: #212121;
      --light-bg: #f5f5f5;
    }

    body {
      font-family: 'Roboto', sans-serif;
      color: var(--text-color);
      overflow-x: hidden;
    }

    .navbar {
      background-color: rgba(26, 35, 126, 0.9);
      backdrop-filter: blur(10px);
      transition: all 0.3s ease;
    }

    .navbar-brand,
    .nav-link {
      color: white !important;
      transition: all 0.3s ease;
    }

    .nav-link:hover {
      color: var(--accent-color) !important;
    }

    .btn-primary {
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .hero {
      background: linear-gradient(rgba(26, 35, 126, 0.7), rgba(26, 35, 126, 0.7)),
                  url("./assets/images/hero-bg.jpeg") no-repeat center center;
      background-size: cover;
      color: white;
      padding: 130px 0;
      position: relative;
      overflow: hidden;
    }

    .hero-content {
      position: relative;
      padding-top: 6%;
      z-index: 2;
    }

    .hero h1 {
      font-size: 4.5rem;
      font-weight: 700;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
      margin-bottom: 1.5rem;
      animation: fadeInDown 1s ease-out;
    }

    .hero p {
      font-size: 1.5rem;
      max-width: 600px;
      margin: 0 auto 2rem;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
      animation: fadeInUp 1s ease-out 0.5s;
      animation-fill-mode: both;
    }

    .hero .btn-primary {
      padding: 12px 30px;
      font-size: 1.1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 600;
      transition: all 0.3s ease;
      animation: fadeInUp 1s ease-out 1s;
      animation-fill-mode: both;
    }

    .hero .btn-primary:hover {
      background-color: var(--accent-color);
      border-color: var(--accent-color);
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .feature-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      color: var(--accent-color);
      transition: all 0.3s ease;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .card:hover .feature-icon {
      transform: scale(1.1);
    }

    footer {
      background-color: var(--primary-color);
      color: white;
      padding: 70px 0;
    }

    .footer-logo {
      max-width: 200px;
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .footer-logo:hover {
      transform: scale(1.05);
    }

    .social-icons a {
      color: white;
      font-size: 1.5rem;
      margin-right: 15px;
      transition: all 0.3s ease;
    }

    .social-icons a:hover {
      color: var(--accent-color);
      transform: translateY(-3px);
    }

    .footer-links a {
      color: #ccc;
      text-decoration: none;
      transition: all 0.3s ease;
      display: block;
      margin-bottom: 10px;
    }

    .footer-links a:hover {
      color: white;
      transform: translateX(5px);
    }

    .chart-container {
      position: relative;
      margin: auto;
      height: 300px;
      width: 100%;
    }

    .section-title {
      position: relative;
      display: inline-block;
      padding-bottom: 10px;
      margin-bottom: 30px;
      color: var(--primary-color);
    }

    .section-title::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 50px;
      height: 3px;
      background-color: var(--accent-color);
      transition: all 0.3s ease;
    }

    .section-title:hover::after {
      width: 100%;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fas fa-calendar-alt me-2"></i>ProBookSys</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item">
            <a class="nav-link" href="#features">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#stats">Stats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>
        <a href="login.php" class="btn btn-light ms-3">Sign in</a>
      </div>
    </div>
  </nav>

  <section id="home" class="hero text-center">
    <div class="container hero-content">
      <h1 class="mb-4" data-aos="fade-up">ProBookSys</h1>
      <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
        Ghana Communication Technology University's Advanced Online Appointment Booking System
      </p>
      <a href="#book" class="btn btn-primary btn-lg" data-aos="fade-up" data-aos-delay="200">
        Get Started <i class="fas fa-arrow-right ms-2"></i>
      </a>
    </div>
  </section>

  <section id="features" class="py-5">
    <div class="container">
      <h2 class="text-center section-title mb-5" data-aos="fade-up">
        Our Features
      </h2>
      <!-- Feature cards -->
      <div class="row">
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="card h-100 text-center p-4">
            <i class="fas fa-calendar-check feature-icon"></i>
            <h3>Easy Booking</h3>
            <p>Schedule appointments with just a few clicks.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="card h-100 text-center p-4">
            <i class="fas fa-comments feature-icon"></i>
            <h3>Feedback System</h3>
            <p>Provide and receive valuable feedback after each session.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
          <div class="card h-100 text-center p-4">
            <i class="fas fa-tachometer-alt feature-icon"></i>
            <h3>Admin Dashboard</h3>
            <p>Manage appointments and users efficiently.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="stats" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center section-title mb-5" data-aos="fade-up">
        Our Impact
      </h2>
      <div class="row">
        <div class="col-md-6 mb-4" data-aos="fade-right">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Monthly Appointments</h5>
              <div class="chart-container">
                <canvas id="appointmentsChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4" data-aos="fade-left">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User Satisfaction</h5>
              <div class="chart-container">
                <canvas id="satisfactionChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="about" class="py-5">
    <div class="container">
      <h2 class="text-center section-title mb-5" data-aos="fade-up">
        About Us
      </h2>
      <div class="row">
        <div class="col-md-6" data-aos="fade-right">
          <p>
            ProBookSys is an innovative online appointment booking system
            developed by Ghana Communication Technology University. Our goal
            is to streamline the appointment scheduling process for students,
            faculty, and staff, making it more efficient and user-friendly.
          </p>
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <p>
            Our system allows users to book appointments, receive
            notifications, and provide feedback with ease. With a robust admin
            dashboard, ProBookSys ensures that appointments are managed
            effectively, contributing to better time management and overall
            satisfaction.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="contact" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center section-title mb-5" data-aos="fade-up">
        Contact Us
      </h2>
      <div class="row">
        <div class="col-md-6 mb-4" data-aos="fade-right">
          <form>
            <!-- Contact form fields -->
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" required />
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
              Send Message
            </button>
          </form>
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <address>
            <!-- Contact information -->
            <p>
              <i class="fas fa-map-marker-alt me-2"></i>PMB 100, Tesano,
              Accra, Ghana
            </p>
            <p><i class="fas fa-envelope me-2"></i>info@gctu.edu.gh</p>
            <p><i class="fas fa-phone me-2"></i>(+233) 302-221-412</p>
          </address>
        </div>
      </div>
    </div>
  </section>

  <footer class="text-center text-md-start text-white py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4">
        <img src="assets/images/icons.png" alt="ProBookSys" style="width: 48px; height: 48px;"> 
        <p>This is the text that will appear alongside the image.</p>
        <p class="mt-3">
          ProBookSys is a premier appointment scheduling system tailored for
          Ghana Communication Technology University. Our goal is to
          streamline the booking process and enhance user satisfaction
          through innovative features and a user-friendly interface.
        </p>
      </div>
      <div class="col-md-3 mb-4">
        <h5 class="mb-4">Quick Links</h5>
        <div class="footer-links">
          <a href="#home">Home</a>
          <a href="#features">Features</a>
          <a href="#stats">Stats</a>
          <a href="#about">About</a>
          <a href="#contact">Contact</a>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <h5 class="mb-4">Contact Info</h5>
        <address>
          <p>
            <i class="fas fa-map-marker-alt me-2"></i>PMB 100, Tesano,
            Accra, Ghana
          </p>
          <p><i class="fas fa-envelope me-2"></i>info@gctu.edu.gh</p>
          <p><i class="fas fa-phone me-2"></i>(+233) 302-221-412</p>
        </address>
      </div>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <a href="./admin-login.php" class="btn btn-light btn-sm">
        <i class="fas fa-user-shield me-2"></i>Admin Login
      </a>
    </div>
  </div>
</footer>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS for scroll animations -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- Chart.js for charts in the stats section -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Initialize AOS -->
  <script>
    AOS.init();
  </script>
  <!-- Custom JS -->
  <script>
    // Sample data for charts
    const appointmentsChart = document
      .getElementById("appointmentsChart")
      .getContext("2d");
    const satisfactionChart = document
      .getElementById("satisfactionChart")
      .getContext("2d");

    new Chart(appointmentsChart, {
      type: "line",
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        datasets: [
          {
            label: "Appointments",
            data: [12, 19, 3, 5, 2, 3, 10],
            backgroundColor: "rgba(0, 188, 212, 0.2)",
            borderColor: "rgba(0, 188, 212, 1)",
            borderWidth: 2,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });

    new Chart(satisfactionChart, {
      type: "pie",
      data: {
        labels: ["Satisfied", "Neutral", "Unsatisfied"],
        datasets: [
          {
            label: "Satisfaction",
            data: [85, 10, 5],
            backgroundColor: [
              "rgba(63, 81, 181, 0.7)",
              "rgba(255, 193, 7, 0.7)",
              "rgba(244, 67, 54, 0.7)",
            ],
            borderColor: [
              "rgba(63, 81, 181, 1)",
              "rgba(255, 193, 7, 1)",
              "rgba(244, 67, 54, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
      },
    });

  </script>
</body>

</html>