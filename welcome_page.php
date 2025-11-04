<?php include 'includes/header.php'; ?>
<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link text-secondary" href="welcome_page.php">Home</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="pages/job_listing.php">Jobs</a></li>
          <li class="nav-item"><a class="nav-link text-secondary" href="pages/about.php">About</a></li>
          <li class="nav-item">
            <a href="auth/login.php" class="btn btn-outline-primary me-2 fw-semibold">Login</a>
          </li>
        </ul>
      </div>

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

    <div class="mt-3">
      <a href="auth/student_register.php" class="btn btn-primary fw-semibold">I'm a Student</a>
      <a href="auth/employer_register.php" class="btn btn-outline-primary fw-semibold ms-2">I'm an Employer</a>
    </div>
  </div>

  <!-- Info Cards -->
  <div class="row g-4 justify-content-center">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <h5 class="card-title text-primary fw-semibold">Student Opportunities</h5>
          <p class="card-text text-secondary">Find part-time jobs that match your academic schedule and interests.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <h5 class="card-title text-primary fw-semibold">Employer Access</h5>
          <p class="card-text text-secondary">Post openings, review applications, and hire qualified PRMSU students.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <h5 class="card-title text-primary fw-semibold">Secure & Reliable</h5>
          <p class="card-text text-secondary">A university-verified platform designed for trustworthy student employment.</p>
        </div>
      </div>
    </div>
  </div>

  <h3 class="fw-bold text-secondary text-center mt-5">Get Started in 3 Easy Steps</h3>

  <div class="row g-4 justify-content-center mt-3">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <h6 class="card-title fw-semibold">1. Sign Up</h6>
          <p class="card-text text-secondary">Create an account as a student or employer.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <h6 class="card-title fw-semibold">2. Connect</h6>
          <p class="card-text text-secondary">Students browse jobs while employers post openings.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <h6 class="card-title fw-semibold">3. Get Hired</h6>
          <p class="card-text text-secondary">Start working, gain experience, and grow your career.</p>
        </div>
      </div>
    </div>
  </div>

<?php include 'includes/footer.php'; ?>
