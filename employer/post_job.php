<?php
session_start();
include __DIR__ . '/../database/prmsumikap_db.php';

// Check if user is an employer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'employer') {
    header("Location: ../auth/login.php?error=" . urlencode("Unauthorized access."));
    exit;
}

// Get the employer ID from user session
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT employer_id FROM employers_profile WHERE user_id = ?");
$stmt->execute([$user_id]);
$employer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$employer) {
    die("Employer record not found.");
}

$employer_id = $employer['employer_id'];
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['job_title']);
    $description = trim($_POST['job_description']);
    $location = trim($_POST['job_location']);
    $type = $_POST['job_type'];
    $salary = trim($_POST['salary_range']);
    $status = $_POST['status'];

    if (!empty($title) && !empty($description)) {
        $stmt = $pdo->prepare("INSERT INTO jobs (employer_id, job_title, job_description, job_location, job_type, salary_range, status, date_posted) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$employer_id, $title, $description, $location, $type, $salary, $status]);

        $message = '<div class="alert alert-success">Job posted successfully!</div>';
    } else {
        $message = '<div class="alert alert-danger">Please fill in all required fields.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Post Job | PRMSUmikap</title>

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
    <div class="welcome-card mb-4">
        <h1 class="display-5 fw-bold mt-2">Post a New Job</h1>
        <p class="fs-5">Find the perfect candidate for your team</p>
    </div>  

   <div class="card p-5">
      <h3 class="fw-bold mb-4 text-center">Job Details</h3>

      <form method="POST" action="POST">
        <div class="container my-5">
        <!-- Job Title -->
        <div class="mb-3">
          <label class="form-label">Job Title <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="job_title" placeholder="e.g., Senior Software Engineer" required>
        </div>

        <!-- Job Type & Work Arrangement -->
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Job Type <span class="text-danger">*</span></label>
            <select class="form-select" name="job_type" required>
              <option value="">Select Job Type</option>
              <option>Full-time</option>
              <option>Part-time</option>
              <option>Contract</option>
              <option>Internship</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Work Arrangement <span class="text-danger">*</span></label>
            <select class="form-select" name="work_arrangement" required>
              <option value="">Select Arrangement</option>
              <option>On-site</option>
              <option>Hybrid</option>
              <option>Remote</option>
            </select>
          </div>
        </div>

        <!-- Location -->
        <div class="mt-3 mb-3">
          <label class="form-label">Location</label>
          <input type="text" class="form-control" name="location" placeholder="e.g., San Francisco, CA">
        </div>

        <!-- Salary -->
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Min Salary (Optional)</label>
            <input type="number" class="form-control" name="min_salary" placeholder="50000">
          </div>
          <div class="col-md-6">
            <label class="form-label">Max Salary (Optional)</label>
            <input type="number" class="form-control" name="max_salary" placeholder="80000">
          </div>
        </div>

        <!-- Description -->
        <div class="mt-3 mb-3">
          <label class="form-label">Job Description <span class="text-danger">*</span></label>
          <textarea class="form-control" name="job_description" rows="4" placeholder="Describe the role..." required></textarea>
        </div>

        <!-- Responsibilities -->
        <div class="mb-3">
          <label class="form-label">Responsibilities</label>
          <textarea class="form-control" name="responsibilities" rows="3" placeholder="List the key responsibilities..."></textarea>
        </div>

        <!-- Qualifications -->
        <div class="mb-4">
          <label class="form-label">Qualifications</label>
          <textarea class="form-control" name="qualifications" rows="3" placeholder="List required skills, experience, education..."></textarea>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between">
          <button type="reset" class="btn btn-outline-secondary">Save as Draft</button>
          <button type="submit" class="btn btn-primary">Publish Job</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
