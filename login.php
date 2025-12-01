<?php
session_start();
require_once 'config.php';


// Handle login form submission
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Please enter both email and password.";
        header("Location: index.php");
        exit();
    }  
        // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT fname, lname, email, password_hash, role FROM member WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    // Check if user exists AND password is correct
    if ($member && password_verify($password, $member['password_hash'])) {
        // Set session values
        $_SESSION['fname'] = $member['fname'];
        $_SESSION['lname'] = $member['lname'];
        $_SESSION['email'] = $member['email'];
        $_SESSION['role']  = $member['role'];

        // Redirect based on role
        if ($member['role'] === 'admin') {
            header("Location: admin_portal.php");
        } else {
            header("Location: member_dashboard.php");
        }
        exit();
    }
    
    $_SESSION['login_error'] = "Incorrect email or password";
    header("Location: index.php");
    exit();
}
?>
