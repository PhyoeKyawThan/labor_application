<?php

require_once __DIR__ . '/../labors/LaborsApplication.php';
$lbModel = new LaborsApplication();
if(isset($_GET['lid'])){
    require_once __DIR__.'/view.php';
    exit;
}

$msg = null;
$err = null;

if(isset($_GET['dId'])){
    $id = (int) $_GET['dId'];
    $lbModel->id = $id;
    if($lbModel->deleteApplication()){
        $msg = "Deleted";
    }else{
        $err = "Error while deletion";
    }
}
?>
<h1>Resubmittion Laborers List</h1>

<!-- Search Form -->
<div class="search-form">
    <form action="" method="GET">
        <input type="text" name="s" placeholder="Search by name, NRC, or serial number"
            value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>" />
        <button type="submit">Search</button>
    </form>
</div>
<div><?= $err ?></div>
<div><?= $msg ?></div>
<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Picture</th>
            <th>Name</th>
            <th>Serial Number</th>
            <th>Status</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 0;
        foreach ($lbModel->getResubmitApplications() as $laborer):
            $no += 1;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><img src="/labor_application/<?= htmlspecialchars($laborer['picture']) ?>" alt="Picture" width="50"></td>
                <td><?= htmlspecialchars($laborer['name']) ?></td>
                <td><?= htmlspecialchars($laborer['serial_number']) ?></td>
                <td><?= htmlspecialchars($laborer['status']) ?></td>
                <td><?= htmlspecialchars($laborer['registration_date']) ?></td>
                <td class="actions">
                    <a href="?vr=labors&lid=<?= $laborer['id'] ?>">View</a>
                    <a href="?vr=labors&dId=<?= $laborer['id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this labor?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<style>
    /* Search Form */
    .search-form {
        margin: 20px 0;
        display: flex;
        justify-content: flex-start;
    }

    .search-form form {
        display: flex;
        gap: 10px;
    }

    .search-form input[type="text"] {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        width: 300px;
    }

    .search-form button {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-form button:hover {
        background-color: #0056b3;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    thead {
        background-color: #f1f1f1;
    }

    thead th {
        text-align: left;
        padding: 12px;
        border-bottom: 2px solid #ddd;
    }

    tbody td {
        padding: 10px 12px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    tbody tr:hover {
        background-color: #f9f9f9;
    }

    td img {
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .actions a {
        margin-right: 8px;
        text-decoration: none;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 13px;
        transition: background 0.2s;
    }

    .actions a:first-child {
        background-color: #28a745;
        color: #fff;
    }

    .actions a:first-child:hover {
        background-color: #218838;
    }

    .actions a:last-child {
        background-color: #dc3545;
        color: #fff;
    }

    .actions a:last-child:hover {
        background-color: #c82333;
    }
</style>