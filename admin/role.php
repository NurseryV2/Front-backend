 <?php
include("db.php");
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    header("Location: ./cient/index.php");
    exit();
}
?>