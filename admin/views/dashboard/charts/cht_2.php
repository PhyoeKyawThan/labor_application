<?php
$departments = $dg->getDepartmentPositionEmployedLabors();

$dept_labels = [];
$dept_data = [];
$dept_colors = [];

$colors_male = ['#42A5F5','#64B5F6','#90CAF9','#1976D2','#1E88E5'];
$colors_female = ['#FF7043','#FF8A65','#FFAB91','#D84315','#FF5722'];
$color_index = 0;

foreach ($departments as $d) {
    $dept_labels[] = $d['department'] . " Male";
    $dept_labels[] = $d['department'] . " Female";
    $dept_data[] = (int)$d['occupation']['male'];
    $dept_data[] = (int)$d['occupation']['female'];

    $dept_colors[] = $colors_male[$color_index % count($colors_male)];
    $dept_colors[] = $colors_female[$color_index % count($colors_female)];
    $color_index++;
}
?>
<div class="chart-card">
    <h3>ဌာနအလိုက် အလုပ်ရရှိသူများဇယား</h3>
    <canvas id="departmentChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('departmentChart'), {
    type: 'doughnut', 
    data: {
        labels: <?= json_encode($dept_labels) ?>,
        datasets: [{
            data: <?= json_encode($dept_data) ?>,
            backgroundColor: <?= json_encode($dept_colors) ?>
        }]
    },
    options: {
        responsive: true,
        cutout: '50%',
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw;
                    }
                }
            }
        }
    }
});
</script>
