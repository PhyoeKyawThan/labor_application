<?php
require_once __DIR__ . '/../../../commons/Connection.php';

$connection = new Connection();
$connection = $connection::$connection;
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
        /* min-height: 120px; */
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
</style>
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
<form action="actions/save_about.php" method="POST" novalidate>
    <label for="title">Title</label>
    <input type="text" id="title" name="title" required placeholder="Enter the title"
        value="<?= htmlspecialchars($title ?? '') ?>" autocomplete="off" />

    <label for="body">Body</label>
    <textarea id="body" name="body" rows="6" required
        placeholder="Write the content here"><?= htmlspecialchars($body ?? '') ?></textarea>

    <button type="submit">Save</button>
</form>
<?php
require_once __DIR__ . '/partials/end.php';
?>