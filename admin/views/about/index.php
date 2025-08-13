<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../../../commons/Connection.php';
$connection = new Connection();
$connection = $connection::$connection;

// Initialize message variables
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');

    if ($title && $body) {
        $checkQuery = "SELECT id FROM about ORDER BY id DESC LIMIT 1";
        $result = $connection->query($checkQuery);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];

            $updateQuery = "UPDATE about SET title=?, body=? WHERE id=?";
            $stmt = $connection->prepare($updateQuery);
            $stmt->bind_param("ssi", $title, $body, $id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $message = "About page updated successfully!";
                $message_type = "success";
            } else {
                 $message = "No changes were made.";
                 $message_type = "info";
            }
        } else {
            // Insert new row
            $insertQuery = "INSERT INTO about (title, body) VALUES (?, ?)";
            $stmt = $connection->prepare($insertQuery);
            $stmt->bind_param("ss", $title, $body);
            $stmt->execute();
            $message = "About page created successfully!";
            $message_type = "success";
        }
    } else {
        $message = "Title and body cannot be empty. Please fill out both fields.";
        $message_type = "error";
    }
}

$query = "SELECT * FROM about ORDER BY id DESC LIMIT 1";
$result = $connection->query($query);
$about = $result->fetch_assoc();
$title = $about['title'] ?? "";
$body = $about['body'] ?? "";

?>

<style>
    h1 {
        font-weight: 700;
        font-size: 48px;
        color: #111827;
        margin-bottom: 2rem;
        user-select: none;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    label {
        font-weight: 600;
        color: #374151;
        font-size: 1rem;
        user-select: none;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 0.5rem;
        border: 1.5px solid #d1d5db;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: inherit;
        resize: vertical;
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        outline: none;
    }

    button[type="submit"] {
        padding: 1rem;
        font-weight: 700;
        background-color: #111827;
        color: white;
        font-size: 1.125rem;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        user-select: none;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover,
    button[type="submit"]:focus-visible {
        background-color: #2563eb;
        outline: none;
    }
    
    .alert-box {
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        font-weight: 600;
        text-align: center;
    }

    .alert-box.success {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    .alert-box.error {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    .alert-box.info {
        background-color: #cff4fc;
        color: #055160;
        border: 1px solid #b6effb;
    }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nicEdit/1.0.0/nicEdit.js"></script>
<script>
    bkLib.onDomLoaded(function () {
        new nicEditor({ fullPanel: true }).panelInstance('body');
        setInterval(() => {
            const iframe = document.querySelector("iframe");
            if (iframe && iframe.contentDocument?.body) {
                iframe.style.height = (iframe.contentDocument.body.scrollHeight + 20) + 'px';
            }
        }, 500);
    });
</script>
<h1 id="form-title">About Page</h1>
<?php if (!empty($message)): ?>
    <div class="alert-box <?= $message_type ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>
<form action="" method="POST" novalidate>
    <label for="title">Title</label>
    <input type="text" id="title" name="title" required placeholder="Enter the title"
        value="<?= htmlspecialchars($title ?? '') ?>" autocomplete="off" />

    <label for="body">Body</label>
    <textarea id="body" name="body" rows="6" required
        placeholder="Write the content here"><?= htmlspecialchars($body ?? '') ?></textarea>

    <button type="submit">Save</button>
</form>
