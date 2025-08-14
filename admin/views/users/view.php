<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$uid = filter_input(INPUT_GET, 'uid');
$type = filter_input(INPUT_GET, 't');

if (!$uid || !$type) {
    echo "<div class='container p-4'><div class='alert-box'>Invalid request parameters.</div></div>";
    exit;
}

$user = $userModel->readById($uid);
$data = null;

if ($type === 'er') {
    $data = $userModel->readRequestForm($uid);
} elseif ($type === 'ee') {
    $data = $userModel->readApplication($uid);
}

if (!$data) {
    echo "<div class='container p-4'><div class='alert-box'>No data found for this ID.</div></div>";
    exit;
}
?>

<div class="view-container">
    <div class="header">
        <a href="/labor_application/admin/?vr=users" class="back-link">&larr; Back to list</a>
        <h1>
            <?= $type === 'er' ? 'Employee Request Details' : ($type === 'ee' ? 'Application Details' : 'Details') ?>
        </h1>
    </div>
    <?php if ($type === 'er'): ?>
        <a href="/labor_application/admin/?vr=employer&fid=<?= urlencode($data['id']) ?>&fURL=<?= $_SERVER['REQUEST_URI'] ?>" class="view-icon">
            <i class="fas fa-eye"></i>
        </a>
        <div class="details-grid">
            <div class="detail-item"><span class="label">Name:</span><span
                    class="value"><?= htmlspecialchars($data['name']) ?></span></div>
            <div class="detail-item"><span class="label">Position:</span><span
                    class="value"><?= htmlspecialchars($data['position']) ?></span></div>
            <div class="detail-item"><span class="label">Status:</span>
                <span class="value status-badge status-<?= strtolower(str_replace(' ', '', $data['status'] == 'Approved' || $data['status'] == 'Finished' ? 'approved' : 'pending')) ?>">
                    <?= htmlspecialchars($data['status']) ?>
                </span>
            </div>
            <div class="detail-item"><span class="label">Department Address:</span><span
                    class="value"><?= htmlspecialchars($data['department_address']) ?></span></div>
            <div class="detail-item"><span class="label">Phone:</span><span
                    class="value"><?= htmlspecialchars($data['phone']) ?></span></div>
            <div class="detail-item"><span class="label">Report Receiver:</span><span
                    class="value"><?= htmlspecialchars($data['report_receiver']) ?></span></div>
        </div>

    <?php elseif ($type === 'ee'): ?>
        <a href="/labor_application/admin/?vr=labors&lid=<?= urlencode($data['id']) ?>&fURL=<?= urlencode($_SERVER['REQUEST_URI']) ?>" class="view-icon">
            <i class="fas fa-eye"></i>
        </a>
        <div class="details-grid">
            <div class="detail-item"><span class="label">Name:</span><span
                    class="value"><?= htmlspecialchars($data['name']) ?></span></div>
            <div class="detail-item"><span class="label">Age:</span><span
                    class="value"><?= htmlspecialchars($data['age']) ?></span></div>
            <div class="detail-item"><span class="label">Father's Name:</span><span
                    class="value"><?= htmlspecialchars($data['father_name'] ?? $data['fatherName']) ?></span></div>
            <div class="detail-item"><span class="label">NRC:</span><span
                    class="value"><?= htmlspecialchars($data['nrc']) ?></span></div>
            <div class="detail-item"><span class="label">Phone:</span><span
                    class="value"><?= htmlspecialchars($data['phone']) ?></span></div>
            <div class="detail-item"><span class="label">Email:</span><span
                    class="value"><?= htmlspecialchars($data['email']) ?></span></div>
            <div class="detail-item"><span class="label">Township:</span><span
                    class="value"><?= htmlspecialchars($data['township']) ?></span></div>
            <div class="detail-item"><span class="label">Birth Date:</span><span
                    class="value"><?= htmlspecialchars($data['birth_date']) ?></span></div>
            <div class="detail-item"><span class="label">Gender:</span><span
                    class="value"><?= htmlspecialchars($data['gender']) ?></span></div>
            <div class="detail-item"><span class="label">Religion:</span><span
                    class="value"><?= htmlspecialchars($data['religion']) ?></span></div>
            <div class="detail-item"><span class="label">Education Level:</span><span
                    class="value"><?= htmlspecialchars($data['edu_level']) ?></span></div>
            <div class="detail-item"><span class="label">Stable Address:</span><span
                    class="value"><?= htmlspecialchars($data['stable_address']) ?></span></div>
            <div class="detail-item"><span class="label">Status:</span>
                <span class="value status-badge status-<?= strtolower($data['status']) ?>">
                    <?= htmlspecialchars($data['status']) ?>
                </span>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>

<style>
    /* Container wrapper */
    .view-container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, sans-serif;
    }

    /* Header section */
    .view-container .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .view-container .header h1 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1e293b;
    }

    .view-container .back-link {
        text-decoration: none;
        color: #3b82f6;
        font-size: 0.95rem;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .view-container .back-link:hover {
        color: #2563eb;
    }

    /* Card styling */
    .view-container .card {
        background: #ffffff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    /* Grid for details */
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
        margin-top: 10px;
    }

    /* Individual detail item */
    .detail-item {
        background: #f8fafc;
        padding: 12px 14px;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        transition: background 0.2s ease;
    }

    .detail-item:hover {
        background: #f1f5f9;
    }

    /* Labels and values */
    .label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
    }

    .value {
        font-size: 0.95rem;
        color: #1e293b;
        font-weight: 500;
    }

    /* Status badges */
    .status-badge {
        width: fit-content;
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
        color: #fff;
    }

    .status-employee,
    .status-approved {
        background-color: #22c55e;
    }

    .status-pending {
        background-color: #f59e0b;
    }

    .status-rejected {
        background-color: #ef4444;
    }

    /* View icon link */
    .view-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
        background: #3b82f6;
        color: white;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        text-decoration: none;
        font-size: 1rem;
        transition: background 0.2s ease;
    }

    .view-icon:hover {
        background: #2563eb;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .view-container .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .view-container .header h1 {
            font-size: 1.3rem;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }
    }
</style>