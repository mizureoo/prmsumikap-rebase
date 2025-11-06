<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php?error=" . urlencode("Unauthorized access."));
    exit;
}

$studentName = $_SESSION['name'];  
$accountType = ucfirst($_SESSION['role']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Portal Dashboard | PRMSUmikap</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/layout.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>

    <?php include '../includes/sidebar.php'; ?>

    <div id="main-content">
        <div class="welcome-card mb-4">
            <small class="opacity-75">✦ Welcome Back ✦</small>
            <h1 class="display-5 fw-bold mt-2">Hello, <?php echo htmlspecialchars($studentName); ?>!</h1>
            <p class="fs-5">Ready to find your next opportunity?</p>
            <div class="d-flex flex-wrap gap-3 mt-3">
                <a href="browse_job.php" class="btn btn-light text-primary rounded-pill px-4 py-2 fw-bold">
                    <i class="bi bi-search me-2"></i> Browse Jobs
                </a>

                <a href="student_profile.php" class="btn btn-light rounded-pill px-4 py-2 opacity-50">
                    Complete Profile
                </a>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="row mb-4 g-4">
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <i class="bi bi-file-earmark-text-fill fs-2 text-primary"></i>
                    <div>
                        <h5 class="text-muted mb-1">Total Applications</h5>
                        <h2 class="fw-bold mb-0">0</h2>
                        <p class="text-muted mb-0">0 active</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <i class="bi bi-graph-up fs-2 text-info"></i>
                    <div>
                        <h5 class="text-muted mb-1">Job Offers</h5>
                        <h2 class="fw-bold mb-0">0</h2>
                        <p class="text-success mb-0">Congratulations! 🎉</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3">
                    <i class="bi bi-bookmark-fill fs-2 text-primary"></i>
                    <div>
                        <h5 class="text-muted mb-1">Saved Jobs</h5>
                        <h2 class="fw-bold mb-0">0</h2>
                        <p class="text-muted mb-0">Ready to apply</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RECENT APPLICATIONS & FOR YOU -->
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold"><i class="bi bi-clock-history me-2"></i> Recent Applications</h4>
                    <a href="job_applications.php" class="fw-bold text-decoration-none">View All <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="text-center p-5 bg-white rounded-3 shadow-sm">
                    <i class="bi bi-file-earmark-text display-4 text-muted"></i>
                    <p class="mt-3 text-muted">No new applications yet.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <h4 class="fw-bold mb-3"><i class="bi bi-star me-2"></i> For You</h4>
                <div class="text-center p-4 bg-white rounded-3 shadow-sm">
                    <a href="browse_job.php" class="btn w-100 py-3 fw-bold text-white" 
                    style="background: linear-gradient(90deg, #11bfcb, #2575fc); border: none;">
                        View All Jobs <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>