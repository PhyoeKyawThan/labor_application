<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once __DIR__ . '/EmployeeReqForm.php';
$reqModel = new EmployeeReqForm();
if(isset($_GET['fid'])){
    require_once __DIR__.'/view.php';
    exit;
}
if(isset($_GET['did'])){
    $reqModel->deleteForm($_GET['did']);
}
$requests = $reqModel->readAll();
if(isset($_GET['s'])){
    $requests = $reqModel->search($_GET['s']);
}

?>
<div class="employee-request-container">
    <h1>Employee Request List</h1>

    <div class="search-form">
        <form action="" method="GET">
            <input type="hidden" name="vr" value="employer">
            <input type="text" name="s" placeholder="Search by name"
                value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>" />
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($requests as $req):
                    $no += 1;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= htmlspecialchars($req['name']) ?></td>
                        <td><?= htmlspecialchars($req['position']) ?></td>
                        <td class="status-cell">
                            <span class="status-badge status-<?= strtolower(str_replace(' ', '', $req['status'])) ?>">
                                <?= htmlspecialchars($req['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($req['submitted_at']) ?></td>
                        <td class="actions">
                            <a href="?vr=employer&fid=<?= $req['id'] ?>" class="btn view-btn">View</a>
                            <a href="?vr=employer&did=<?= $req['id'] ?>"
                                class="btn delete-btn"
                                onclick="return confirm('Are you sure you want to delete this labor?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<style>
    /* General body and container styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f9;
       
    }

    h1 {
        color: #1a2a47;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .employee-request-container {
        max-width: 1200px;
        margin: auto;
    }

    /* Search Form */
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

    /* Table container for responsiveness */
    .table-container {
        overflow-x: auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

     thead{
        background-color: #0056b3 !important;
    }

    thead th {
        /* background-color: #f8f9fa; */
        text-align: left;
        padding: 15px;
        font-weight: 600;
        color: #ffffffff;
        border-bottom: 2px solid #e9ecef;
    }

    tbody td {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    tbody tr:hover {
        background-color: #f1f3f5;
        transition: background-color 0.2s;
    }

    /* Status Badges */
    .status-cell {
        font-weight: bold;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        text-transform: capitalize;
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
    
    /* Actions buttons */
    .actions {
        white-space: nowrap;
    }
    
    .btn {
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 13px;
        margin-right: 5px;
        transition: transform 0.2s, background-color 0.2s;
        display: inline-block;
    }
    
    .btn:hover {
        transform: translateY(-2px);
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
</style>
