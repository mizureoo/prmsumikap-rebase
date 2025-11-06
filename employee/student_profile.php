<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php?error=" . urlencode("Unauthorized access."));
    exit;
}

$studentName = $_SESSION['name'];  
$accountType = ucfirst($_SESSION['role']);
$studentEmail = $_SESSION['email'] ?? 'example@email.com'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile | PRMSUmikap</title>

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
                    <i class="bi bi-person-fill text-primary fs-1"></i>
                </div>
                <button class="btn btn-sm btn-light rounded-circle position-absolute bottom-0 end-0">
                    <i class="bi bi-upload"></i>
                </button>
            </div>
            <div>
                <h2 class="fw-bold"><?= htmlspecialchars($studentName) ?></h2>
                <p class="text-muted"><?= htmlspecialchars($studentEmail) ?></p>
                <p>Add a professional headline</p>
            </div>
        </div>
    </div>

    <!-- Student Information Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body  px-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-person me-2"></i>Basic Information</h5>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Professional Headline</label>
                    <input type="text" class="form-control" name="company_name" placeholder="e.g., Aspiring Web Developer">
                </div>

                <div class="mb-3">
                    <label class="form-label">Bio/Summary</label>
                    <textarea class="form-control" rows="4" placeholder="Tell employers about yourself..."></textarea>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body  px-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-telephone me-2"></i>Contact Information</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Phone</label>
                    <input type="tel" class="form-control" placeholder="+63 912 345 6789">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">City / Municipality</label>
                    <input type="text" class="form-control" placeholder="e.g., Quezon City">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Province / Region</label>
                    <input type="text" class="form-control" placeholder="e.g., Metro Manila">
                </div>
            </div>
        </div>
    </div>

    <!-- Skills -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body px-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-award me-2"></i>Skills</h6>
            <div class="d-flex align-items-center gap-2 mb-3">
                <input type="text" class="form-control" placeholder="e.g., Communication, Customer Service, Social Media, Graphic Design, Organization">
                <button class="btn btn-primary rounded-3"><i class="bi bi-plus-lg"></i></button>
            </div>
        </div>
    </div>

    <!-- Work Experience -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body px-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-briefcase me-2"></i>Work Experience</h5>
            <p class="text-muted">No experience added yet</p>
            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg me-1"></i>Add Experience</button>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body px-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-mortarboard me-2"></i>Past Education</h6>

            <!-- Past Education Entry -->
            <div class="border p-3 rounded mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Education #1</h6>
                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </div>
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">School / Institution</label>
                        <input type="text" class="form-control" placeholder="e.g., ABC High School">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Degree / Diploma</label>
                        <input type="text" class="form-control" placeholder="e.g., High School Diploma">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Start Year</label>
                        <input type="number" class="form-control" placeholder="e.g., 2016">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">End Year</label>
                        <input type="number" class="form-control" placeholder="e.g., 2020">
                    </div>
                </div>
            </div>

            <!-- Add More -->
            <button class="btn btn-sm btn-outline-primary"><i class="bi bi-plus-lg me-1"></i>Add Education</button>
        </div>
    </div>

    <!-- Resume Upload -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body px-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-file-earmark-text me-2"></i>Resume</h6>
            <label class="d-block p-5 border-dashed rounded text-center cursor-pointer">
                <i class="bi bi-upload display-4 text-muted"></i>
                <p class="mt-2 mb-0">Upload your resume</p>
                <small class="text-muted">PDF, DOC, DOCX up to 10MB</small>
                <input type="file" accept=".pdf,.doc,.docx" class="d-none">
            </label>
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

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>