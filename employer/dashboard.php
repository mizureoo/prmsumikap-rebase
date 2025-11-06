<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: ../auth/login.php?error=" . urlencode("Unauthorized access."));
    exit;
}

$employerName = $_SESSION['name'];  
$accountType = ucfirst($_SESSION['role']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employer Dashboard | PRMSUmikap</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/layout.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>

    <?php include __DIR__. '/../includes/sidebar.php'; ?>

    <div id="main-content">
        <div class="welcome-card mb-4">
            <small class="opacity-75">✦ Welcome Back ✦</small>
            <h1 class="display-5 fw-bold mt-2">Hello, <?php echo htmlspecialchars($employerName); ?>!</h1>
            <p class="fs-5">Ready to find your next great hire?</p>
            <div class="d-flex flex-wrap gap-3 mt-3">
                <button class="btn btn-light text-primary rounded-pill px-4 py-2 fw-bold">
                     <i class="bi bi-plus-circle me-2"></i> Post a New Job
                </button>
                <a href="manage_jobs.php" class="btn btn-outline-light rounded-pill fw-semibold px-4 py-2">
                    <i class="bi bi-briefcase me-2"></i> Manage Posted Jobs
                </a>
                <button class="btn btn-light rounded-pill px-4 py-2 opacity-50">Complete Profile</button>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="row mb-4 g-4">
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <i class="bi bi-file-earmark-text-fill fs-2 text-primary"></i>
                    <div>
                        <h5 class="text-muted mb-1">Active Jobs</h5>
                        <h2 class="fw-bold mb-0">0</h2>
                        <p class="text-muted mb-0">0 active</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <i class="bi bi-graph-up fs-2 text-info"></i>
                    <div>
                        <h5 class="text-muted mb-1">New Applications</h5>
                        <h2 class="fw-bold mb-0">0</h2>
                        <p class="text-success mb-0">This Week</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <i class="bi bi-bookmark-fill fs-2 text-primary"></i>
                    <div>
                        <h5 class="text-muted mb-1">Short Listed</h5>
                        <h2 class="fw-bold mb-0">0</h2>
                        <p class="text-muted mb-0">Ready for Interviews</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RECENT APPLICATIONS & FOR YOU -->
        <div class="row mb-5">
        <div class="col-lg-15">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold"><i class="bi bi-clock-history me-2"></i> Recent Posted Jobs</h4>
            <a href="#" class="text-decoration-none fw-bold">View All <i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="text-center p-5 bg-white rounded-3 shadow-sm">
            <i class="bi bi-file-earmark-text display-4 text-muted"></i>
            <p class="mt-3 text-muted">No new jobs yet.</p>
          </div>
        </div>
      </div>

      <!-- RECENT APPLICANTS -->
      <div class="row">
        <div class="col-lg-15">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold"><i class="bi bi-person-lines-fill me-2"></i> Recent Applicants</h4>
            <a href="#" class="text-decoration-none fw-bold">View All <i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="text-center p-5 bg-white rounded-3 shadow-sm">
            <i class="bi bi-file-earmark-text display-4 text-muted"></i>
            <p class="mt-3 text-muted">No new applications yet.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
