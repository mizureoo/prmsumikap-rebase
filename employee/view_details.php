<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../auth/login.php?error=" . urlencode("Unauthorized access."));
    exit;
}

// Include database connection
require_once '../database/prmsumikap_db.php';

$student_id = $_SESSION['user_id'];

// Get job ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: browse_job.php?error=" . urlencode("Job not found."));
    exit;
}

$job_id = intval($_GET['id']);

// FIXED: Changed the JOIN to use user_id instead of employer_id
try {
    // First get basic job info
    $stmt = $pdo->prepare("
        SELECT jobs.*, 
               employers_profile.company_name, 
               employers_profile.contact_person, 
               employers_profile.contact_number as company_phone, 
               employers_profile.company_description, 
               employers_profile.company_address
        FROM jobs 
        LEFT JOIN employers_profile ON jobs.employer_id = employers_profile.user_id 
        WHERE jobs.job_id = ? AND jobs.status = 'Active'
    ");
    $stmt->execute([$job_id]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$job) {
        header("Location: browse_job.php?error=" . urlencode("Job not found or no longer available."));
        exit;
    }

    // Check if applied
    $appliedStmt = $pdo->prepare("SELECT COUNT(*) as count FROM applications WHERE job_id = ? AND student_id = ?");
    $appliedStmt->execute([$job_id, $student_id]);
    $appliedResult = $appliedStmt->fetch(PDO::FETCH_ASSOC);
    $job['has_applied'] = $appliedResult['count'];

    // Check if saved
    $savedStmt = $pdo->prepare("SELECT COUNT(*) as count FROM saved_jobs WHERE job_id = ? AND student_id = ?");
    $savedStmt->execute([$job_id, $student_id]);
    $savedResult = $savedStmt->fetch(PDO::FETCH_ASSOC);
    $job['is_saved'] = $savedResult['count'];

} catch(PDOException $e) {
    error_log("Job details error: " . $e->getMessage());
    header("Location: browse_job.php?error=" . urlencode("Database error. Please try again."));
    exit;
}

// Check for messages
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($job['job_title']); ?> | PRMSUmikap</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

<!-- Tab Icon -->
<link rel="icon" type="image/png" sizes="512x512" href="/prmsumikap/assets/images/favicon.png">

<!-- Custom CSS -->
<link rel="stylesheet" href="../assets/css/layout.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<style>
.job-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px;
}
.company-logo {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 12px;
    border: 3px solid white;
}
.job-meta-card {
    border-left: 4px solid #2575fc;
}
.salary-display {
    font-size: 1.5rem;
    font-weight: bold;
    color: #198754;
}
.requirements-list, .responsibilities-list {
    list-style: none;
    padding-left: 0;
}
.requirements-list li, .responsibilities-list li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
}
.requirements-list li:last-child, .responsibilities-list li:last-child {
    border-bottom: none;
}
.requirements-list li::before, .responsibilities-list li::before {
    content: "•";
    color: #2575fc;
    font-weight: bold;
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}
</style>
</head>
<body>

<?php include '../includes/sidebar.php'; ?>

<div id="main-content">
    <!-- Success/Error Messages -->
    <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i><?php echo htmlspecialchars($success); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?php echo htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Job Header -->
    <div class="job-header p-4 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="browse_job.php" class="text-white-50">Browse Jobs</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Job Details</li>
                    </ol>
                </nav>
                <h1 class="display-6 fw-bold mb-2"><?php echo htmlspecialchars($job['job_title']); ?></h1>
                <h3 class="mb-3"><?php echo htmlspecialchars($job['company_name'] ?? 'Company Name'); ?></h3>
                <div class="d-flex flex-wrap gap-3">
                    <span class="badge bg-light text-dark fs-6">
                        <i class="bi bi-geo-alt me-1"></i><?php echo htmlspecialchars($job['job_location']); ?>
                    </span>
                    <span class="badge bg-light text-dark fs-6">
                        <i class="bi bi-clock me-1"></i><?php echo htmlspecialchars($job['job_type']); ?>
                    </span>
                    <span class="badge bg-light text-dark fs-6">
                        <i class="bi bi-laptop me-1"></i><?php echo htmlspecialchars($job['work_arrangement']); ?>
                    </span>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="company-logo bg-light d-inline-flex align-items-center justify-content-center">
                    <i class="bi bi-building fs-1 text-muted"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Job Content -->
        <div class="col-lg-8">
            <!-- Job Description -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold mb-0"><i class="bi bi-file-text me-2"></i>Job Description</h4>
                </div>
                <div class="card-body">
                    <div class="job-description">
                        <?php echo nl2br(htmlspecialchars($job['job_description'])); ?>
                    </div>
                </div>
            </div>

            <!-- Responsibilities -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold mb-0"><i class="bi bi-list-task me-2"></i>Responsibilities</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($job['job_responsibilities'])): ?>
                        <ul class="responsibilities-list">
                            <?php 
                            $responsibilities = explode("\n", $job['job_responsibilities']);
                            foreach($responsibilities as $responsibility):
                                if(trim($responsibility)): 
                            ?>
                                <li><?php echo htmlspecialchars(trim($responsibility)); ?></li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No specific responsibilities listed.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Qualifications -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h4 class="fw-bold mb-0"><i class="bi bi-list-check me-2"></i>Qualifications</h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($job['job_qualifications'])): ?>
                        <ul class="requirements-list">
                            <?php 
                            $qualifications = explode("\n", $job['job_qualifications']);
                            foreach($qualifications as $qualification):
                                if(trim($qualification)): 
                            ?>
                                <li><?php echo htmlspecialchars(trim($qualification)); ?></li>
                            <?php 
                                endif;
                            endforeach; 
                            ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No specific qualifications listed.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- About Company -->
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h4 class="fw-bold mb-0"><i class="bi bi-building me-2"></i>About <?php echo htmlspecialchars($job['company_name'] ?? 'Company'); ?></h4>
                </div>
                <div class="card-body">
                    <?php if (!empty($job['company_description'])): ?>
                        <p><?php echo nl2br(htmlspecialchars($job['company_description'])); ?></p>
                    <?php else: ?>
                        <p class="text-muted">No company description available.</p>
                    <?php endif; ?>
                    
                    <?php if (!empty($job['company_address'])): ?>
                        <div class="mt-3">
                            <h6 class="fw-bold">Company Address:</h6>
                            <p class="text-muted"><?php echo htmlspecialchars($job['company_address']); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar - Job Actions & Info -->
        <div class="col-lg-4">
            <!-- Salary & Quick Actions -->
            <div class="card shadow-sm sticky-top" style="top: 100px;">
                <div class="card-header bg-white text-center">
                    <h5 class="fw-bold mb-0">Job Details</h5>
                </div>
                <div class="card-body">
                    <!-- Salary -->
                    <div class="text-center mb-4">
                        <span class="salary-display">
                            ₱<?php echo number_format($job['min_salary']); ?> - ₱<?php echo number_format($job['max_salary']); ?>
                        </span>
                        <p class="text-muted">per month</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2 mb-4">
                        <?php if($job['has_applied']): ?>
                            <button class="btn btn-success btn-lg" disabled>
                                <i class="bi bi-check-circle me-2"></i>Already Applied
                            </button>
                        <?php else: ?>
                            <a href="apply_job.php?id=<?php echo $job['job_id']; ?>" class="btn btn-primary btn-lg">
                                <i class="bi bi-send me-2"></i>Apply Now
                            </a>
                        <?php endif; ?>

                        <!-- Save Job Button -->
                        <form method="POST" action="../employee/save_job_process.php" class="d-inline">
                            <input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
                            <input type="hidden" name="redirect_url" value="view_details.php?id=<?php echo $job['job_id']; ?>">
                            <?php if($job['is_saved']): ?>
                                <button type="submit" name="action" value="unsave" class="btn btn-outline-danger w-100">
                                    <i class="bi bi-bookmark-check-fill me-2"></i>Remove from Saved
                                </button>
                            <?php else: ?>
                                <button type="submit" name="action" value="save" class="btn btn-outline-primary w-100">
                                    <i class="bi bi-bookmark me-2"></i>Save Job
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>

                    <!-- Job Meta Information -->
                    <div class="job-meta-card card bg-light">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Job Information</h6>
                            <div class="row g-3">
                                <div class="col-12">
                                    <small class="text-muted d-block">Job Type</small>
                                    <strong><?php echo htmlspecialchars($job['job_type']); ?></strong>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block">Work Arrangement</small>
                                    <strong><?php echo htmlspecialchars($job['work_arrangement']); ?></strong>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block">Location</small>
                                    <strong><?php echo htmlspecialchars($job['job_location']); ?></strong>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block">Date Posted</small>
                                    <strong><?php echo date('M j, Y', strtotime($job['date_posted'])); ?></strong>
                                </div>
                                <?php if(!empty($job['contact_person'])): ?>
                                <div class="col-12">
                                    <small class="text-muted d-block">Contact Person</small>
                                    <strong><?php echo htmlspecialchars($job['contact_person']); ?></strong>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($job['company_phone'])): ?>
                                <div class="col-12">
                                    <small class="text-muted d-block">Contact Number</small>
                                    <strong><?php echo htmlspecialchars($job['company_phone']); ?></strong>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Back to Browse -->
                    <div class="text-center mt-3">
                        <a href="browse_job.php" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Back to Jobs
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