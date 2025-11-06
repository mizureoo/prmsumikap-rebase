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
<title>Company Profile | PRMSUmikap</title>

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
    <div class="welcome-card mb-4 d-flex align-items-center">
        <div class="d-flex align-items-center gap-4">
            <div class="position-relative">
                <div class="bg-white rounded-circle p-4 d-inline-flex align-items-center justify-content-center" style="width:100px; height:100px;">
                    <i class="bi bi-buildings text-primary fs-1"></i>
                </div>
                <button class="btn btn-sm btn-light rounded-circle position-absolute bottom-0 end-0">
                    <i class="bi bi-upload"></i>
                </button>
            </div>
            <div>
                <h1 class="fw-bold text-white mb-1">Company Profile</h1>
                <p class="text-white-50 mb-0"><?php echo htmlspecialchars($_SESSION['email'] ?? 'company@email.com'); ?></p>
            </div>
        </div>
    </div>

    <!-- Company Information Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-4"><i class="bi bi-file-earmark-text me-2"></i>Company Information</h5>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Company Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="company_name" placeholder="e.g., Acme Corporation" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Industry</label>
                    <input type="text" class="form-control" name="industry" placeholder="e.g., Technology, Healthcare, Finance">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Website</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-globe2"></i></span>
                        <input type="url" class="form-control" name="website" placeholder="https://www.yourcompany.com">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Company Description</label>
                    <textarea class="form-control" rows="4" placeholder="Tell candidates about your company, culture, and mission..."></textarea>
                </div>
            </form>
        </div>
    </div>

    <!-- Office Locations Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-4"><i class="bi bi-geo-alt me-2"></i>Office Locations</h5>
            <div class="d-flex align-items-center gap-2 mb-3">
                <input type="text" class="form-control" placeholder="Add an office location...">
                <button class="btn btn-primary rounded-3"><i class="bi bi-plus-lg"></i></button>
            </div>
            <p class="text-muted text-center mb-0">No office locations added yet</p>
        </div>
    </div>

    <!-- Save Button -->
    <div class="d-grid">
        <button type="submit" class="btn text-white fw-semibold py-3" 
                style="background: linear-gradient(135deg, #6a11cb, #2575fc);">
            <i class="bi bi-save me-2"></i>Save Profile
        </button>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
