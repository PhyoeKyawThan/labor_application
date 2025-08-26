<?php
$labors = $dg->getLaborsWithEdu();

$edu_labels = [];
$male_counts = [];
$female_counts = [];
$total_counts = [];

function counter($gender, $value){
    $count = 0;
    foreach($value as $v){
        if(strtolower($v['gender']) == strtolower($gender))
            $count++;
    }
    return $count;
}

foreach ($labors as $edu_level => $value) {
    $edu_labels[] = $edu_level;
    $male = counter('Male', $value);
    $female = counter('Female', $value);
    $male_counts[] = $male;
    $female_counts[] = $female;
    $total_counts[] = $male + $female;
}
?>
<div class="chart-card">
    <h3>အသစ်မှတ်ပုံတင်သူများကို ပညာအရည်အချင်းဖြင့် ပြသသည့်ဇယား</h3>
    <canvas id="eduLevelChart"></canvas>
</div>
<script>
new Chart(document.getElementById('eduLevelChart'), {
    type: 'doughnut',
    data: {
        labels: [
            <?php 
            foreach ($edu_labels as $label) {
                echo "'$label Male', '$label Female',";
            }
            ?>
        ],
        datasets: [{
            data: [
                <?php
                foreach ($edu_labels as $index => $label) {
                    echo $male_counts[$index] . ',' . $female_counts[$index] . ',';
                }
                ?>
            ],
            backgroundColor: [
                '#42A5F5','#FF7043',
                '#64B5F6','#FF8A65',
                '#90CAF9','#FFAB91',
                '#1976D2','#D84315'
            ]
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

