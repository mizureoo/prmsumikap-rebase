<?php
include __DIR__ . '/../database/db_prmsumikap.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: student_register.php');
    exit;
}

$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$role = $_POST['role'] ?? '';

if ($role === 'student') {
    $student_number = trim(filter_input(INPUT_POST, 'student_number', FILTER_SANITIZE_SPECIAL_CHARS));
    $course = trim(filter_input(INPUT_POST, 'course', FILTER_SANITIZE_SPECIAL_CHARS));
    $year_level = trim(filter_input(INPUT_POST, 'year_level', FILTER_SANITIZE_SPECIAL_CHARS));

    if (empty($name) || empty($student_number) || empty($course) || empty($year_level) || !$email || empty($password) || empty($confirm_password)) {
        header('Location: auth/student_register.php?role=student&error=' . urlencode('Please fill in all required fields correctly.'));
        exit;
    }
}

if ($password !== $confirm_password) {
    header('Location: auth/student_register.php?error=' . urlencode('Passwords do not match.'));
    exit;
}

if (strlen($password) < 8) {
    header('Location: auth/student_register.php?error=' . urlencode('Password must be at least 8 characters long.'));
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo->beginTransaction();

    $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $check_stmt->execute([$email]);
    if ($check_stmt->fetchColumn() > 0) {
        $pdo->rollBack();
        header('Location: auth/student_register.php?error=' . urlencode('This email is already registered.'));
        exit;
    }

    $insert_user_stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $insert_user_stmt->execute([$name, $email, $hashed_password, $role]);
    $user_id = $pdo->lastInsertId();

    if ($role === 'student') {
        $insert_profile_stmt = $pdo->prepare("INSERT INTO students_profile (user_id, student_number, course, year_level) VALUES (?, ?, ?, ?)");
        $insert_profile_stmt->execute([$user_id, $student_number, $course, $year_level]);
    }

    $pdo->commit();
    header('Location: auth/student_register.php?success=' . urlencode('Registration successful! You can now log in.'));
    exit;

} catch (PDOException $e) {
    $pdo->rollBack();
    header('Location: auth/student_register.php?error=' . urlencode('Database error: ' . $e->getMessage()));
    exit;
}