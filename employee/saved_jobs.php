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
<title>Find Jobs | PRMSUmikap</title>

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
    <div class="welcome-card p-4 p-md-5 mb-4">
        <h1 class="display-5 fw-bold mb-2">Saved Jobs</h1>
        <p class="fs-5 mb-4">Jobs you've bookmarked for later</p>

        <!-- Stats inside welcome-card -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card d-flex align-items-center gap-3 p-3 shadow-sm bg-white bg-opacity-75">
                    <i class="bi bi-file-earmark-text-fill fs-2 text-black"></i>
                    <div>
                        <h6 class="text-black opacity-75 mb-1">Total Saved</h6>
                        <h3 class="fw-bold mb-0 text-black">0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications List -->
    <div class="row g-4">
        <div class="col-12">
            <div class="text-center p-5 bg-white rounded-3 shadow-sm">
                <i class="bi bi-clipboard-check display-4 text-muted"></i>
                <p class="mt-3 text-muted">You haven’t saved any jobs yet.</p>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
