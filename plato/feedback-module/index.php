<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback</title>
</head>
<body>
    <div class="content">
        <h2>All User Feedback</h2>
        <ul id="feedback-list">
            <?php if(!empty($feedbackList)): ?>
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

    <div id="subcontent">
    <?php
    // Handle different actions based on the query string
    switch ($action) {
        case 'view':
            require_once 'feedback-module/admin-feedback.php'; // Page to view user profile
            break;
        default:
            require_once 'main.php'; // This should be the file that lists all users
            break;
    }
    ?>
</div>
    <script src="js/script.js"></script>
</body>
</html>