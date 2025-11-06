<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: ../auth/login.php?error=" . urlencode("Unauthorized access."));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Applicants | PRMSUmikap</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<!-- Tab Icon -->
<link rel="icon" type="image/png" sizes="512x512" href="/prmsumikap/assets/images/favicon.png">

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/layout.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>

    <?php include __DIR__. '/../includes/sidebar.php'; ?>

    <div id="main-content">

        <!-- Header Section -->
        <div class="welcome-card mb-4">
            <h1 class="display-5 fw-bold mt-2">All Applicants</h1>
            <p class="fs-5">View and manage all applications across your job postings</p>

            <div class="mt-4">
                <div class="bg-white bg-opacity-25 rounded-4 px-4 py-3 d-inline-block text-center">
                    <h6 class="fw-semibold text-white mb-1">Total Applications</h6>
                    <h3 class="text-white fw-bold mb-0">0</h3>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Search Applicants</label>
                        <input type="text" class="form-control" placeholder="Name or email...">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Filter by Status</label>
                        <select class="form-select">
                            <option>All Statuses</option>
                            <option>Pending</option>
                            <option>Interviewed</option>
                            <option>Hired</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Filter by Job</label>
                        <select class="form-select">
                            <option>All Jobs</option>
                            <option>Web Developer</option>
                            <option>Designer</option>
                            <option>Project Manager</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Applications Count -->
        <p class="text-muted mb-3"><strong>0</strong> applications found</p>

        <!-- Empty State Card -->
        <div class="card text-center p-5">
            <div class="card-body">
                <i class="bi bi-person fs-1 text-secondary mb-3"></i>
                <h4 class="fw-semibold">No applications found</h4>
                <p class="text-muted mb-0">Applications will appear here as candidates apply for your positions</p>
            </div>
        </div>

    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
