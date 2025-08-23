<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "lrdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Applications status count
$app_query = "
    SELECT status, COUNT(*) as total 
    FROM applications 
    GROUP BY status
";
$app_result = $conn->query($app_query);
$app_labels = [];
$app_counts = [];
$app_colors = [];

while ($row = $app_result->fetch_assoc()) {
    $app_labels[] = $row['status'];
    $app_counts[] = $row['total'];

    // Assign colors per status
    switch ($row['status']) {
        case 'Approved':
            $app_colors[] = '#4CAF50'; // green
            break;
        case 'Pending':
            $app_colors[] = '#FFC107'; // amber
            break;
        case 'Rejected':
            $app_colors[] = '#F44336'; // red
            break;
        default:
            $app_colors[] = '#9E9E9E'; // grey
    }
}

// Employee request form status count
$emp_query = "
    SELECT status, COUNT(*) as total 
    FROM employee_req_form 
    GROUP BY status
";
$emp_result = $conn->query($emp_query);
$emp_labels = [];
$emp_counts = [];
$emp_colors = [];

while ($row = $emp_result->fetch_assoc()) {
    $emp_labels[] = $row['status'];
    $emp_counts[] = $row['total'];

    // Assign colors per status
    switch ($row['status']) {
        case 'Pending':
            $emp_colors[] = '#FFC107';
            break;
        case 'Department Approvel':
            $emp_colors[] = '#03A9F4'; // blue
            break;
        case 'Rejected':
            $emp_colors[] = '#F44336';
            break;
        case 'Finished':
            $emp_colors[] = '#4CAF50';
            break;
        default:
            $emp_colors[] = '#9E9E9E';
    }
}

$conn->close();
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 20px;
    }

    .chart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 20px;
    }

    .chart-card h3 {
        margin-bottom: 15px;
        font-size: 1.2rem;
    }
</style>

<h1 style="background-color:#0056b3; padding: 10px; color: white; border-radius: 8px;">📊 Dashboard Overview</h1>
<div class="dashboard">
    <div class="chart-card">
        <h3>Applications Status</h3>
        <canvas id="applicationsChart"></canvas>
    </div>
    <div class="chart-card">
        <h3>Employee Requests Status</h3>
        <canvas id="employeeReqChart"></canvas>
    </div>
</div>

<script>

    new Chart(document.getElementById('applicationsChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode($app_labels) ?>,
            datasets: [{
                data: <?= json_encode($app_counts) ?>,
                backgroundColor: <?= json_encode($app_colors) ?>
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    new Chart(document.getElementById('employeeReqChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode($emp_labels) ?>,
            datasets: [{
                data: <?= json_encode($emp_counts) ?>,
                backgroundColor: <?= json_encode($emp_colors) ?>
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>