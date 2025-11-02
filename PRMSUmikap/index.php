<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PRMSUmikap</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9fafb;
      color: #1f2937;
    }
    .navbar-brand {
      font-weight: 700;
      color: #2563eb !important;
    }
    .navbar-brand:hover {
      color: #1d4ed8 !important;
    }
    .btn-primary {
      background-color: #2563eb;
      border-color: #2563eb;
    }
    .btn-primary:hover {
      background-color: #1d4ed8;
      border-color: #1d4ed8;
    }
    footer {
      background-color: white;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">PRMSUmikap</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-secondary" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="jobs.html">Jobs</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="about.html">About</a></li>

          <!-- Example: logged-out version -->
          <li class="nav-item">
            <a href="login.html" class="btn btn-outline-primary me-2 fw-semibold">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
 <main class="py-5">
  <div class="container">
    <div class="card shadow-sm border-0 text-center mb-5 d-flex flex-column justify-content-center" style="height: 500px;">
      <h1 class="fw-bold text-primary">Welcome to PRMSUmikap</h1>
      <p class="mt-3 text-secondary fs-5">
        A web-based platform for PRMSU students to find part-time jobs that fit their skills and academic schedules.
      </p>
    <!-- Search Bar Section -->
    <div class="d-flex justify-content-center mt-4 mb-5">
        <div class="d-flex w-75 justify-content-center" style="max-width: 600px; gap: 10px;">
         <input type="text" class="form-control border-primary rounded px-3" placeholder="Search for jobs, skills, or locations..." aria-label="Search">
         <button class="btn btn-primary fw-semibold rounded px-4" type="button">Search</button>
        </div>
    </div>

       <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
            <a href="login.html" class="btn btn-primary fw-semibold">I'm a Student</a>
            <a href="register.html" class="btn btn-outline-primary me-2 fw-semibold">I'm an Employer</a>
        </li>
        </ul>
    </div>

    <!-- Inner container section -->
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body text-center">
            <h5 class="card-title text-primary fw-semibold">Student Opportunities</h5>
            <p class="card-text text-secondary">
              Find part-time jobs that match your academic schedule and interests.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body text-center">
            <h5 class="card-title text-primary fw-semibold">Employer Access</h5>
            <p class="card-text text-secondary">
              Post openings, review applications, and hire qualified PRMSU students.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body text-center">
            <h5 class="card-title text-primary fw-semibold">Secure & Reliable</h5>
            <p class="card-text text-secondary">
              A university-verified platform designed for trustworthy student employment.
            </p>
          </div>
        </div>
      </div>

      <h3 class="fw-bold text-secondary text-center"> Get Started in 3 Easy Steps</h3>

       <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body text-center">
            <h6 class="card-title fw-semibold">1. Sign Up</h6>
            <p class="card-text text-secondary">
              Create an account as a student or employer.
            </p>
          </div>
        </div>
      </div>

       <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body text-center">
            <h6 class="card-title fw-semibold">2. Connect</h6>
            <p class="card-text text-secondary">
              Students browse jobs while employers post openings.
            </p>
          </div>
        </div>
      </div>

     <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-body text-center">
            <h6 class="card-title fw-semibold">3. Get Hired</h6>
            <p class="card-text text-secondary">
              Start working, gain experience, and grow your career.
            </p>
          </div>
        </div>
      </div>


    </div>
  </div>

</main>

  <!-- Footer -->
  <footer class="mt-5 py-4">
    <div class="container text-center text-muted small">
      &copy; 2025 PRMSUmikap. All rights reserved.<br>
      <a href="about.html" class="text-decoration-none text-secondary">About</a> |
      <a href="privacy.html" class="text-decoration-none text-secondary">Privacy Policy</a>
    </div>
  </footer>

</body>
</html>
