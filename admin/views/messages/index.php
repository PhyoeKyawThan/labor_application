<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// This is a placeholder for your database connection logic,
// configured with your actual database credentials.
class DatabaseConnection {
    public static $connection;

    public static function connect() {
        if (self::$connection === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "lrdb";

            // Create connection
            self::$connection = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}

// Placeholder for your mail_to_generator.php functionality
function generateMailtoLink($email, $name, $subject, $message, $reply) {
    $fullSubject = urlencode("RE: " . $subject);
    $fullBody = urlencode("Dear " . $name . ",\n\n" . $reply . "\n\nOriginal message:\n" . $message);
    return "<a href='mailto:".htmlspecialchars($email)."?subject=".$fullSubject."&body=".$fullBody."' target='_blank'>Send Reply</a>";
}

// Establish the database connection
$conn = DatabaseConnection::connect();

// Handle delete action
if (isset($_GET["del"])) {
    $del_query = "DELETE FROM contact_msg WHERE id = ?";
    $del_query = $conn->prepare($del_query);
    $del_query->bind_param('i', $_GET['del']);
    $del_query->execute();
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?')); // Redirect to remove query string
    exit();
}

// Handle reply action
$reply_sent = false;
$mailto_link = '';
if (isset($_POST['do-reply'])) {
    $replyId = $_POST['reply-id'];
    $replyMsg = $_POST['reply_msg'];
    $reply_query = 'UPDATE contact_msg SET reply_msg = ?, replied = 1 WHERE id = ?';
    $reply_query = $conn->prepare($reply_query);
    $reply_query->bind_param('si', $replyMsg, $replyId);
    $reply_query->execute();
    $reply_sent = true;
    $mailto_link = generateMailtoLink($_POST['reply-email'], $_POST['reply-name'], $_POST['reply-subject'], $_POST['message'], $replyMsg);
}

// Query for fetching messages
$query = "SELECT * FROM contact_msg ORDER BY submitted_at DESC";
$result = $conn->query($query);
$messages = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

?>
<div class="messages-container">
    <div class="header">
        <h1>Messages</h1>
    </div>

    <!-- Search Form -->
    <div class="search-form">
        <form action="" method="GET">
            <input type="text" name="s" placeholder="Search by name, email, or subject"
                value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>" />
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if ($reply_sent): ?>
    <div class="alert-box success">
        <p>Reply saved. Click the link below to send your reply via your email client.</p>
        <?= $mailto_link ?>
    </div>
    <?php endif; ?>

    <div class="card-list">
        <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $message): ?>
            <div class="card message-card">
                <div class="details-grid">
                    <div class="detail-item">
                        <span class="label">Name:</span>
                        <span class="value"><?= htmlspecialchars($message['name']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Email:</span>
                        <span class="value"><?= htmlspecialchars($message['email']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Subject:</span>
                        <span class="value"><?= htmlspecialchars($message['subject']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Submitted At:</span>
                        <span class="value"><?= htmlspecialchars($message['submitted_at']); ?></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Replied:</span>
                        <span class="value status-badge status-<?= $message['replied'] ? 'yes' : 'no' ?>">
                            <?= $message['replied'] ? 'Yes' : 'No' ?>
                        </span>
                    </div>
                </div>
                <div class="actions">
                    <button class="button reply-button" onclick='showReplyModal(<?= json_encode($message) ?>)'>Reply</button>
                    <a href="?del=<?= $message['id'] ?>" class="button delete-button"
                        onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="alert-box">No messages found.</div>
        <?php endif; ?>
    </div>
</div>

<!-- The Modal -->
<div id="replyModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Reply to Message</h2>
        <form action="" method="post">
            <input type="hidden" id="reply-id" name="reply-id">
            <input type="hidden" id="reply-name" name="reply-name">
            <input type="hidden" id="reply-email" name="reply-email">
            <input type="hidden" id="reply-subject" name="reply-subject">
            <input type="hidden" id="message" name="message">
            
            <div class="modal-info">
                <p><strong>Name:</strong> <span id="modal-name"></span></p>
                <p><strong>Email:</strong> <span id="modal-email"></span></p>
                <p><strong>Subject:</strong> <span id="modal-subject"></span></p>
                <p><strong>Message:</strong> <span id="modal-message"></span></p>
            </div>

            <label for="reply_msg">Your Reply:</label>
            <textarea name="reply_msg" id="reply_msg" required></textarea>

            <button type="submit" name="do-reply">Save and Generate Email</button>
        </form>
    </div>
</div>

<script>
    // Function to show the modal
    function showReplyModal(data) {
        var modal = document.getElementById("replyModal");
        
        document.getElementById("reply-id").value = data.id;
        document.getElementById("reply-name").value = data.name;
        document.getElementById("reply-email").value = data.email;
        document.getElementById("reply-subject").value = data.subject;
        document.getElementById("message").value = data.message;
        
        document.getElementById("modal-name").textContent = data.name;
        document.getElementById("modal-email").textContent = data.email;
        document.getElementById("modal-subject").textContent = data.subject;
        document.getElementById("modal-message").textContent = data.message;
        
        document.getElementById("reply_msg").value = data.reply_msg || "";
        
        modal.style.display = "flex";
    }

    // Close the modal
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function () {
        var modal = document.getElementById("replyModal");
        modal.style.display = "none";
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        var modal = document.getElementById("replyModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<style>
    /* General body and container styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f9;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    .messages-container {
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        color: #1a2a47;
        font-size: 28px;
        margin: 0;
    }

    .search-form {
        display: flex;
        justify-content: center;
        margin-bottom: 25px;
    }

    .search-form input[type="text"] {
        padding: 12px;
        width: 350px;
        border: 1px solid #e2e8f0;
        border-radius: 8px 0 0 8px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    .search-form input[type="text"]:focus {
        outline: none;
        border-color: #3b82f6;
    }
    
    .search-form button {
        padding: 12px 20px;
        background-color: #3b82f6;
        color: white;
        border: none;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .search-form button:hover {
        background-color: #2563eb;
    }

    .card-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 20px;
    }

    .message-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        flex-grow: 1;
    }
    
    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-item .label {
        font-weight: 600;
        color: #555;
        margin-bottom: 4px;
    }
    
    .detail-item .value {
        font-size: 15px;
        color: #333;
    }

    .actions {
        display: flex;
        gap: 10px;
        margin-left: 20px;
    }

    .button {
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .reply-button {
        background-color: #3b82f6;
        color: white;
    }
    
    .reply-button:hover {
        background-color: #2563eb;
    }
    
    .delete-button {
        background-color: #f87171;
        color: white;
    }

    .delete-button:hover {
        background-color: #ef4444;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        text-transform: capitalize;
        font-weight: bold;
    }
    
    .status-yes {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-no {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-box {
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 8px;
        border: 1px solid #f5c6cb;
        margin-bottom: 20px;
    }

    .alert-box.success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }
    
    .alert-box.success a {
        color: #155724;
        text-decoration: underline;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .modal-content h2 {
        margin-top: 0;
        color: #1a2a47;
    }

    .modal .close {
        color: #aaa;
        position: absolute;
        top: 15px;
        right: 25px;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;
    }

    .modal .close:hover,
    .modal .close:focus {
        color: black;
    }
    
    .modal-info p {
        margin: 5px 0;
        color: #555;
    }
    
    .modal-info p strong {
        color: #333;
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        color: #333;
    }

    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        box-sizing: border-box;
        min-height: 100px;
        font-size: 15px;
    }

    button[type="submit"] {
        background-color: #10b981;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 20px;
        font-size: 16px;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    button[type="submit"]:hover {
        background-color: #059669;
    }
    
    @media (max-width: 768px) {
        .message-card {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .actions {
            margin-top: 15px;
            margin-left: 0;
            width: 100%;
            justify-content: space-around;
        }
        
        .search-form {
            flex-direction: column;
        }
        
        .search-form input[type="text"] {
            border-radius: 8px;
            margin-bottom: 10px;
            width: 100%;
        }
        
        .search-form button {
            border-radius: 8px;
            width: 100%;
        }
    }
</style>
