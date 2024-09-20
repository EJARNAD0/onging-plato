<?php
// Include the necessary files
include_once 'classes/class.user.php';
include_once 'classes/class.feedback.php';
include 'config/config.php';

// Get necessary variables from URL if they exist
$page = isset($_GET['page']) ? $_GET['page'] : '';
$subpage = isset($_GET['subpage']) ? $_GET['subpage'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Instantiate User class and check session
$user = new User();
$feedback = new Feedback();
if (!$user->get_session()) {
    header("Location: login.php");
    exit();
}
$user_id = $user->get_user_id($_SESSION['username']);

// Make sure you have this method implemented in class.feedback.php
$feedbackList = $feedback->get_all_feedback(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plato Admin Panel</title>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
</head>
<body>
    <h1>Plato</h1>
    <div class="admin-info">
        <div class="admin-menu">
            <p>Admin: <span id="admin-name">Hello, <?php echo $_SESSION['username']; ?></span></p>
            <div class="dropdown">
                <button class="dropbtn">Menu</button>
                <div class="dropdown-content">
                    <a href="admin-notification.php">Send Notification</a>
                    <a href="index.php?page=users">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content: Hide if page is 'feedback' -->
    <div class="content <?php echo ($page == 'feedback') ? 'hidden' : ''; ?>">
        <!-- Feedback Section (Hidden if 'users' page is selected or 'feedback' is selected) -->
        <div class="section user-feedback <?php echo ($page == 'users' || $page == 'feedback') ? 'hidden' : ''; ?>">
            <h2><a href="index.php?page=feedback">User Feedback</a></h2>
            <ul id="feedback-list">
                <?php if (!empty($feedbackList)): ?>
                    <?php foreach ($feedbackList as $feedbackItem): ?>
                        <li>
                            <strong>Name:</strong> <?php echo $feedbackItem['user_firstname'] . ' ' . $feedbackItem['user_lastname']; ?> <br>
                            <strong>Feedback:</strong> <?php echo $feedbackItem['feedback']; ?> <br>
                            <strong>Submitted on:</strong> <?php echo $feedbackItem['timestamp']; ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No feedback available.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Load the dynamic content based on the selected page -->
    <div id="content">
        <?php
        // Dynamic content loading based on the page parameter
        switch ($page) {
            case 'users':
                require_once 'users-module/index.php';
                break;
            case 'feedback':
                require_once 'feedback-module/index.php';
                break;
            case 'home':
            default:
                require_once 'main.php';
                break;
        }
        ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
