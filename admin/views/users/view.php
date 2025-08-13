<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$data = null;
$user = $userModel->readById($_GET['uid']);
if($_GET['t'] == 'er'){
    $data = $userModel->readRequestForm($_GET['uid']);
}else{
    $data = $userModel->readApplication($_GET['uid']);
}

if (!$data) {
    echo "<div class='container p-4'><div class='alert-box'>No data found for this ID.</div></div>";
    exit;
}

?>
<div class="view-container">
    <div class="header">
        <a href="javascript:history.back()" class="back-link">&larr; Back to list</a>
        <h1>
            <?php
            switch ($_GET['t']) {
                case 'er':
                    echo 'Employee Request Details';
                    break;
                case 'ee':
                    echo 'Application Details';
                    break;
                default:
                    echo 'Details';
                    break;
            }
            ?>
        </h1>
    </div>

    <div class="card">
        <?php if ($_GET['t'] === 'er'): ?>
            <a href="/labor_application/admin/?vr=employer&fid=<?= $data['id'] ?>" style="float: right">
                <i class="fas fa-eye"></i>
            </a>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="label">Name:</span>
                    <span class="value"><?= htmlspecialchars($data['name']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Position:</span>
                    <span class="value"><?= htmlspecialchars($data['position']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Status:</span>
                    <span class="value status-badge status-<?= strtolower(str_replace(' ', '', $data['status'])) ?>">
                        <?= htmlspecialchars($data['status']) ?>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="label">Department Address:</span>
                    <span class="value"><?= htmlspecialchars($data['department_address']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Phone:</span>
                    <span class="value"><?= htmlspecialchars($data['phone']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Report Receiver:</span>
                    <span class="value"><?= htmlspecialchars($data['report_receiver']) ?></span>
                </div>
            </div>
            
        <?php elseif ($_GET['t'] === 'ee'): ?>
             <a href="/labor_application/admin/?vr=labors&lid=<?= $data['id'] ?>" style="float: right">
                <i class="fas fa-eye"></i>
            </a>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="label">Name:</span>
                    <span class="value"><?= htmlspecialchars($data['name']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Age:</span>
                    <span class="value"><?= htmlspecialchars($data['age']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Father's Name:</span>
                    <span class="value"><?= htmlspecialchars($data['fatherName']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">NRC:</span>
                    <span class="value"><?= htmlspecialchars($data['nrc']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Phone:</span>
                    <span class="value"><?= htmlspecialchars($data['phone']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Email:</span>
                    <span class="value"><?= htmlspecialchars($data['email']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Township:</span>
                    <span class="value"><?= htmlspecialchars($data['township']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Birth Date:</span>
                    <span class="value"><?= htmlspecialchars($data['birth_date']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Gender:</span>
                    <span class="value"><?= htmlspecialchars($data['gender']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Religion:</span>
                    <span class="value"><?= htmlspecialchars($data['religion']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Education Level:</span>
                    <span class="value"><?= htmlspecialchars($data['edu_level']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Stable Address:</span>
                    <span class="value"><?= htmlspecialchars($data['stable_address']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Status:</span>
                    <span class="value status-badge status-<?= strtolower($data['status']) ?>">
                        <?= htmlspecialchars($data['status']) ?>
                    </span>
                </div>
            </div>

        <?php elseif ($_GET['t'] === 'user'): ?>
            <div class="details-grid">
                <div class="detail-item">
                    <span class="label">User ID:</span>
                    <span class="value"><?= htmlspecialchars($data['id']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Username:</span>
                    <span class="value"><?= htmlspecialchars($data['username']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">Email:</span>
                    <span class="value"><?= htmlspecialchars($data['email']) ?></span>
                </div>
                <div class="detail-item">
                    <span class="label">User Type:</span>
                    <span class="value status-badge status-<?= strtolower($data['type']) ?>">
                        <?= htmlspecialchars($data['type']) ?>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="label">Account Created:</span>
                    <span class="value"><?= htmlspecialchars($data['created_at']) ?></span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    

    h1 {
        color: #1a2a47;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .view-container {
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }
    
    .view-container .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .view-container .header h1 {
        margin: 0;
    }

    .back-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: #0056b3;
    }

    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 30px;
    }
    
    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-item .label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .detail-item .value {
        font-size: 16px;
        color: #333;
    }

    .related-applications {
        margin-top: 30px;
        border-top: 1px solid #e9ecef;
        padding-top: 20px;
    }
    
    .related-applications h3 {
        margin-top: 0;
        color: #1a2a47;
    }

    .application-list {
        list-style: none;
        padding: 0;
    }

    .application-list li {
        margin-bottom: 10px;
    }
    
    .application-list li a {
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
        transition: color 0.3s;
    }
    
    .application-list li a:hover {
        color: #0056b3;
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
    
    .status-approved {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-rejected {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-departmentapprovel {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-finished {
        background-color: #e2e3e5;
        color: #383d41;
    }
    
    .status-employer {
        background-color: #d1ecf1;
        color: #0c5460;
    }
    
    .status-employee {
        background-color: #d4edda;
        color: #155724;
    }

    /* Alert Box */
    .alert-box {
        padding: 15px;
        background-color: #f8d7da;
        color: #721c24;
        border-radius: 8px;
        border: 1px solid #f5c6cb;
    }
</style>
