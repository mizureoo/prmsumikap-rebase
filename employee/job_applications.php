<?php
session_start();

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
<title>My Applications | PRMSUmikap</title>

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

    <!-- Welcome / Header + Stats -->
    <div class="welcome-card mb-4">
        <h1 class="display-5 fw-bold mb-2">My Applications</h1>
        <p class="fs-5 mb-4">Track all your job applications in one place</p>

        <!-- Stats inside welcome-card -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3 p-3 shadow-sm bg-white bg-opacity-75">
                    <i class="bi bi-file-earmark-text-fill fs-2 text-black"></i>
                    <div>
                        <h6 class="text-black opacity-75 mb-1">Total Applications</h6>
                        <h3 class="fw-bold mb-0 text-black">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3 p-3 shadow-sm bg-white bg-opacity-75">
                    <i class="bi bi-graph-up fs-2 text-black"></i>
                    <div>
                        <h6 class="text-black opacity-75 mb-1">Active</h6>
                        <h3 class="fw-bold mb-0 text-black">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3 p-3 shadow-sm bg-white bg-opacity-75">
                    <i class="bi bi-briefcase-fill fs-2 text-black"></i>
                    <div>
                        <h6 class="text-black opacity-75 mb-1">Offers</h6>
                        <h3 class="fw-bold mb-0 text-black">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body py-2">
            <ul class="nav nav-pills justify-content-center gap-2" id="jobTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 py-2" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" type="button" role="tab">
                All Applications
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="active-tab" data-bs-toggle="pill" data-bs-target="#active" type="button" role="tab">
                Active
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="offers-tab" data-bs-toggle="pill" data-bs-target="#offers" type="button" role="tab">
                Offers
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-2" id="archived-tab" data-bs-toggle="pill" data-bs-target="#archived" type="button" role="tab">
                Archived
                </button>
            </li>
            </ul>
        </div>
      </div>


    <div class="tab-content" id="jobTabsContent">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
        <div class="card text-center p-5">
        <div class="card-body">
            <i class="bi bi-briefcase fs-1 text-secondary mb-3"></i>
            <h4 class="fw-semibold">No applications yet</h4>
            <p class="text-muted mb-4">Start applying to jobs that match your skills and interests</p>
            <a href="browse_job.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Browse Jobs
            </a>
        </div>
      </div>
    </div>

    <!-- Active Tab -->
    <div class="tab-pane fade" id="active" role="tabpanel" aria-labelledby="active-tab">
        <div class="card text-center p-5">
        <div class="card-body">
            <i class="bi bi-briefcase fs-1 text-secondary mb-3"></i>
            <h4 class="fw-semibold">No applications yet</h4>
            <p class="text-muted mb-4">No active applications at the moment</p>
            <a href="browse_job.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Browse Jobs
            </a>
        </div>
        </div>
    </div>

    <!-- Drafts Tab -->
    <div class="tab-pane fade" id="offers" role="tabpanel" aria-labelledby="offers-tab">
        <div class="card text-center p-5">
        <div class="card-body">
            <i class="bi bi-briefcase fs-1 text-secondary mb-3"></i>
            <h4 class="fw-semibold">No applications yet</h4>
            <p class="text-muted mb-4">No offers at the moment</p>
            <a href="browse_job.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Browse Jobs
            </a>
        </div>
        </div>
    </div>

    <!-- Closed Tab -->
    <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">
        <div class="card text-center p-5">
        <div class="card-body">
            <i class="bi bi-briefcase fs-1 text-secondary mb-3"></i>
            <h4 class="fw-semibold">No applications yet</h4>
            <p class="text-muted mb-4">No archived applications at the moment</p>
            <a href="browse_job.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Browse Jobs
            </a>
        </div>
        </div>
    </div>
    </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>