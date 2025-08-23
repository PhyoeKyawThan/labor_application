<style>
    :root {
        --primary-color: #3b82f6;
        --text-color: #1f2937;
        --bg-color: #f9fafb;
        --card-bg-color: #ffffff;
        --border-color: #e5e7eb;
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05), 0 2px 4px rgba(0, 0, 0, 0.03);
    }

    body {
        font-family: system-ui, sans-serif;
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    #about {
        max-width: 900px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: var(--card-bg-color);
        border-radius: 0.75rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    #about-title {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
    }

    p {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
</style>

<?php
require_once __DIR__ . '/../../../commons/Connection.php';
$db = new Connection();
$connection = $db::$connection;
$query = "SELECT * FROM about LIMIT 1";
$result = $connection->query($query);
$about = $result->fetch_assoc();
?>

<main>
    <div id="about">
        <h1 id="about-title"><?= htmlspecialchars($about['title']) ?></h1>
        <p><?= $about['body'] ?></p>
    </div>
</main>