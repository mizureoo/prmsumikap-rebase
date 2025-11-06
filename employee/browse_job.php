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

<!-- Tab Icon -->
<link rel="icon" type="image/png" sizes="512x512" href="/prmsumikap/assets/images/favicon.png">

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/layout.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>

    <?php include '../includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div id="main-content">
    <div class="welcome-card mb-4">
        <h1 class="display-5 fw-bold mb-3">Find your part-time job</h1>
        <p class="fs-5 mb-4">Discover opportunities from local businesses in your area</p>

        <form method="GET" class="d-flex flex-column flex-md-row gap-3">
            <div class="input-group shadow-sm rounded-pill overflow-hidden flex-grow-1">
                <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                <input type="text" name="query" class="form-control border-0" placeholder="Search jobs by title, company, or location" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
            </div>
            <button type="submit" class="btn text-white rounded-pill px-4 py-2 fw-bold mt-2 mt-md-0" style="background: #0a4da2;">Search</button>
        </form>
    </div>

    <!-- Job Listings -->
    <div class="row g-4">
        <div class="col-12">
            <div class="text-center p-5 bg-white rounded-3 shadow-sm">
                <i class="bi bi-briefcase display-4 text-muted"></i>
                <p class="mt-3 mb-0 text-muted">No job postings available yet.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>