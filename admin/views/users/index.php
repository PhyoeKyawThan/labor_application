<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once __DIR__ . '/User.php';
$userModel = new User();
if(isset($_GET['uid']) || isset($_GET['fid'])){
    require_once __DIR__.'/view.php';
    exit;
}
if(isset($_GET['did'])){
    $userModel->delete((int) $_GET['did']);
}
$users = isset($_GET['filter']) ? $userModel->readAll($_GET['filter']) : $userModel->readAll();
if(isset($_GET['s'])){
    $users = $userModel->search($_GET['s']);
}


?>

<div class="user-table-container">
    <h1>User List</h1>

    <!-- Search Form -->
    <div class="search-form">
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="GET">
            <input type="hidden" name="vr" value="users">
            <input type="text" name="s" placeholder="Search by name or email"
                value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>" />
            <button type="submit">Search</button>
        </form>
        <div class="filter-form">
            <label for="filter"><i class="fas fa-filter"></i></label>
            <select name="filter" id="filter" onchange="doFilter(event)">
                <option disabled selected>
                     Filter
                </option>
                <option value="employee" <?= isset($_GET['filter']) && $_GET['filter'] == 'employee' ? 'selected' : '' ?>>Employee (labors)</option>
                <option value="employer" <?= isset($_GET['filter']) && $_GET['filter'] == 'employer' ? 'selected' : '' ?>>Employer</option>
            </select>
        </div>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($users as $user):
                    $no += 1;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td class="type-cell">
                            <span class="type-badge type-<?= strtolower($user['type']) ?>">
                                <?= htmlspecialchars($user['type']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                        <td class="actions">
                            <a href="?vr=users&uid=<?= $user['id'] ?>&t=<?= $user['type'] == 'employee' ? 'ee' : 'er' ?>" class="btn view-btn">View</a>
                            <a href="?vr=users&did=<?= $user['id'] ?>" class="btn delete-btn"
                                onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function doFilter(e){
        window.location.href = `<?= $_SERVER['REQUEST_URI'] ?>&filter=${e.target.value}`;
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

    h1 {
        color: #1a2a47;
        font-size: 24px;
        margin-bottom: 20px;
    }

    /* Search Form */
    .search-form {
        margin-bottom: 20px;
        display: flex;
        gap: 10px;
    }

    .search-form input[type="text"],
    .filter-form select {
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
        padding: 12px 15px;
        font-weight: 600;
        color: #f7f7f7ff;
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
    
    /* Type Badges */
    .type-cell {
        font-weight: bold;
    }
    
    .type-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        text-transform: capitalize;
    }
    
    .type-employee {
        background-color: #d4edda;
        color: #155724;
    }
    
    .type-employer {
        background-color: #cce5ff;
        color: #004085;
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
