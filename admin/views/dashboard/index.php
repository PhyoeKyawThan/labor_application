<?php
require_once __DIR__ . '/../report/ReportDataGenerator.php';
$dg = new ReportDataGenerator();
$dg->months = 8;
$dg->year = 2025;

$labors = $dg->getEmployedLabors();
$newLabors = $dg->getNewLabors();

// Employed Labors
$age_group_employed = [
    "18-25" => ["male" => 0, "female" => 0],
    "26-35" => ["male" => 0, "female" => 0],
    "36-45" => ["male" => 0, "female" => 0],
];
foreach ($labors as $l) {
    $age = (int) $l['age'];
    $gender = strtolower($l['gender']);
    if ($age >= 18 && $age <= 25)
        $age_group_employed["18-25"][$gender]++;
    elseif ($age >= 26 && $age <= 35)
        $age_group_employed["26-35"][$gender]++;
    elseif ($age >= 36 && $age <= 45)
        $age_group_employed["36-45"][$gender]++;
}

// New Labors
$age_group_new = [
    "18-25" => ["male" => 0, "female" => 0],
    "26-35" => ["male" => 0, "female" => 0],
    "36-45" => ["male" => 0, "female" => 0],
];
foreach ($newLabors as $l) {
    $age = (int) $l['age'];
    $gender = strtolower($l['gender']);
    if ($age >= 18 && $age <= 25)
        $age_group_new["18-25"][$gender]++;
    elseif ($age >= 26 && $age <= 35)
        $age_group_new["26-35"][$gender]++;
    elseif ($age >= 36 && $age <= 45)
        $age_group_new["36-45"][$gender]++;
}

function flatten_age_group($group)
{
    $data = [];
    foreach ($group as $g) {
        $data[] = $g['male'];
        $data[] = $g['female'];
    }
    return $data;
}

function flatten_labels($group)
{
    $labels = [];
    foreach ($group as $range => $genders) {
        $labels[] = "$range Male";
        $labels[] = "$range Female";
    }
    return $labels;
}

$employed_labels = flatten_labels($age_group_employed);
$employed_data = flatten_age_group($age_group_employed);

$new_labels = flatten_labels($age_group_new);
$new_data = flatten_age_group($age_group_new);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .dashboard {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: start;
        align-items: center;
    }

    .chart-card {
    width: 30%;
    height: auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        padding: 20px;
    }

    /* .chart-card:first-child */

    .chart-card h3 {
        margin-bottom: 15px;
        font-size: 1rem;
    }
</style>

<h1 style="background-color:#0056b3; padding: 10px; color: white; border-radius: 8px;">📊 Dashboard Overview</h1>
<div class="dashboard">

    <?php
    require_once __DIR__ . '/charts/cht_4.php';
    require_once __DIR__ . '/charts/cht_3.php';
    require_once __DIR__ . '/charts/cht_1.php';
    require_once __DIR__ . '/charts/cht_2.php';
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>