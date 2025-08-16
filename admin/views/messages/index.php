<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function generateMailtoLink($email, $name, $subject, $message, $reply)
{
    $fullSubject = urlencode("RE: " . $subject);
    $fullBody = urlencode("Dear " . $name . ",\n\n" . $reply . "\n\nOriginal message:\n" . $message);
    return "<a href='mailto:" . htmlspecialchars($email) . "?subject=" . $fullSubject . "&body=" . $fullBody . "' target='_blank' class='btn email-btn'>Send Email</a>";
}


$db = new Connection();
$conn = $db->get_connection();

if (isset($_GET["del"])) {
    $del_query = "DELETE FROM contact_msg WHERE id = ?";
    $del_query = $conn->prepare($del_query);
    $del_query->bind_param('i', $_GET['del']);
    $del_query->execute();
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}

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

$query = "SELECT * FROM contact_msg ORDER BY submitted_at DESC";

if (isset($_GET['s']) && !empty($_GET['s'])) {
    $search_term = "%" . $_GET['s'] . "%";
    $query = "SELECT * FROM contact_msg WHERE name LIKE ? OR email LIKE ? OR subject LIKE ? ORDER BY submitted_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $search_term, $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($query);
}

$messages = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();

?>

<div class="main-container">
    <div class="header">
        <h1>Message Management</h1>
    </div>

    <div class="search-form-container">
        <form action="" method="GET" class="search-form">
            <input type="text" name="s" placeholder="Search by name, email, or subject"
                value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>" />
            <button type="submit" class="btn search-btn">Search</button>
        </form>
        <a href="<?= $_SERVER['REQUEST_URI'] ?>" class="btn reset-btn">Reload</a>
    </div>

    <?php if ($reply_sent): ?>
        <div class="alert-box success">
            <p>Reply saved. Click the button below to send your reply via your email client.</p>
            <?= $mailto_link ?>
        </div>
    <?php endif; ?>

    <div class="message-list-container">
        <table>
            <thead>
                <tr>
                    <th>Submitted At</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Replied</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($messages)): ?>
                    <?php foreach ($messages as $message): ?>
                        <tr>
                            <td class="table-cell"><?= htmlspecialchars($message['submitted_at']); ?></td>
                            <td class="table-cell"><?= htmlspecialchars($message['name']); ?></td>
                            <td class="table-cell"><?= htmlspecialchars($message['email']); ?></td>
                            <td class="table-cell"><?= htmlspecialchars($message['subject']); ?></td>
                            <td class="table-cell">
                                <span class="status-badge status-<?= $message['replied'] ? 'yes' : 'no' ?>">
                                    <?= $message['replied'] ? 'Yes' : 'No' ?>
                                </span>
                            </td>
                            <td class="table-actions">
                                <button class="btn view-btn"
                                    onclick='showReplyModal(<?= json_encode($message) ?>)'>View</button>
                                <a href="?del=<?= $message['id'] ?>" class="btn delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this message?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-messages">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="replyModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>View & Reply</h2>
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
            </div>

            <div class="message-display">
                <p><strong>Message:</strong></p>
                <p id="modal-message"></p>
            </div>

            <label for="reply_msg">Your Reply:</label>
            <textarea name="reply_msg" id="reply_msg" required></textarea>

            <button type="submit" name="do-reply" class="btn save-btn">Save & Generate Email</button>
        </form>
    </div>
</div>

<script>
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

    var closeBtn = document.getElementsByClassName("close-btn")[0];
    closeBtn.onclick = function () {
        var modal = document.getElementById("replyModal");
        modal.style.display = "none";
    }

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
        /* background-color: #f4f7f9;
        color: #333;
        margin: 0;
        padding: 20px; */
    }

    .main-container {
        max-width: 1000px;
        margin: auto;
    }

    .header {
        text-align: center;
        margin-bottom: 25px;
    }

    .header h1 {
        color: #1a2a47;
        font-size: 28px;
        margin: 0;
    }

    .search-form-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-form,
    .reset-btn {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .search-form input[type="text"] {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        width: 300px;
        transition: border-color 0.3s;
    }

    .search-form input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .search-form button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-form button:hover {
        background-color: #0056b3;
    }

    .search-form {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .search-form input[type="text"] {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        width: 300px;
        transition: border-color 0.3s;
    }

    .search-form input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .search-form button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-form button:hover {
        background-color: #0056b3;
    }

    .search-btn:hover {
        background-color: #2563eb;
    }

    .reset-btn {
        background-color: #e2e8f0;
        color: #555;
        border-radius: 8px;
    }

    .reset-btn:hover {
        background-color: #cbd5e1;
    }

    /* Message list table */
    .message-list-container {
        overflow-x: auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    thead th {
        background-color: #f8f9fa;
        text-align: left;
        padding: 15px;
        font-weight: 600;
        color: #555;
        border-bottom: 2px solid #e9ecef;
    }

    tbody tr:hover {
        background-color: #f1f3f5;
    }

    .table-cell {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
        word-break: break-word;
    }

    .table-actions {
        white-space: nowrap;
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .no-messages {
        text-align: center;
        padding: 30px 15px;
        color: #777;
    }

    /* Buttons */
    .btn {
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .view-btn {
        background-color: #28a745;
        color: #fff;
    }

    .view-btn:hover {
        background-color: #218838;
    }

    .delete-btn {
        background-color: #dc3545;
        color: #fff;
    }

    .delete-btn:hover {
        background-color: #c82333;
    }

    .email-btn {
        background-color: #10b981;
        color: white;
        margin-top: 15px;
        display: inline-block;
    }

    .email-btn:hover {
        background-color: #059669;
    }

    /* Status Badges */
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

    /* Alert Boxes */
    .alert-box {
        padding: 15px;
        border-radius: 8px;
        border: 1px solid transparent;
        margin-bottom: 20px;
        text-align: center;
    }

    .alert-box.success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
        overflow: auto;
    }

    .modal-content {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        width: 90%;
        max-width: 650px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .modal-content h2 {
        margin-top: 0;
        color: #1a2a47;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .close-btn {
        color: #aaa;
        position: absolute;
        top: 15px;
        right: 25px;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: #333;
    }

    .modal-info p {
        margin: 5px 0;
        color: #555;
    }

    .modal-info p strong {
        color: #333;
    }

    .message-display {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        padding: 15px;
        margin-top: 20px;
    }

    .message-display p {
        margin: 0;
        line-height: 1.6;
        white-space: pre-wrap;
    }

    label {
        display: block;
        margin-top: 20px;
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
        min-height: 120px;
        font-size: 15px;
        transition: border-color 0.3s;
    }

    textarea:focus {
        outline: none;
        border-color: #3b82f6;
    }

    .save-btn {
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
        width: 100%;
    }

    .save-btn:hover {
        background-color: #059669;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .main-container {
            padding: 10px;
        }

        .search-form-container {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form input[type="text"] {
            border-radius: 8px;
            border-right: 1px solid #e2e8f0;
        }

        .search-form {
            flex-direction: column;
            gap: 10px;
        }

        .search-btn,
        .reset-btn {
            width: 100%;
            border-radius: 8px;
        }

        thead {
            display: none;
        }

        table,
        tbody,
        tr,
        td {
            display: block;
            width: 100%;
        }

        tr {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
        }

        .table-cell {
            padding: 10px 15px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-cell::before {
            content: attr(data-label);
            font-weight: 600;
            color: #555;
            flex-basis: 40%;
            text-align: left;
        }

        .table-cell.status::before {
            content: 'Replied:';
        }

        .table-cell.date::before {
            content: 'Submitted At:';
        }

        .table-actions {
            display: flex;
            justify-content: space-around;
            padding: 15px;
            border-bottom: none;
        }
    }
</style>