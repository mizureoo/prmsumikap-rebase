<?php 
session_start();
// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'student') {
        header("Location: ../employee/dashboard.php");
    } else if ($_SESSION['role'] === 'employer') {
        header("Location: ../employer/dashboard.php");
    }
    exit;
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="d-flex justify-content-center align-items-center bg-light" style="min-height: calc(100vh - 150px);">
  <div class="card shadow border-0 p-4" style="width: 400px; border-radius: 15px;">
    <h2 class="text-center mb-4 text-primary fw-bold d-flex align-items-center justify-content-center">
      <i class="bi bi-person-circle me-2 fs-3"></i>
      LOGIN
    </h2>

    <?php
    // ✅ FIXED: Check for SESSION errors (this is what your login_process.php uses)
    if (isset($_SESSION['login_error'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                ' . htmlspecialchars($_SESSION['login_error']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>';
        // Clear the error after displaying
        unset($_SESSION['login_error']);
    }
    
    // Also check for URL success messages (from registration)
    if (isset($_GET['success'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                ' . htmlspecialchars($_GET['success']) . '
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
              </div>';
    }
    ?>

    <!-- Make sure this path matches your file structure -->
    <form method="POST" action="../config/login_process.php">
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>

      <div class="d-flex justify-content-between align-items-center">
        <a href="#" class="text-decoration-none small text-primary">Forgot your password?</a>
        <button type="submit" class="btn btn-primary px-4 fw-semibold">Log In</button>
      </div>
      <p class="text-decoration-none small text-primary mt-2">Don't have account yet? <a href="student_register.php"><u>Register</u></a></p>
    </form>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>