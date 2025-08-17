<?php
require_once __DIR__ . '/LaborsApplication.php';
$lbModel = new LaborsApplication();

if (isset($_GET['lid'])) {
    require_once __DIR__ . '/view.php';
    exit;
}
$applications = $lbModel->getApplicationByStatus('Resubmitted');
if (isset($_GET['s'])) {
    $applications = $lbModel->search($_GET['s']);
}
?>
<h1>resubmit Laborers List</h1>

<div class="search-form">
    <form action="" method="GET">
        <input type="hidden" name="vr" value="labors">
        <input type="hidden" name="stus" value="resubmit">
        <input type="text" name="s" placeholder="Search by name, NRC, or serial number"
            value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>" />
        <button type="submit">Search</button>
    </form>
</div>

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
        foreach ($applications as $laborer):
            $no += 1;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><img src="/labor_application/<?= htmlspecialchars($laborer['picture']) ?>" alt="Picture" width="50">
                </td>
                <td><?= htmlspecialchars($laborer['name']) ?></td>
                <td><?= htmlspecialchars($laborer['serial_number']) ?></td>
                <td><?= htmlspecialchars($laborer['status']) ?></td>
                <td><?= htmlspecialchars($laborer['registration_date']) ?></td>
                <td class="actions">
                    <a href="?vr=labors&stus=resubmit&lid=<?= $laborer['id'] ?>">View</a>
                    <a href="?vr=labors&did=<?= $laborer['id'] ?>&stus=resubmit"
                        onclick="return confirm('Are you sure you want to delete this labor?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>