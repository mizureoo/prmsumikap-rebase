<?php include __DIR__ . '/../includes/header.php'; 
include __DIR__ . '/../database/prmsumikap_db.php'; // Make sure this connects to your DB

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
?>

<div class="container my-5">
  <div class="bg-white p-5 rounded-4 shadow-sm">
    <h1 class="fw-semibold text-primary mb-4">Available Jobs</h1>

    <!-- Search Form -->
    <form action="jobs/jobs_search.php" method="GET" class="row g-2 mb-4">
      <div class="col-md-10">
        <input type="text" name="query" class="form-control" placeholder="Search for jobs..."
               value="<?= htmlspecialchars($query) ?>">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Search</button>
      </div>
    </form>

    <?php
    // SQL: get jobs, optionally filtered by user search
    if ($query) {
      $stmt = $conn->prepare("SELECT * FROM tbl_jobs WHERE job_title LIKE ? OR job_description LIKE ? ORDER BY date_posted DESC");
      $searchTerm = "%$query%";
      $stmt->bind_param("ss", $searchTerm, $searchTerm);
    } else {
      $stmt = $conn->prepare("SELECT * FROM tbl_jobs ORDER BY date_posted DESC");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0): ?>
      <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title fw-bold text-primary"><?= htmlspecialchars($row['job_title']) ?></h5>
                <p class="card-text text-secondary">
                  <?= nl2br(htmlspecialchars(substr($row['job_description'], 0, 120))) ?>...
                </p>
                <p class="text-muted small mb-1"><strong>Location:</strong> <?= htmlspecialchars($row['job_location']) ?></p>
                <p class="text-muted small mb-1"><strong>Posted by:</strong> <?= htmlspecialchars($row['employer_name']) ?></p>
              <a href="job_.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary btn-sm mt-2">View Details</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      
    <?php else: ?>
      <div class="alert alert-info text-center">
        No jobs found <?= $query ? "for '<strong>" . htmlspecialchars($query) . "</strong>'" : '' ?>.
      </div>
    <?php endif;

    $stmt->close();
    ?>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?> <!-- Footer -->
