<?php

$id = $_GET['lid'] ?? null;
if (!$id) {
    die("Labor ID is required");
}

$model = new LaborsApplication();
$laborer = $model->getApplicationById($id);

if (!$laborer) {
    die("Laborer not found");
}

$images = [];
if (!empty($laborer['images'])) {
    $decoded = json_decode($laborer['images'], true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $images = $decoded;
    }
}


?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8fafc;
        margin: 0;
        padding: 2rem;
    }

    h1 {
        text-align: center;
        font-size: 2.5rem;
        color: #1f2937;
        margin-bottom: 2rem;
    }

    form {
        background: #ffffff;
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    label {
        font-weight: 600;
        font-size: 0.95rem;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"],
    textarea,
    select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 1rem;
        background-color: #f9fafb;
        color: #111827;
    }

    input[disabled],
    select[disabled] {
        background-color: #e5e7eb;
        color: #6b7280;
        cursor: not-allowed;
    }

    input[type="submit"] {
        grid-column: 1 / -1;
        background-color: #2563eb;
        color: #fff;
        font-weight: 600;
        padding: 14px 0;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #1e3a8a;
    }

    .image-upload {
        grid-column: 1 / -1;
        display: flex;
        gap: 1rem;
        justify-content: start;
        flex-wrap: wrap;
        padding: 1rem 0;
    }

    .image-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .image-preview:hover {
        transform: scale(1.05);
    }

    textarea {
        resize: vertical;
    }
</style>

<h1>Labour - <?= htmlspecialchars($laborer['name']) ?></h1>
<form action="" method="POST" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="id" value="<?= (int) $laborer['id'] ?>" id="id">

    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($laborer['name']) ?>" required>
    </div>
    <div>
        <label for="nrc">NRC</label>
        <input type="text" id="nrc" name="nrc" value="<?= htmlspecialchars($laborer['nrc']) ?>" required>
    </div>
     <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($laborer['email']) ?>" disabled required>
    </div>
    <div>
        <label for="township">Township</label>
        <input type="text" id="township" name="township" value="<?= htmlspecialchars($laborer['township']) ?>" required>
    </div>

    <div>
        <label for="serial_number">Serial Number</label>
        <input type="text" id="serial_number" name="serial_number"
            value="<?= htmlspecialchars($laborer['serial_number']) ?>" required>
    </div>

    <div>
        <label for="birth_date">Birth Date</label>
        <input type="date" id="birth_date" name="birth_date" value="<?= htmlspecialchars($laborer['birth_date']) ?>"
            required>
    </div>

    <div>
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required disabled>
            <option value="Male" <?= $laborer['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $laborer['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
    </div>

    <div>
        <label for="religion">Religion</label>
        <input type="text" id="religion" name="religion" value="<?= htmlspecialchars($laborer['religion']) ?>" required>
    </div>

    <div>
        <label for="edu_level">Education Level</label>
        <input type="text" id="edu_level" name="edu_level" value="<?= htmlspecialchars($laborer['edu_level']) ?>"
            required>
    </div>

    

    <div>
        <label for="stable_address">Stable Address</label>
        <input type="text" id="stable_address" name="stable_address"
            value="<?= htmlspecialchars($laborer['stable_address']) ?>" required>
    </div>
  
    <input type="number" id="user_id" name="user_id" value="<?= (int) $laborer['user_id'] ?>" required hidden>


    <div class="image-upload">
        <?php
        $i = 0;
        foreach ($images as $image): ?>
            <label class="image-label" for="image<?= $i ?>"></label>
            <img id="preview<?= $i ?>" src="/labor_application/<?= htmlspecialchars($image) ?>"
                alt="Image Preview <?= $i + 1 ?>" class="image-preview" onclick="ViewImage(this.src)">
            <?php $i += 1; endforeach; ?>
    </div>
    <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
            <option value="Approved" <?= $laborer['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Pending" <?= $laborer['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="Rejected" <?= $laborer['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select>
    </div>
    <div>
        <label for="message">Message for registerer</label>
        <textarea name="message" rows="5" id="message"><?= $laborer['message'] ?></textarea>

    </div>
    <input type="submit" value="Submit">
</form>
<script>
    document.querySelectorAll('input[type=text], button, input[type=date]').forEach(elem => {
        elem.disabled = true;
    });

    // image view
    function ViewImage(src) {
        const overlay = document.createElement('div');
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100vw';
        overlay.style.height = '100vh';
        overlay.style.backgroundColor = 'rgba(0,0,0,0.8)';
        overlay.style.display = 'flex';
        overlay.style.justifyContent = 'center';
        overlay.style.alignItems = 'center';
        overlay.style.zIndex = '9999';

        const fullImage = document.createElement('img');
        fullImage.src = src;
        fullImage.style.maxWidth = '90%';
        fullImage.style.maxHeight = '90%';
        fullImage.style.border = '5px solid white';
        fullImage.style.borderRadius = '10px';
        fullImage.style.boxShadow = '0 0 20px black';

        overlay.appendChild(fullImage);

        // Close on click
        overlay.addEventListener('click', function () {
            document.body.removeChild(overlay);
        });

        document.body.appendChild(overlay);
    }
</script>
<?php
require_once __DIR__ . '/../../partials/end.php';
?>